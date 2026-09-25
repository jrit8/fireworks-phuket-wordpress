<?php
/** Theme bootstrap. */
defined( 'ABSPATH' ) || exit;
require_once get_template_directory() . '/inc/content.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/pages.php';
require_once get_template_directory() . '/inc/inquiries.php';
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
    wp_enqueue_script( 'fp-theme', get_template_directory_uri() . '/assets/theme.js', array(), $version, true );
} );
function fp_contact_url() {
    $phone = preg_replace( '/[^0-9]/', '', get_theme_mod( 'fp_whatsapp', '' ) );
    return $phone ? 'https://wa.me/' . $phone . '?text=' . rawurlencode( "Hello Fireworks Phuket, I'd like a quote." ) : fp_page_url( 'contact', 'contact' );
}
function fp_contact_label() {
    return get_theme_mod( 'fp_whatsapp', '' ) ? __( 'Get a Quote on WhatsApp', 'fireworks-phuket' ) : __( 'Request a Quote', 'fireworks-phuket' );
}
function fp_menu_fallback() {
    echo '<ul class="menu">';
    foreach ( array( 'Home' => '', 'Packages' => 'packages', 'Wedding Fireworks' => 'wedding-fireworks', 'Gallery' => 'gallery', 'Locations' => 'locations', 'FAQ' => 'faq', 'Contact' => 'contact' ) as $label => $slug ) {
        echo '<li><a href="' . esc_url( $slug ? fp_page_url( $slug, 'wedding-fireworks' === $slug ? 'weddings' : $slug ) : home_url( '/' ) ) . '">' . esc_html( $label ) . '</a></li>';
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
        $files = array( 'hero' => 'fireworks-hero', 'wedding' => 'wedding-fireworks', 'villa' => 'villa-fireworks', 'proposal' => 'proposal-fireworks' );
        if ( ! isset( $files[ $key ] ) ) { return; }
        echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/' . $files[ $key ] . '.jpg' ) . '" alt="' . esc_attr( $alt ) . '" width="1920" height="1088" loading="' . esc_attr( $attrs['loading'] ) . '" decoding="async"' . ( $eager ? ' fetchpriority="high"' : '' ) . '>';
    }
}
function fp_title( $eyebrow, $title, $copy = '' ) {
    echo '<div class="section-title"><p class="eyebrow">' . esc_html( $eyebrow ) . '</p><h2>' . esc_html( $title ) . '</h2>';
    if ( $copy ) { echo '<p class="copy">' . esc_html( $copy ) . '</p>'; }
    echo '</div>';
}
