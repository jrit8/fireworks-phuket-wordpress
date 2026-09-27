<?php defined( 'ABSPATH' ) || exit;
$event_page = get_page_by_path( 'wim-marcia-beach-fire-show' );
if ( ! $event_page || 'publish' !== $event_page->post_status ) { return; }
?>
<section class="section real-event-preview"><div class="container real-event-preview-grid">
<div><p class="eyebrow">A real wedding, in pictures</p><h2>Firelight by the sea.</h2></div>
<div><p class="copy">Explore Wim &amp; Marcia's beach wedding through two photographs from the PhuketWeds album: a fire-performance moment and a portrait surrounded by sparks.</p><a class="text-link" href="<?php echo esc_url( get_permalink( $event_page ) ); ?>">See the real-event feature &rarr;</a><p class="small copy">Past-event inspiration. Your show is planned and quoted for your own venue.</p></div>
</div></section>
