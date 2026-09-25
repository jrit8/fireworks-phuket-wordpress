<?php defined( 'ABSPATH' ) || exit; $items = fp_items( 'gallery' ); ?>
<section id="gallery" class="section"><div class="container"><?php fp_title( 'Real celebrations', 'A moment no one forgets' ); ?>
<div class="gallery-grid">
<?php if ( $items ) : foreach ( $items as $item ) : ?>
<article class="image-card"><?php echo get_the_post_thumbnail( $item, 'large', array( 'loading' => 'lazy' ) ); ?><div class="image-caption"><h3><?php echo esc_html( $item->post_title ); ?></h3><div><?php fp_item_content( $item ); ?></div></div></article>
<?php endforeach; else : foreach ( array( 'wedding' => 'Weddings', 'proposal' => 'Proposals', 'villa' => 'Villa & resort events' ) as $key => $label ) : ?>
<article class="image-card"><?php fp_image( $key, $label . ' fireworks in Phuket' ); ?><h3 class="image-caption"><?php echo esc_html( $label ); ?></h3></article>
<?php endforeach; endif; ?></div><div class="tags"><span>Weddings</span><span>Proposals</span><span>Beach events</span><span>Villa events</span><span>Resort celebrations</span></div></div></section>
