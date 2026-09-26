<?php
defined( 'ABSPATH' ) || exit;
// Content remains stored in the database if the theme changes. Register these
// types in a companion plugin before switching themes to retain the editing UI.
add_action( 'init', function () {
    foreach ( array( 'package' => 'Packages', 'faq' => 'FAQs', 'testimonial' => 'Testimonials', 'gallery' => 'Gallery items' ) as $key => $label ) {
        register_post_type( 'fp_' . $key, array(
            'label' => $label, 'public' => false, 'show_ui' => true,
            'show_in_rest' => true, 'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'menu_icon' => 'dashicons-star-filled', 'map_meta_cap' => true,
        ) );
    }
    register_post_meta( 'fp_package', '_fp_start_price', array( 'type' => 'integer', 'single' => true, 'show_in_rest' => false, 'sanitize_callback' => 'absint', 'auth_callback' => function () { return current_user_can( 'edit_posts' ); } ) );
} );
add_action( 'add_meta_boxes_fp_package', function () {
    add_meta_box( 'fp-package-price', 'Public guide price (THB)', function ( $post ) {
        wp_nonce_field( 'fp_package_price', 'fp_package_price_nonce' );
        echo '<p><label for="fp_start_price">Approximate public price marker in Thai baht</label></p>';
        echo '<input id="fp_start_price" name="fp_start_price" type="number" min="0" step="1000" class="widefat" value="' . esc_attr( get_post_meta( $post->ID, '_fp_start_price', true ) ) . '">';
        echo '<p>Shown as “Around ฿…+”; leave blank to request pricing. Exact package prices stay in the private quotation.</p>';
    }, 'fp_package', 'side' );
} );
add_action( 'save_post_fp_package', function ( $post_id ) {
    if ( ! isset( $_POST['fp_package_price_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['fp_package_price_nonce'] ) ), 'fp_package_price' ) || ! current_user_can( 'edit_post', $post_id ) || wp_is_post_revision( $post_id ) ) { return; }
    $value = isset( $_POST['fp_start_price'] ) ? absint( wp_unslash( $_POST['fp_start_price'] ) ) : 0;
    if ( $value ) { update_post_meta( $post_id, '_fp_start_price', $value ); }
    else { delete_post_meta( $post_id, '_fp_start_price' ); }
} );
function fp_items( $type ) {
    return get_posts( array( 'post_type' => 'fp_' . $type, 'post_status' => 'publish', 'numberposts' => -1, 'orderby' => array( 'menu_order' => 'ASC', 'date' => 'ASC' ) ) );
}
function fp_item_content( $item ) {
    echo apply_filters( 'the_content', $item->post_content );
}
function fp_default_faqs() {
    return array(
        array( 'How much do fireworks cost in Phuket?', 'As a broad guide, our featured displays are around ฿40,000+, ฿70,000+ and ฿108,000+. We prepare a written quote once we know your date, venue and desired display.' ),
        array( 'What can change the final price?', 'The starting ranges exclude 7% VAT, permission fees, venue charges and special logistics. A floating firing platform, if needed, is quoted separately. Your written quote sets out the final price and inclusions.' ),
        array( 'How long does a display last?', 'Our current display options range from a short moment of under a minute to approximately four minutes. The actual duration depends on the firing sequence, venue and confirmed design.' ),
        array( 'Can fireworks be arranged at any hotel or beach?', 'Not every location is suitable. Venue rules, firing position, access, surroundings and approvals are checked before confirmation.' ),
        array( 'Can you arrange a “Marry Me” proposal or sparklers?', 'Tell us the moment you imagine. We can discuss fire letters spelling “Marry Me”, illuminated proposal letters, sparklers and fireworks with your planner or venue. Each element depends on venue rules, availability and a separate written quote.' ),
        array( 'What is included in a proposal package?', 'The Intimate Reveal, The Sparkling Yes and The Grand Proposal are planning starting points. Fireworks guide prices apply to the display only. Letters, decor, photography, live performance, venue costs and other additions are itemised separately in your written quote.' ),
        array( 'Are fire letters available at every venue?', 'No. Fire letters need a suitable outdoor location and specific venue approval. Tell us your preferred venue so we can check availability and discuss an illuminated alternative if open flame is not suitable.' ),
        array( 'Are colourful daytime effects available?', 'They may be possible for suitable events. Share your venue and the effect you have in mind so we can check the location, availability and approval requirements.' ),
        array( 'Can the display be launched from a barge or floating platform?', 'A floating platform may be needed when there is no suitable approved firing position at the venue. The current estimate is roughly ฿40,000–฿60,000 or more in addition to the display, subject to sea conditions, access and supplier availability.' ),
        array( 'How many fire dancers can we book?', 'We can discuss a solo performer, a duo or a troupe of three, four or five. The right number depends on your venue, guest experience and preferred show style.' ),
        array( 'What kinds of fire dance shows are possible?', 'Ask about solo flow, synchronized duos, choreographed group routines and effects such as poi, staff or fans. Specific props, performance length and staging are confirmed with the artists and venue in your quote.' ),
        array( 'Can a fire dance show be combined with fireworks?', 'Yes, we can plan them as separate moments in the same event, subject to artist availability, venue suitability and the necessary approvals. The two services are quoted separately.' ),
        array( 'Do you also cover Khao Lak and Krabi?', 'Yes, subject to venue suitability, operator availability and the proposed firing location.' ),
        array( 'How far in advance should I book?', 'Please allow at least 7–14 days for permission arrangements, excluding weekends and public holidays. Contact us as soon as your date and venue are known; some venues and locations may need longer.' ),
        array( 'Can you coordinate directly with my wedding planner or hotel?', 'Yes. We can liaise directly with your planner, hotel or venue team to align timing, access and requirements.' ),
    );
}
