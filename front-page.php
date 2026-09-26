<?php
defined( 'ABSPATH' ) || exit;
get_header();
foreach ( array( 'hero', 'introduction', 'packages', 'fire-shows', 'proposals', 'gallery', 'special-effects', 'occasions', 'process', 'locations', 'wedding', 'safety', 'testimonials', 'faq', 'contact' ) as $section ) {
    get_template_part( 'template-parts/home', $section );
}
get_footer();
