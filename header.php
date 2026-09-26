<?php defined( 'ABSPATH' ) || exit; ?><!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo( 'charset' ); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<a class="skip-link" href="#main">Skip to content</a>
<header class="site-header"><div class="header-inner">
<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Fireworks Phuket home">Fireworks <span>Phuket</span></a>
<button class="menu-toggle" aria-controls="primary-navigation" aria-expanded="false" hidden>Menu <span aria-hidden="true">☰</span></button>
<nav id="primary-navigation" aria-label="Main navigation"><?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'fallback_cb' => 'fp_menu_fallback', 'depth' => 2 ) ); ?></nav>
<a class="button header-cta" href="<?php echo esc_url( fp_contact_url() ); ?>"><?php echo get_theme_mod( 'fp_whatsapp', '' ) ? 'WhatsApp' : 'Get a Quote'; ?></a>
</div></header>
<main id="main">
