<?php defined( 'ABSPATH' ) || exit; ?>
<section class="section bordered"><div class="container"><?php fp_title( 'Made for your moment', 'Perfect for' ); ?><div class="grid three occasion-grid">
<?php foreach ( array( 'Wedding Fireworks', 'Marry Me Proposals', 'Birthday & Anniversary', 'Villa Parties', 'Resort Events', 'Corporate Events' ) as $i => $label ) : ?><div class="occasion"><span class="spark" aria-hidden="true">✧</span><div><h3><?php echo esc_html( $label ); ?></h3><span class="small">0<?php echo esc_html( $i + 1 ); ?></span></div></div><?php endforeach; ?>
</div></div></section>
