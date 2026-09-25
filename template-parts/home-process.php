<?php defined( 'ABSPATH' ) || exit; ?>
<section class="section"><div class="container"><?php fp_title( 'Simple from start to finish', 'How it works' ); ?><ol class="steps">
<?php foreach ( array( 'Send us your date and venue', 'Choose your preferred display', 'We coordinate logistics and venue requirements', 'Enjoy the show' ) as $i => $step ) : ?><li><span>0<?php echo esc_html( $i + 1 ); ?></span><h3><?php echo esc_html( $step ); ?></h3></li><?php endforeach; ?>
</ol></div></section>
