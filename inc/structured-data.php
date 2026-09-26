<?php
defined( 'ABSPATH' ) || exit;

// Describe published pages using the same titles and excerpts visitors see.
add_action( 'wp_head', function () {
    if ( ! is_page() || is_front_page() || defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'AIOSEO_VERSION' ) ) { return; }
    $id = get_queried_object_id();
    if ( 'publish' !== get_post_status( $id ) ) { return; }
    $root = home_url( '/' );
    $url = get_permalink( $id );
    $kind = fp_page_kind();
    $slug = get_post_field( 'post_name', $id );
    $organization = array( '@type' => 'Organization', '@id' => $root . '#organization', 'name' => 'Fireworks Phuket', 'url' => $root );
    $phone = preg_replace( '/[^0-9]/', '', get_theme_mod( 'fp_whatsapp', '' ) );
    $email = sanitize_email( get_theme_mod( 'fp_email', '' ) );
    if ( $phone ) { $organization['telephone'] = '+' . $phone; }
    if ( $email ) { $organization['email'] = $email; }
    $page = array(
        '@type' => 'contact' === $kind ? 'ContactPage' : ( in_array( $kind, array( 'gallery', 'locations', 'packages' ), true ) ? 'CollectionPage' : 'WebPage' ),
        '@id' => $url . '#webpage', 'url' => $url, 'name' => get_the_title( $id ),
        'description' => wp_strip_all_tags( get_the_excerpt( $id ) ),
        'inLanguage' => get_bloginfo( 'language' ),
        'isPartOf' => array( '@id' => $root . '#website' ),
        'publisher' => array( '@id' => $root . '#organization' ),
    );
    $graph = array( $organization, array( '@type' => 'WebSite', '@id' => $root . '#website', 'url' => $root, 'name' => 'Fireworks Phuket', 'publisher' => array( '@id' => $root . '#organization' ) ) );
    $services = array( 'packages' => 'Event fireworks display planning', 'fire-shows' => 'Live fire performance', 'proposals' => 'Marriage proposal event planning', 'wedding' => 'Wedding fireworks display planning' );
    $locations = array( 'phuket-fireworks' => 'Phuket', 'khao-lak-fireworks' => 'Khao Lak', 'krabi-fireworks' => 'Krabi' );
    if ( isset( $services[$kind] ) || isset( $locations[$slug] ) ) {
        $areas = isset( $locations[$slug] ) ? array( $locations[$slug] ) : array( 'Phuket', 'Khao Lak', 'Krabi' );
        $service = array( '@type' => 'Service', '@id' => $url . '#service', 'url' => $url, 'name' => get_the_title( $id ), 'description' => $page['description'], 'serviceType' => $services[$kind] ?? 'Event fireworks display planning', 'provider' => array( '@id' => $root . '#organization' ), 'mainEntityOfPage' => array( '@id' => $url . '#webpage' ), 'areaServed' => array_map( function ( $area ) { return array( '@type' => 'Place', 'name' => $area ); }, $areas ) );
        $page['mainEntity'] = array( '@id' => $url . '#service' );
        $graph[] = $service;
    }
    if ( 'contact' === $kind ) { $page['about'] = array( '@id' => $root . '#organization' ); }
    $graph[] = $page;
    echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $graph ), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ) . '</script>' . "\n";
} );

