<?php defined( 'ABSPATH' ) || exit; $items = fp_items( 'testimonial' ); if ( ! $items ) { return; } ?>
<section class="section panel"><div class="container"><?php fp_title( 'Client stories', 'Celebrations remembered' ); ?><div class="grid three">
<?php foreach ( $items as $item ) : ?><blockquote class="review"><div><?php fp_item_content( $item ); ?></div><footer><?php echo esc_html( $item->post_title ); ?></footer></blockquote><?php endforeach; ?>
</div></div></section>
