<?php defined( 'ABSPATH' ) || exit; ?>
<div class="fire-event-gallery" aria-label="Real wedding fire-show photographs">
<?php
$fire_photos = array(
    array( 'fire-trails', 'Sweeping fire trails at dusk', 'A fire performer creates sweeping trails on the beach at dusk' ),
    array( 'fire-performance', 'A dramatic flame moment', 'A beach fire performance with a large flame above circular fire trails' ),
    array( 'fire-dance', 'Movement against the ocean', 'A dancer creates wing-shaped fire trails with the ocean behind' ),
    array( 'wedding-fire-heart', 'A wedding fire-heart moment', 'A wedding couple kisses inside an illuminated fire heart on the beach' ),
);
foreach ( $fire_photos as $photo ) : ?>
<figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/phuketweds-' . $photo[0] . '.webp' ); ?>" alt="<?php echo esc_attr( $photo[2] ); ?>" width="766" height="510" loading="lazy" decoding="async"><figcaption><?php echo esc_html( $photo[1] ); ?></figcaption></figure>
<?php endforeach; ?>
</div>
<p class="small copy fire-gallery-credit">Real wedding moments from <a href="https://phuketweds.com/phuket-wedding-photography/facebook-album/2532500900352883">PhuketWeds: Wim &amp; Marcia</a>. Photos illustrate past performances; effects and staging are agreed separately for your venue and event.</p>

