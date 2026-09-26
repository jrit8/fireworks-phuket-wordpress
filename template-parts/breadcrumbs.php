<?php defined( 'ABSPATH' ) || exit;
$crumbs = array( array( 'Home', home_url( '/' ) ) );
if ( in_array( get_post_field( 'post_name', get_the_ID() ), array( 'phuket-fireworks', 'khao-lak-fireworks', 'krabi-fireworks' ), true ) ) {
    $crumbs[] = array( 'Locations', fp_page_url( 'locations' ) );
}
$crumbs[] = array( get_the_title(), get_permalink() );
$items = array();
?>
<nav class="breadcrumbs container" aria-label="Breadcrumb"><ol>
<?php foreach ( $crumbs as $index => $crumb ) :
    $items[] = array( '@type' => 'ListItem', 'position' => $index + 1, 'name' => $crumb[0], 'item' => $crumb[1] ); ?>
<li><?php if ( $index === count( $crumbs ) - 1 ) : ?><span aria-current="page"><?php echo esc_html( $crumb[0] ); ?></span><?php else : ?><a href="<?php echo esc_url( $crumb[1] ); ?>"><?php echo esc_html( $crumb[0] ); ?></a><?php endif; ?></li>
<?php endforeach; ?>
</ol></nav>
<?php if ( ! defined( 'WPSEO_VERSION' ) && ! defined( 'RANK_MATH_VERSION' ) && ! defined( 'AIOSEO_VERSION' ) ) : ?>
<script type="application/ld+json"><?php echo wp_json_encode( array( '@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items ), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?></script>
<?php endif; ?>

