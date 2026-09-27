<?php
/** Consent-based conversion measurement. No inquiry text is sent to Analytics. */
defined( 'ABSPATH' ) || exit;
function fp_ga_id() {
    $id = get_theme_mod( 'fp_ga4_id', '' );
    return is_string( $id ) && preg_match( '/^G-[A-Z0-9]+$/', $id ) ? $id : '';
}
add_action( 'wp_enqueue_scripts', function () {
    if ( ! fp_ga_id() || current_user_can( 'manage_options' ) ) { return; }
    wp_enqueue_script( 'fp-analytics', get_template_directory_uri() . '/assets/analytics.js', array(), wp_get_theme()->get( 'Version' ), true );
    wp_localize_script( 'fp-analytics', 'fpAnalytics', array( 'id' => fp_ga_id(), 'receiptUrl' => admin_url( 'admin-ajax.php?action=fp_lead_receipt' ) ) );
    wp_enqueue_style( 'fp-analytics', get_template_directory_uri() . '/assets/analytics.css', array(), wp_get_theme()->get( 'Version' ) );
} );
add_action( 'wp_footer', function () {
    if ( ! fp_ga_id() || current_user_can( 'manage_options' ) ) { return; }
    ?>
    <button type="button" id="fp-privacy-settings" class="fp-privacy-settings" hidden>Analytics preferences</button>
    <section id="fp-analytics-consent" class="fp-analytics-consent" aria-label="Analytics preferences" hidden>
        <h2>Help us improve your visit</h2>
        <p>With your permission, Google Analytics uses cookies to measure visits, quote requests and contact-button clicks. We do not send your inquiry details. You can change your choice using Analytics preferences.</p>
        <div><button type="button" data-fp-consent="granted">Allow analytics</button><button type="button" data-fp-consent="denied">No thanks</button></div>
    </section>
    <?php
} );
// Issue a short-lived, unguessable receipt only after WordPress has saved an inquiry.
function fp_issue_lead_receipt( $service ) {
    if ( ! fp_ga_id() || ( $_COOKIE['fp_analytics_choice'] ?? '' ) !== 'granted' || current_user_can( 'manage_options' ) ) { return; }
    $services = array( 'Fireworks' => 'fireworks', 'Proposal package' => 'proposal', 'Fire dance show' => 'fire_dance', 'Fireworks and fire dance show' => 'combined' );
    $token = bin2hex( random_bytes( 24 ) );
    set_transient( 'fp_lead_' . $token, array( 'service_type' => $services[$service] ?? 'unspecified' ), 10 * MINUTE_IN_SECONDS );
    setcookie( 'fp_lead_receipt', $token, array( 'expires' => time() + 600, 'path' => '/', 'secure' => is_ssl(), 'httponly' => true, 'samesite' => 'Lax' ) );
}
add_action( 'wp_ajax_nopriv_fp_lead_receipt', 'fp_consume_lead_receipt' );
add_action( 'wp_ajax_fp_lead_receipt', 'fp_consume_lead_receipt' );
function fp_consume_lead_receipt() {
    nocache_headers();
    if ( 'POST' !== ( $_SERVER['REQUEST_METHOD'] ?? '' ) || ( $_COOKIE['fp_analytics_choice'] ?? '' ) !== 'granted' || wp_parse_url( $_SERVER['HTTP_ORIGIN'] ?? '', PHP_URL_HOST ) !== wp_parse_url( home_url(), PHP_URL_HOST ) ) { wp_send_json_error( null, 403 ); }
    $token = $_COOKIE['fp_lead_receipt'] ?? '';
    if ( ! is_string( $token ) || ! preg_match( '/^[a-f0-9]{48}$/', $token ) ) { wp_send_json_success( null ); }
    $data = get_transient( 'fp_lead_' . $token );
    delete_transient( 'fp_lead_' . $token );
    setcookie( 'fp_lead_receipt', '', array( 'expires' => time() - 3600, 'path' => '/', 'secure' => is_ssl(), 'httponly' => true, 'samesite' => 'Lax' ) );
    wp_send_json_success( $data ?: null );
}
