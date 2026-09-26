<?php defined( 'ABSPATH' ) || exit;
$ideas = array(
    array( 'concept-marry-me.webp', 'Marry Me proposals', 'A private reveal, illuminated letters and sparkler moments can be planned around your setting.', 'Concept image of a seaside proposal with sparklers and illuminated letters' ),
    array( 'concept-daytime-colour.webp', 'Daytime colour', 'Colourful daytime effects offer a different kind of entrance or celebration moment.', 'Concept image of colourful daytime effects over a coastal venue' ),
    array( 'concept-floating-platform.webp', 'Over-water displays', 'Where a venue has no suitable firing location, a floating platform may be possible at additional cost.', 'Concept image of fireworks from a floating platform offshore' ),
);
?>
<section class="section special-effects"><div class="container">
<?php fp_title( 'Beyond the finale', 'Make the moment yours', 'Tell us the atmosphere you have in mind. These ideas are planned individually and depend on venue approval, availability and a written quote.' ); ?>
<div class="special-grid">
<?php foreach ( $ideas as $idea ) : ?>
<article class="special-card"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $idea[0] ); ?>" alt="<?php echo esc_attr( $idea[3] ); ?>" width="1672" height="941" loading="lazy" decoding="async"><div class="special-card-copy"><h3><?php echo esc_html( $idea[1] ); ?></h3><p><?php echo esc_html( $idea[2] ); ?></p></div></article>
<?php endforeach; ?>
</div><p class="small copy concept-disclosure">Concept imagery shows possibilities, not past Fireworks Phuket events or guaranteed package inclusions.</p>
</div></section>
