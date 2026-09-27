<?php defined( 'ABSPATH' ) || exit; ?><!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo( 'charset' ); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'fireworks-phuket' ); ?></a>
<header class="site-header"><div class="header-inner">
<a class="brand" href="<?php echo esc_url( fp_home_url() ); ?>" aria-label="<?php esc_attr_e( 'Fireworks Phuket home', 'fireworks-phuket' ); ?>">Fireworks <span>Phuket</span></a>
<button class="menu-toggle" aria-controls="primary-navigation" aria-expanded="false" hidden><?php esc_html_e( 'Menu', 'fireworks-phuket' ); ?> <span aria-hidden="true">☰</span></button>
<nav id="primary-navigation" aria-label="<?php esc_attr_e( 'Main navigation', 'fireworks-phuket' ); ?>"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => 'fp_menu_fallback', 'depth' => 2 ) ); ?></nav>
<?php fp_language_switcher( 'header-lang' ); ?>
<a class="button header-cta" href="<?php echo esc_url( fp_contact_url() ); ?>"><?php echo esc_html( fp_contact_label() ); ?></a>
</div></header>
<main id="main">
