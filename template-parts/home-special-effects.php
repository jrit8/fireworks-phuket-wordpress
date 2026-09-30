<?php defined( 'ABSPATH' ) || exit;
$ideas = array(
    array( 'concept-marry-me.webp', __( 'Marry Me proposals', 'fireworks-phuket' ), __( 'A private reveal, illuminated letters and sparkler moments can be planned around your setting.', 'fireworks-phuket' ), __( 'Concept image of a seaside proposal with sparklers and illuminated letters', 'fireworks-phuket' ) ),
    array( 'concept-daytime-colour.webp', __( 'Daytime colour', 'fireworks-phuket' ), __( 'Colourful daytime effects offer a different kind of entrance or celebration moment.', 'fireworks-phuket' ), __( 'Concept image of colourful daytime effects over a coastal venue', 'fireworks-phuket' ) ),
    array( 'concept-floating-platform.webp', __( 'Over-water displays', 'fireworks-phuket' ), __( 'Where a venue has no suitable firing location, a floating platform may be possible at additional cost.', 'fireworks-phuket' ), __( 'Concept image of fireworks from a floating platform offshore', 'fireworks-phuket' ) ),
);
?>
<section class="section special-effects"><div class="container">
<?php fp_title( __( 'Beyond the finale', 'fireworks-phuket' ), __( 'Make the moment yours', 'fireworks-phuket' ), __( 'Tell us the atmosphere you have in mind. These ideas are planned individually and depend on venue approval, availability and a written quote.', 'fireworks-phuket' ) ); ?>
<div class="special-grid">
<?php foreach ( $ideas as $idea ) : ?>
<article class="special-card"><?php if ( $idea[0] ) : ?><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $idea[0] ); ?>" alt="<?php echo esc_attr( $idea[3] ); ?>" width="1672" height="941" loading="lazy" decoding="async"><?php endif; ?><div class="special-card-copy"><h3><?php echo esc_html( $idea[1] ); ?></h3><p><?php echo esc_html( $idea[2] ); ?></p></div></article>
<?php endforeach; ?>
</div><p class="small copy concept-disclosure"><?php esc_html_e( 'Concept imagery shows possibilities, not past Fireworks Phuket events or guaranteed package inclusions.', 'fireworks-phuket' ); ?></p>
</div></section>
