<?php
defined( 'ABSPATH' ) || exit;
// Content remains stored in the database if the theme changes. Register these
// types in a companion plugin before switching themes to retain the editing UI.
add_action( 'init', function () {
    foreach ( array( 'package' => 'Packages', 'faq' => 'FAQs', 'testimonial' => 'Testimonials', 'gallery' => 'Gallery items' ) as $key => $label ) {
        register_post_type( 'fp_' . $key, array(
            'label' => $label, 'public' => false, 'show_ui' => true,
            'show_in_rest' => true, 'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'menu_icon' => 'dashicons-star-filled', 'map_meta_cap' => true,
        ) );
    }
} );
function fp_items( $type ) {
    return get_posts( array( 'post_type' => 'fp_' . $type, 'post_status' => 'publish', 'numberposts' => -1, 'orderby' => array( 'menu_order' => 'ASC', 'date' => 'ASC' ) ) );
}
function fp_item_content( $item ) {
    echo apply_filters( 'the_content', $item->post_content );
}
function fp_default_faqs() {
    return array(
        array( 'How much do fireworks cost in Phuket?', 'Pricing depends on the venue, firing location, display duration, show design, access and any required permissions. Share your details and we’ll recommend a suitable option.' ),
        array( 'How long does a display last?', 'Display lengths vary by package and pacing. We’ll help you select the right duration and finale for your event timeline.' ),
        array( 'Can fireworks be arranged at any hotel or beach?', 'Not every location is suitable. Venue rules, firing position, access, surroundings and approvals are checked before confirmation.' ),
        array( 'Can you arrange fireworks for a proposal?', 'Yes. We can plan the timing discreetly and coordinate with your photographer, planner or venue team.' ),
        array( 'Do you also cover Khao Lak and Krabi?', 'Yes, subject to venue suitability, operator availability and the proposed firing location.' ),
        array( 'How far in advance should I book?', 'Earlier is always better, especially for peak wedding dates. Contact us as soon as your date and venue are known.' ),
        array( 'Can you coordinate directly with my wedding planner or hotel?', 'Yes. We can liaise directly with your planner, hotel or venue team to align timing, access and requirements.' ),
    );
}
