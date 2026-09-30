<?php
/** Theme bootstrap. */
defined( 'ABSPATH' ) || exit;
require_once get_template_directory() . '/inc/i18n.php';
require_once get_template_directory() . '/inc/content.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/pages.php';
require_once get_template_directory() . '/inc/structured-data.php';
require_once get_template_directory() . '/inc/inquiries.php';
require_once get_template_directory() . '/inc/analytics.php';
// Establish the enhanced header layout before first paint, not in the footer.
add_action( 'wp_head', function () {
    echo '<script>document.documentElement.classList.add("js");</script>' . "\n";
    foreach ( array( 'cormorant', 'cormorant-italic', 'manrope-regular' ) as $font ) {
        echo '<link rel="preload" href="' . esc_url( get_template_directory_uri() . '/assets/fonts/' . $font . '.woff2' ) . '" as="font" type="font/woff2" crossorigin>' . "\n";
    }
}, 1 );
add_action( 'after_setup_theme', function () {
    load_theme_textdomain( 'fireworks-phuket', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
    register_nav_menus( array( 'primary' => __( 'Primary navigation', 'fireworks-phuket' ), 'footer' => __( 'Footer navigation', 'fireworks-phuket' ) ) );
} );
add_action( 'wp_enqueue_scripts', function () {
    $version = wp_get_theme()->get( 'Version' );
    wp_enqueue_style( 'fp-fonts', get_template_directory_uri() . '/assets/fonts.css', array(), $version );
    wp_enqueue_style( 'fp-theme', get_template_directory_uri() . '/assets/theme.css', array( 'fp-fonts' ), $version );
    wp_enqueue_style( 'fp-pages', get_template_directory_uri() . '/assets/pages.css', array( 'fp-theme' ), $version );
    wp_enqueue_style( 'fp-colour', get_template_directory_uri() . '/assets/colour.css', array( 'fp-pages' ), $version );
    wp_enqueue_style( 'fp-i18n', get_template_directory_uri() . '/assets/i18n.css', array( 'fp-colour' ), $version );
    wp_enqueue_script( 'fp-theme', get_template_directory_uri() . '/assets/theme.js', array(), $version, true );
    wp_localize_script( 'fp-theme', 'fpI18n', array(
        'contactRequired' => __( 'Please enter a phone number, email address or messaging app ID.', 'fireworks-phuket' ),
        'phoneDigits' => __( 'Please enter a phone number with at least seven digits.', 'fireworks-phuket' ),
        'sending' => __( 'Sending your inquiry…', 'fireworks-phuket' ),
        'submit' => __( 'Request a Quote →', 'fireworks-phuket' ),
    ) );
} );
function fp_whatsapp_url() {
    $phone = preg_replace( '/[^0-9]/', '', get_theme_mod( 'fp_whatsapp', '' ) );
    return $phone ? 'https://wa.me/' . $phone . '?text=' . rawurlencode( "Hello Fireworks Phuket, I'd like a quote." ) : fp_page_url( 'contact', 'contact' );
}
function fp_contact_url() { return fp_page_url( 'contact', 'contact' ) . '#quote-form'; }
function fp_contact_label() {
    return __( 'Request a Quote', 'fireworks-phuket' );
}
function fp_menu_fallback() {
    echo '<ul class="menu">';
    $items = array(
        '' => __( 'Home', 'fireworks-phuket' ), 'packages' => __( 'Packages', 'fireworks-phuket' ), 'fire-shows' => __( 'Fire Shows', 'fireworks-phuket' ),
        'proposals' => __( 'Proposals', 'fireworks-phuket' ), 'wedding-fireworks' => __( 'Weddings', 'fireworks-phuket' ), 'gallery' => __( 'Gallery', 'fireworks-phuket' ),
        'locations' => __( 'Locations', 'fireworks-phuket' ), 'faq' => __( 'FAQ', 'fireworks-phuket' ), 'contact' => __( 'Contact', 'fireworks-phuket' ),
    );
    foreach ( $items as $slug => $label ) {
        echo '<li><a href="' . esc_url( $slug ? fp_page_url( $slug, 'wedding-fireworks' === $slug ? 'weddings' : $slug ) : fp_home_url() ) . '">' . esc_html( $label ) . '</a></li>';
    }
    echo '</ul>';
}
function fp_image( $key, $alt, $eager = false ) {
    $id = absint( get_theme_mod( 'fp_image_' . $key, 0 ) );
    $attrs = array( 'alt' => $alt, 'loading' => $eager ? 'eager' : 'lazy', 'decoding' => 'async' );
    if ( $eager ) { $attrs['fetchpriority'] = 'high'; }
    if ( $id && wp_attachment_is_image( $id ) ) {
        echo wp_get_attachment_image( $id, 'full', false, $attrs );
    } else {
        $files = array( 'hero' => 'real-patong', 'wedding' => 'real-colour', 'villa' => 'real-beach-fireworks', 'proposal' => 'real-phi-phi' );
        if ( ! isset( $files[ $key ] ) ) { return; }
        echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/' . $files[ $key ] . '.jpg' ) . '" alt="' . esc_attr( $alt ) . '" width="1920" height="1088" loading="' . esc_attr( $attrs['loading'] ) . '" decoding="async"' . ( $eager ? ' fetchpriority="high"' : '' ) . '>';
    }
}
function fp_title( $eyebrow, $title, $copy = '' ) {
    echo '<div class="section-title"><p class="eyebrow">' . esc_html( $eyebrow ) . '</p><h2>' . esc_html( $title ) . '</h2>';
    if ( $copy ) { echo '<p class="copy">' . esc_html( $copy ) . '</p>'; }
    echo '</div>';
}
