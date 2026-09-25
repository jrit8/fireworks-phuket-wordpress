<?php defined( 'ABSPATH' ) || exit; ?>
<section id="locations" class="section panel"><div class="container"><?php fp_title( 'Destination coverage', 'Across southern Thailand', 'Availability and pricing depend on the venue, access and proposed firing location.' ); ?><div class="grid three location-grid">
<?php foreach ( array( 'hero' => 'Phuket', 'wedding' => 'Khao Lak', 'villa' => 'Krabi' ) as $key => $name ) : ?><a class="image-card" href="<?php echo esc_url( fp_contact_url() ); ?>"><?php fp_image( $key, 'Fireworks display inspiration for ' . $name ); ?><h3 class="image-caption"><?php echo esc_html( $name ); ?></h3></a><?php endforeach; ?>
</div></div></section>
