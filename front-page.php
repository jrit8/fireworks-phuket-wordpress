<?php
defined( 'ABSPATH' ) || exit;
get_header();
foreach ( array( 'hero', 'introduction', 'fire-shows', 'packages', 'special-effects', 'real-event', 'proposals', 'gallery', 'occasions', 'process', 'locations', 'wedding', 'safety', 'regulation', 'testimonials', 'faq', 'contact' ) as $section ) {
    get_template_part( 'template-parts/home', $section );
}
get_footer();
