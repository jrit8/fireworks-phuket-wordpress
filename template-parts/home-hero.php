<?php defined( 'ABSPATH' ) || exit; ?>
<section class="hero">
<div class="hero-media">
<?php fp_image( 'hero', __( 'Fireworks over Patong Beach at night', 'fireworks-phuket' ), true ); ?>
<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/phuketweds-fire-show.jpg' ); ?>" alt="<?php esc_attr_e( 'Fire dance performance on a Phuket beach', 'fireworks-phuket' ); ?>" width="1336" height="452" loading="eager" decoding="async">
</div><div class="hero-shade"></div>
<div class="container hero-content"><p class="eyebrow"><?php esc_html_e( 'Phuket · Khao Lak · Krabi', 'fireworks-phuket' ); ?></p><h1><?php echo wp_kses_post( __( 'Fireworks &amp;<br><em>Fire Dance Shows</em><br>in Phuket', 'fireworks-phuket' ) ); ?></h1>
<p class="hero-copy"><?php esc_html_e( 'Fireworks displays and live fire dance shows for weddings, proposals and private events across Phuket, Khao Lak and Krabi.', 'fireworks-phuket' ); ?></p>
<div class="actions"><a class="button" href="<?php echo esc_url( fp_contact_url() ); ?>"><?php echo esc_html( fp_contact_label() ); ?></a><a class="button outline" href="<?php echo esc_url( fp_page_url( 'packages', 'packages' ) ); ?>"><?php esc_html_e( 'Explore fireworks →', 'fireworks-phuket' ); ?></a><a class="button outline" href="<?php echo esc_url( fp_page_url( 'fire-shows', 'fire-shows' ) ); ?>"><?php esc_html_e( 'Explore fire dance →', 'fireworks-phuket' ); ?></a></div>
<p class="trust"><?php esc_html_e( 'Professional displays & performances', 'fireworks-phuket' ); ?> <span>•</span> <?php esc_html_e( 'Venue coordination', 'fireworks-phuket' ); ?> <span>•</span> <?php esc_html_e( 'Experienced local operators', 'fireworks-phuket' ); ?></p></div>
<a class="discover" href="#why" aria-label="<?php esc_attr_e( 'Scroll to discover', 'fireworks-phuket' ); ?>">↓</a></section>
