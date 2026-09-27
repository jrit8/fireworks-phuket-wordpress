<?php defined( 'ABSPATH' ) || exit;
$event_page = fp_get_page( 'wim-marcia-beach-fire-show' );
if ( ! $event_page ) { return; }
?>
<section class="section real-event-preview"><div class="container real-event-preview-grid">
<div><p class="eyebrow"><?php esc_html_e( 'A real wedding, in pictures', 'fireworks-phuket' ); ?></p><h2><?php esc_html_e( 'Firelight by the sea.', 'fireworks-phuket' ); ?></h2></div>
<div><p class="copy"><?php esc_html_e( 'Explore Wim & Marcia’s beach wedding through two photographs from the PhuketWeds album: a fire-performance moment and a portrait surrounded by sparks.', 'fireworks-phuket' ); ?></p><a class="text-link" href="<?php echo esc_url( get_permalink( $event_page ) ); ?>"><?php esc_html_e( 'See the real-event feature →', 'fireworks-phuket' ); ?></a><p class="small copy"><?php esc_html_e( 'Past-event inspiration. Your show is planned and quoted for your own venue.', 'fireworks-phuket' ); ?></p></div>
</div></section>
