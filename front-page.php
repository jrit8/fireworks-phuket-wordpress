<?php
defined( 'ABSPATH' ) || exit;
get_header();
foreach ( array( 'hero', 'introduction', 'special-effects', 'packages', 'fire-shows', 'proposals', 'gallery', 'occasions', 'process', 'locations', 'wedding', 'safety', 'testimonials', 'faq', 'contact' ) as $section ) {
    get_template_part( 'template-parts/home', $section );
}
get_footer();
