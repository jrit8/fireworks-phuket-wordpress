<?php defined( 'ABSPATH' ) || exit;
$formats = array(
    array( 2, __( 'Duo Rhythm', 'fireworks-phuket' ), __( 'Two performers for mirrored movement and a stronger visual presence.', 'fireworks-phuket' ), 25000 ),
    array( 3, __( 'Choreographed Trio', 'fireworks-phuket' ), __( 'A coordinated group format for a wedding reception or private event.', 'fireworks-phuket' ), 32000 ),
    array( 4, __( 'Ensemble', 'fireworks-phuket' ), __( 'Four performers for a broader stage picture and layered choreography.', 'fireworks-phuket' ), 40000 ),
    array( 5, __( 'Signature Troupe', 'fireworks-phuket' ), __( 'Five performers for a larger event and a fuller group spectacle.', 'fireworks-phuket' ), 48000 ),
);
$dancers = array( 2 => __( '2 dancers', 'fireworks-phuket' ), 3 => __( '3 dancers', 'fireworks-phuket' ), 4 => __( '4 dancers', 'fireworks-phuket' ), 5 => __( '5 dancers', 'fireworks-phuket' ) );
?>
<section id="fire-shows" class="section fire-shows"><div class="container">
<div class="fire-show-intro"><div><p class="eyebrow"><?php esc_html_e( 'Live entertainment', 'fireworks-phuket' ); ?></p><h2><?php esc_html_e( 'Fire dance shows in Phuket', 'fireworks-phuket' ); ?></h2><p class="copy"><?php esc_html_e( 'From a duo to a five-artist troupe, add a captivating live moment to a wedding, villa party or resort event. Ask us about poi, staff, fans and choreographed group routines; the final format depends on the artists and venue.', 'fireworks-phuket' ); ?></p><?php if ( ! fp_is_page( 'fire-shows' ) ) : ?><a class="text-link" href="<?php echo esc_url( fp_page_url( 'fire-shows', 'fire-shows' ) ); ?>"><?php esc_html_e( 'Explore fire shows →', 'fireworks-phuket' ); ?></a><?php endif; ?></div><?php if ( ! fp_is_page( 'fire-shows' ) ) : ?><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/phuketweds-fire-show.jpg' ); ?>" alt="<?php esc_attr_e( 'Fire performer at a PhuketWeds wedding reception, with sweeping trails of sparks', 'fireworks-phuket' ); ?>" width="1336" height="452" loading="lazy" decoding="async"><?php endif; ?></div>
<?php get_template_part( 'template-parts/fire-event-gallery' ); ?>
<div class="fire-format-grid">
<?php foreach ( $formats as $format ) : ?>
<article class="fire-format"><p class="eyebrow"><?php echo esc_html( $dancers[ $format[0] ] ?? $format[0] ); ?></p><h3><?php echo esc_html( $format[1] ); ?></h3><p class="copy"><?php echo esc_html( $format[2] ); ?></p><?php if ( ! is_front_page() ) : ?><p class="fire-format-price"><?php echo esc_html( sprintf( __( 'From ฿%s+', 'fireworks-phuket' ), number_format_i18n( $format[3] ) ) ); ?></p><?php endif; ?><a class="text-link fire-show-link" href="<?php echo esc_url( add_query_arg( 'fire_show', $format[0], fp_page_url( 'contact', 'contact' ) ) . '#quote-form' ); ?>"><?php esc_html_e( 'Ask about this show →', 'fireworks-phuket' ); ?></a></article>
<?php endforeach; ?>
</div><p class="small copy fire-price-note"><?php esc_html_e( 'Indicative fire-show budget guides only. Performer availability, show length, choreography, travel, venue requirements, taxes and any special effects are confirmed in a written quote. Fire shows and fireworks are priced separately.', 'fireworks-phuket' ); ?></p>
</div></section>
