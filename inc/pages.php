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
    $description = is_front_page() ? 'Professional fireworks displays and fire dance shows for weddings, proposals, villas, resorts and events across Phuket, Khao Lak and Krabi.' : ( is_singular() ? get_the_excerpt( get_queried_object_id() ) : '' );
    if ( ! $description ) { return; }
    $description = wp_strip_all_tags( $description );
    $url = is_front_page() ? home_url( '/' ) : get_permalink( get_queried_object_id() );
    echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
    echo '<meta property="og:type" content="website"><meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
    $image_key = is_page() && 'wedding' === fp_page_kind() ? 'wedding' : 'hero';
    $image_id = absint( get_theme_mod( 'fp_image_' . $image_key, 0 ) );
    $image_url = is_page() && 'fire-shows' === fp_page_kind() ? get_template_directory_uri() . '/assets/images/phuketweds-fire-show.jpg' : ( $image_id && wp_attachment_is_image( $image_id ) ? wp_get_attachment_image_url( $image_id, 'full' ) : get_template_directory_uri() . '/assets/images/' . ( 'wedding' === $image_key ? 'wedding-fireworks.jpg' : 'fireworks-hero.jpg' ) );
    if ( is_page() && 'proposals' === fp_page_kind() ) { $image_url = get_template_directory_uri() . '/assets/images/concept-fire-letters.webp'; }
    echo '<meta property="og:image" content="' . esc_url( $image_url ) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    if ( is_front_page() && ! is_singular() ) { echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n"; }
    if ( is_front_page() ) {
        $site_url = home_url( '/' );
        $organization = array( '@type' => 'Organization', '@id' => $site_url . '#organization', 'name' => 'Fireworks Phuket', 'url' => $site_url );
        $phone = preg_replace( '/[^0-9]/', '', get_theme_mod( 'fp_whatsapp', '' ) );
        if ( $phone ) { $organization['telephone'] = '+' . $phone; }
        $schema = array( '@context' => 'https://schema.org', '@graph' => array(
            $organization,
            array( '@type' => 'WebSite', '@id' => $site_url . '#website', 'url' => $site_url, 'name' => 'Fireworks Phuket', 'publisher' => array( '@id' => $site_url . '#organization' ) ),
            array( '@type' => 'Service', '@id' => $site_url . '#fireworks-service', 'name' => 'Fireworks displays for weddings and events', 'serviceType' => 'Event fireworks display planning', 'provider' => array( '@id' => $site_url . '#organization' ), 'areaServed' => array( array( '@type' => 'Place', 'name' => 'Phuket' ), array( '@type' => 'Place', 'name' => 'Khao Lak' ), array( '@type' => 'Place', 'name' => 'Krabi' ) ), 'url' => $site_url ),
            array( '@type' => 'Service', '@id' => $site_url . '#fire-dance-service', 'name' => 'Fire dance shows for weddings and events', 'serviceType' => 'Live fire performance', 'provider' => array( '@id' => $site_url . '#organization' ), 'areaServed' => array( array( '@type' => 'Place', 'name' => 'Phuket' ), array( '@type' => 'Place', 'name' => 'Khao Lak' ), array( '@type' => 'Place', 'name' => 'Krabi' ) ), 'url' => home_url( '/fire-shows/' ) )
        ) );
        echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ) . '</script>' . "\n";
    }
} );
