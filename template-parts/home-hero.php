<?php defined( 'ABSPATH' ) || exit; ?>
<section class="hero">
<?php fp_image( 'hero', __( 'Fireworks photographed at Patong Beach by Rene Ehrhardt', 'fireworks-phuket' ), true ); ?><div class="hero-shade"></div>
<div class="container hero-content"><p class="eyebrow"><?php esc_html_e( 'Phuket · Khao Lak · Krabi', 'fireworks-phuket' ); ?></p><h1><?php echo wp_kses_post( __( 'Professional<br><em>Fireworks</em> in Phuket', 'fireworks-phuket' ) ); ?></h1>
<p class="hero-copy"><?php $hero_copy = 'en' === fp_lang() ? get_theme_mod( 'fp_hero_copy', '' ) : ''; echo esc_html( $hero_copy ? $hero_copy : __( 'Spectacular fireworks displays for weddings, proposals, private events and celebrations across Phuket, Khao Lak & Krabi.', 'fireworks-phuket' ) ); ?></p>
<div class="actions"><a class="button" href="<?php echo esc_url( fp_contact_url() ); ?>"><?php echo esc_html( fp_contact_label() ); ?></a><a class="button outline" href="<?php echo esc_url( fp_page_url( 'packages', 'packages' ) ); ?>"><?php esc_html_e( 'View Packages →', 'fireworks-phuket' ); ?></a></div>
<p class="trust"><?php esc_html_e( 'Professional displays', 'fireworks-phuket' ); ?> <span>•</span> <?php esc_html_e( 'Venue coordination', 'fireworks-phuket' ); ?> <span>•</span> <?php esc_html_e( 'Experienced local operators', 'fireworks-phuket' ); ?></p></div>
<a class="discover" href="#why" aria-label="<?php esc_attr_e( 'Scroll to discover', 'fireworks-phuket' ); ?>">↓</a></section>
