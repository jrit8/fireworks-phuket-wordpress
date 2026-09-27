<?php defined( 'ABSPATH' ) || exit; ?>
<section id="locations" class="section panel"><div class="container"><?php fp_title( 'Destination coverage', 'Across southern Thailand', 'Availability and pricing depend on the venue, access and proposed firing location.' ); ?><div class="grid three location-grid">
<?php foreach ( array( 'hero' => 'Phuket', 'wedding' => 'Khao Lak', 'villa' => 'Krabi' ) as $key => $name ) : ?><a class="location-text-card" href="<?php echo esc_url( fp_page_url( sanitize_title( $name ) . '-fireworks', 'locations' ) ); ?>"><h3 ><?php echo esc_html( $name ); ?></h3></a><?php endforeach; ?>
</div></div></section>
