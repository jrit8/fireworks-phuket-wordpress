<?php defined( 'ABSPATH' ) || exit; ?>
<div class="fire-event-gallery" aria-label="<?php esc_attr_e( 'Real wedding fire-show photographs', 'fireworks-phuket' ); ?>">
<?php
$fire_photos = array(
    array( 'fire-performance', __( 'A dramatic flame moment', 'fireworks-phuket' ), __( 'A beach fire performance with a large flame above circular fire trails', 'fireworks-phuket' ) ),
    array( 'wedding-fire-heart-extended', __( 'A wedding fire-heart moment', 'fireworks-phuket' ), __( 'A wedding couple kisses inside an illuminated fire heart on the beach', 'fireworks-phuket' ) ),
);
foreach ( $fire_photos as $photo ) : ?>
<figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/phuketweds-' . $photo[0] . '.webp' ); ?>" alt="<?php echo esc_attr( $photo[2] ); ?>" width="766" height="510" loading="lazy" decoding="async"><figcaption><?php echo esc_html( $photo[1] ); ?></figcaption></figure>
<?php endforeach; ?>
</div>
<p class="small copy fire-gallery-credit"><?php echo wp_kses_post( __( 'Real wedding moments from <a href="https://phuketweds.com/phuket-wedding-photography/facebook-album/2532500900352883">PhuketWeds: Wim &amp; Marcia</a>. Fire-heart photograph extended with AI to complete the original crop. Photos illustrate past performances; effects and staging are agreed separately for your venue and event.', 'fireworks-phuket' ) ); ?></p>
