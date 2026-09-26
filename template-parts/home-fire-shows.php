<?php defined( 'ABSPATH' ) || exit;
$formats = array(
    array( 1, 'Solo Flow', 'An intimate performance built around one artist and a focused feature moment.', 12000 ),
    array( 2, 'Duo Rhythm', 'Two performers for mirrored movement and a stronger visual presence.', 18000 ),
    array( 3, 'Choreographed Trio', 'A coordinated group format for a wedding reception or private event.', 25000 ),
    array( 4, 'Ensemble', 'Four performers for a broader stage picture and layered choreography.', 32000 ),
    array( 5, 'Signature Troupe', 'Five performers for a larger event and a fuller group spectacle.', 40000 ),
);
?>
<section id="fire-shows" class="section fire-shows"><div class="container">
<div class="fire-show-intro"><div><p class="eyebrow">Live entertainment</p><h2>Fire dance shows in Phuket</h2><p class="copy">From a solo performance to a five-artist troupe, add a captivating live moment to a wedding, villa party or resort event. Ask us about poi, staff, fans and choreographed group routines; the final format depends on the artists and venue.</p><?php if ( ! is_page( 'fire-shows' ) ) : ?><a class="text-link" href="<?php echo esc_url( fp_page_url( 'fire-shows', 'fire-shows' ) ); ?>">Explore fire shows →</a><?php endif; ?></div><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/phuketweds-fire-show.jpg' ); ?>" alt="Fire performer at a PhuketWeds wedding reception, with sweeping trails of sparks" width="1336" height="452" loading="lazy" decoding="async"></div>
<div class="fire-format-grid">
<?php foreach ( $formats as $format ) : ?>
<article class="fire-format"><p class="eyebrow"><?php echo esc_html( $format[0] ); ?> <?php echo 1 === $format[0] ? 'dancer' : 'dancers'; ?></p><h3><?php echo esc_html( $format[1] ); ?></h3><p class="copy"><?php echo esc_html( $format[2] ); ?></p><p class="fire-format-price">Around ฿<?php echo esc_html( number_format_i18n( $format[3] ) ); ?>+</p></article>
<?php endforeach; ?>
</div><p class="small copy fire-price-note">Indicative fire-show budget guides only. Performer availability, show length, choreography, travel, venue requirements, taxes and any special effects are confirmed in a written quote. Fire shows and fireworks are priced separately.</p>
</div></section>
