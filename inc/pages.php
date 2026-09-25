<?php
defined( 'ABSPATH' ) || exit;
function fp_page_url( $slug, $anchor = '' ) {
    $page = get_page_by_path( $slug );
    return $page && 'publish' === $page->post_status ? get_permalink( $page ) : home_url( '/' . ( $anchor ? '#' . $anchor : '' ) );
}
function fp_page_kind() { return sanitize_key( get_post_meta( get_queried_object_id(), '_fp_kind', true ) ); }
add_filter( 'sgo_exclude_urls_from_cache', function ( $urls ) {
    $urls[] = '/contact*';
    return array_values( array_unique( $urls ) );
} );
add_action( 'template_redirect', function () {
    if ( is_page() && 'contact' === fp_page_kind() ) {
        if ( ! defined( 'DONOTCACHEPAGE' ) ) { define( 'DONOTCACHEPAGE', true ); }
        nocache_headers();
    }
} );
add_action( 'wp_head', function () {
    // Avoid competing with common SEO plugins if one is installed later.
    if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) ) { return; }
    $description = is_front_page() ? 'Professional fireworks displays for weddings, proposals, villas, resorts and events across Phuket, Khao Lak and Krabi.' : ( is_singular() ? get_the_excerpt( get_queried_object_id() ) : '' );
    if ( ! $description ) { return; }
    $description = wp_strip_all_tags( $description );
    $url = is_front_page() ? home_url( '/' ) : get_permalink( get_queried_object_id() );
    echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
    echo '<meta property="og:type" content="website"><meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
    if ( is_front_page() && ! is_singular() ) { echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n"; }
} );
