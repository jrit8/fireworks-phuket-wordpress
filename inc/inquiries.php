<?php
defined( 'ABSPATH' ) || exit;
add_action( 'init', function () {
    register_post_type( 'fp_inquiry', array(
        'label' => 'Inquiries', 'public' => false, 'show_ui' => true, 'show_in_rest' => false,
        'supports' => array( 'title', 'editor' ), 'menu_icon' => 'dashicons-email-alt',
        'capabilities' => array( 'edit_posts' => 'manage_options', 'edit_others_posts' => 'manage_options', 'publish_posts' => 'manage_options', 'read_private_posts' => 'manage_options', 'delete_posts' => 'manage_options', 'delete_others_posts' => 'manage_options', 'edit_post' => 'manage_options', 'delete_post' => 'manage_options', 'read_post' => 'manage_options', 'create_posts' => 'do_not_allow' ),
        'map_meta_cap' => false,
    ) );
} );
function fp_validate_inquiry( $input ) {
    $fields = array();
    foreach ( array( 'name', 'phone', 'email', 'preferred', 'handle', 'date', 'venue', 'service', 'option', 'event', 'budget', 'duration', 'message', 'lang' ) as $key ) {
        $value = isset( $input[$key] ) && is_string( $input[$key] ) ? wp_unslash( $input[$key] ) : '';
        if ( strlen( $value ) > ( 'message' === $key ? 4000 : 300 ) ) { return new WP_Error( 'length', 'Please shorten your entry.' ); }
        $fields[$key] = 'message' === $key ? sanitize_textarea_field( $value ) : sanitize_text_field( $value );
    }
    $fields['preferred'] = in_array( $fields['preferred'], array_merge( array( 'Email' ), fp_contact_apps(), array( 'Phone call' ) ), true ) ? $fields['preferred'] : '';
    $fields['lang'] = in_array( $fields['lang'], array( 'en', 'ru', 'zh', 'th' ), true ) ? $fields['lang'] : 'en';
    if ( ! $fields['name'] || ! $fields['venue'] || ! $fields['date'] || ( ! $fields['phone'] && ! $fields['email'] && ! $fields['handle'] ) ) { return new WP_Error( 'required', 'Please enter your name, event date, venue and at least one contact method.' ); }
    if ( $fields['email'] && ! is_email( $fields['email'] ) ) { return new WP_Error( 'email', 'Please enter a valid email address.' ); }
    if ( $fields['phone'] && strlen( preg_replace( '/[^0-9]/', '', $fields['phone'] ) ) < 7 ) { return new WP_Error( 'phone', 'Please enter a valid phone number.' ); }
    $date = DateTimeImmutable::createFromFormat( '!Y-m-d', $fields['date'], wp_timezone() );
    if ( ! $date || $date->format( 'Y-m-d' ) !== $fields['date'] || $fields['date'] < wp_date( 'Y-m-d' ) ) { return new WP_Error( 'date', 'Please choose a valid upcoming event date.' ); }
    return $fields;
}
function fp_inquiry_redirect( $status ) {
    // Send the visitor back to the contact page in the language they used.
    $lang = isset( $_POST['lang'] ) && is_string( $_POST['lang'] ) ? sanitize_key( wp_unslash( $_POST['lang'] ) ) : '';
    $contact = get_page_by_path( 'contact' );
    $url = $contact ? get_permalink( $lang ? fp_translated_id( $contact->ID, $lang ) : $contact->ID ) : home_url( '/' );
    wp_safe_redirect( add_query_arg( 'inquiry', $status, $url ) . '#quote-form', 303 ); exit;
}
add_action( 'admin_post_nopriv_fp_inquiry', 'fp_submit_inquiry' );
add_action( 'admin_post_fp_inquiry', 'fp_submit_inquiry' );
function fp_submit_inquiry() {
    if ( 'POST' !== ( $_SERVER['REQUEST_METHOD'] ?? '' ) ) { wp_die( 'Method not allowed.', '', array( 'response' => 405 ) ); }
    $nonce = isset( $_POST['fp_nonce'] ) && is_string( $_POST['fp_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['fp_nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'fp_inquiry' ) ) { fp_inquiry_redirect( 'expired' ); }
    if ( ! empty( $_POST['website'] ) ) { fp_inquiry_redirect( 'invalid' ); }
    $fields = fp_validate_inquiry( $_POST );
    if ( is_wp_error( $fields ) ) { fp_inquiry_redirect( 'invalid' ); }
    // Use a short-lived salted hash, never persist the visitor's raw IP address.
    $limit_key = 'fp_quote_' . hash_hmac( 'sha256', (string) ( $_SERVER['REMOTE_ADDR'] ?? '' ), wp_salt( 'nonce' ) );
    if ( get_transient( $limit_key ) ) { fp_inquiry_redirect( 'wait' ); }
    $body = '';
    $labels = array( 'name' => 'Name', 'phone' => 'Phone', 'email' => 'Email', 'preferred' => 'Preferred contact', 'handle' => 'Social handle', 'date' => 'EVENT date', 'venue' => 'Venue / location', 'service' => 'Service', 'option' => 'Option', 'event' => 'Event type', 'budget' => 'Budget (THB)', 'duration' => 'Show duration', 'message' => 'Message', 'lang' => 'Language' );
    foreach ( $fields as $key => $value ) {
        if ( '' === $value ) { continue; }
        if ( 'date' === $key ) { $d = date_create( $value ); if ( $d ) { $value = $d->format( 'l, j F Y' ) . ' (' . $value . ')'; } }
        $body .= ( $labels[$key] ?? ucfirst( $key ) ) . ': ' . $value . "\n\n";
    }
    $id = wp_insert_post( array( 'post_type' => 'fp_inquiry', 'post_status' => 'private', 'post_title' => 'Inquiry — ' . $fields['date'] . ' — ' . $fields['name'], 'post_content' => $body ), true );
    if ( is_wp_error( $id ) || ! $id ) { fp_inquiry_redirect( 'error' ); }
    set_transient( $limit_key, 1, MINUTE_IN_SECONDS );
    $email = sanitize_email( get_theme_mod( 'fp_notify_email', '' ) );
    if ( ! $email ) { $email = sanitize_email( get_option( 'admin_email', '' ) ); }
    if ( $email ) {
        // Send the submitted brief to the configured business inbox for screening.
        $headers = $fields['email'] ? array( 'Reply-To: ' . sanitize_email( $fields['email'] ) ) : array();
        $sent = wp_mail( $email, 'New Fireworks Phuket inquiry', "New website inquiry\n\n" . $body . 'Saved inquiry: ' . admin_url( 'post.php?post=' . $id . '&action=edit' ), $headers );
        update_post_meta( $id, '_fp_notification_accepted', $sent ? 'yes' : 'no' );
    }
    fp_issue_lead_receipt( $fields['service'] );
    fp_inquiry_redirect( 'saved' );
}
