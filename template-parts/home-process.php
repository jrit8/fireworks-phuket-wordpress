<?php defined( 'ABSPATH' ) || exit; ?>
<section class="section"><div class="container"><?php fp_title( __( 'Simple from start to finish', 'fireworks-phuket' ), __( 'How it works', 'fireworks-phuket' ) ); ?><ol class="steps">
<?php foreach ( array( __( 'Send us your date and venue', 'fireworks-phuket' ), __( 'Choose your preferred display', 'fireworks-phuket' ), __( 'We coordinate logistics and venue requirements', 'fireworks-phuket' ), __( 'Enjoy the show', 'fireworks-phuket' ) ) as $i => $step ) : ?><li><span>0<?php echo esc_html( $i + 1 ); ?></span><h3><?php echo esc_html( $step ); ?></h3></li><?php endforeach; ?>
</ol></div></section>
