<?php
defined( 'ABSPATH' ) || exit;
add_action( 'customize_register', function ( $wp_customize ) {
    $wp_customize->add_section( 'fp_settings', array( 'title' => 'Fireworks Phuket', 'priority' => 30 ) );
    foreach ( array( 'whatsapp' => 'WhatsApp number (country code and digits only)', 'email' => 'Public inquiry email', 'hero_copy' => 'Homepage introduction' ) as $key => $label ) {
        $sanitize = 'email' === $key ? 'sanitize_email' : ( 'whatsapp' === $key ? 'fp_sanitize_phone' : 'sanitize_textarea_field' );
        $wp_customize->add_setting( 'fp_' . $key, array( 'sanitize_callback' => $sanitize ) );
        $wp_customize->add_control( 'fp_' . $key, array( 'label' => $label, 'section' => 'fp_settings', 'type' => 'hero_copy' === $key ? 'textarea' : 'text' ) );
    }
    foreach ( array( 'hero', 'wedding', 'villa', 'proposal' ) as $key ) {
        $wp_customize->add_setting( 'fp_image_' . $key, array( 'sanitize_callback' => 'absint' ) );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'fp_image_' . $key, array( 'label' => ucfirst( $key ) . ' image', 'section' => 'fp_settings', 'mime_type' => 'image' ) ) );
    }
} );
function fp_sanitize_phone( $value ) { return preg_replace( '/[^0-9]/', '', $value ); }
