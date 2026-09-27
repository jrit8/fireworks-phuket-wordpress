<?php defined( 'ABSPATH' ) || exit; ?>
<section id="locations" class="section panel"><div class="container"><?php fp_title( __( 'Destination coverage', 'fireworks-phuket' ), __( 'Across southern Thailand', 'fireworks-phuket' ), __( 'Availability and pricing depend on the venue, access and proposed firing location.', 'fireworks-phuket' ) ); ?><div class="grid three location-grid">
<?php foreach ( array( 'phuket' => __( 'Phuket', 'fireworks-phuket' ), 'khao-lak' => __( 'Khao Lak', 'fireworks-phuket' ), 'krabi' => __( 'Krabi', 'fireworks-phuket' ) ) as $key => $name ) : ?><a class="location-text-card" href="<?php echo esc_url( fp_page_url( $key . '-fireworks', 'locations' ) ); ?>"><h3 ><?php echo esc_html( $name ); ?></h3></a><?php endforeach; ?>
</div></div></section>
