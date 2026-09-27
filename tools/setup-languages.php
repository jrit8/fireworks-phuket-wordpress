<?php
/**
 * Set up English, Russian, Chinese and Thai with Polylang and create the translated
 * pages and packages from tools/translations/content-{lang}.php.
 *
 * Run (Polylang must be active):
 *   wp eval-file wp-content/themes/fireworks-phuket-wordpress/tools/setup-languages.php
 *
 * Safe to re-run: existing languages and translations are never overwritten.
 * To re-import a translation, delete that translated page first.
 */
if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) { exit; }
if ( ! function_exists( 'PLL' ) || ! function_exists( 'pll_save_post_translations' ) ) {
    WP_CLI::error( 'Polylang is not active. Run: wp plugin activate polylang' );
}

$languages = array(
    array( 'name' => 'English', 'slug' => 'en', 'locale' => 'en_US', 'flag' => 'us', 'term_group' => 0 ),
    array( 'name' => 'Русский', 'slug' => 'ru', 'locale' => 'ru_RU', 'flag' => 'ru', 'term_group' => 1 ),
    array( 'name' => '中文 (简体)', 'slug' => 'zh', 'locale' => 'zh_CN', 'flag' => 'cn', 'term_group' => 2 ),
    array( 'name' => 'ไทย', 'slug' => 'th', 'locale' => 'th', 'flag' => 'th', 'term_group' => 3 ),
);
$translatable_types = array( 'fp_package', 'fp_faq', 'fp_gallery', 'fp_testimonial' );

// 1. Languages (English first, so it becomes the default).
$model = PLL()->model;
foreach ( $languages as $language ) {
    if ( $model->get_language( $language['slug'] ) ) { WP_CLI::log( 'Language exists: ' . $language['slug'] ); continue; }
    $result = $model->add_language( $language + array( 'rtl' => false ) );
    if ( is_wp_error( $result ) ) { WP_CLI::error( $language['slug'] . ': ' . $result->get_error_message() ); }
    WP_CLI::log( 'Added language: ' . $language['slug'] );
}
$model->clean_languages_cache();

// 2. Settings: English at the root, others in /ru/ /zh/ /th/; no automatic browser redirects;
//    theme content types translatable; prices, page kinds, images and order shared across translations.
$settings = array(
    'force_lang' => 1, 'hide_default' => true, 'rewrite' => true, 'redirect_lang' => false,
    'browser' => false, 'media_support' => false,
    'post_types' => $translatable_types,
    'sync' => array( 'post_meta', '_thumbnail_id', 'menu_order', 'page_template', 'post_parent' ),
);
$options = PLL()->options;
if ( is_object( $options ) && method_exists( $options, 'set' ) ) {
    foreach ( $settings as $key => $value ) {
        $errors = $options->set( $key, $value );
        if ( is_wp_error( $errors ) && $errors->has_errors() ) { WP_CLI::warning( $key . ': ' . $errors->get_error_message() ); }
    }
    if ( method_exists( $options, 'save' ) ) { $options->save(); }
} else {
    update_option( 'polylang', array_merge( (array) get_option( 'polylang', array() ), $settings ) );
}
flush_rewrite_rules();

// 3. Existing content without a language is English.
$untagged = get_posts( array( 'post_type' => array_merge( array( 'page', 'post' ), $translatable_types ), 'post_status' => 'any', 'numberposts' => -1, 'fields' => 'ids', 'lang' => '' ) );
foreach ( $untagged as $id ) {
    if ( ! pll_get_post_language( $id ) ) { pll_set_post_language( $id, 'en' ); }
}
foreach ( get_terms( array( 'taxonomy' => array( 'category', 'post_tag' ), 'hide_empty' => false, 'lang' => '' ) ) as $term ) {
    if ( ! pll_get_term_language( $term->term_id ) ) { pll_set_term_language( $term->term_id, 'en' ); }
}
WP_CLI::log( 'Tagged existing content as English.' );

// 4. Translated pages and packages.
function fp_setup_source( $key ) {
    if ( 0 === strpos( $key, 'package:' ) ) { return get_page_by_path( substr( $key, 8 ), OBJECT, 'fp_package' ); }
    return get_page_by_path( $key );
}
$created = array();
foreach ( array( 'ru', 'zh', 'th' ) as $lang ) {
    $file = __DIR__ . '/translations/content-' . $lang . '.php';
    if ( ! file_exists( $file ) ) { WP_CLI::warning( 'Missing ' . $file ); continue; }
    foreach ( include $file as $key => $data ) {
        $source = fp_setup_source( $key );
        if ( ! $source ) { WP_CLI::warning( "No English source for $key" ); continue; }
        if ( pll_get_post( $source->ID, $lang ) ) { WP_CLI::log( "Exists: $lang $key" ); continue; }
        $id = wp_insert_post( array(
            'post_type' => $source->post_type, 'post_status' => $source->post_status, 'post_name' => $source->post_name,
            'post_title' => $data['title'], 'post_excerpt' => $data['excerpt'], 'post_content' => $data['content'],
            'menu_order' => $source->menu_order, 'post_parent' => $source->post_parent, 'post_author' => $source->post_author,
        ), true );
        if ( is_wp_error( $id ) ) { WP_CLI::error( "$lang $key: " . $id->get_error_message() ); }
        pll_set_post_language( $id, $lang );
        $translations = pll_get_post_translations( $source->ID );
        $translations[ $lang ] = $id;
        pll_save_post_translations( $translations );
        // WordPress may have made the slug unique (e.g. "packages-2"); use a readable per-language slug instead.
        if ( get_post_field( 'post_name', $id ) !== $source->post_name ) {
            wp_update_post( array( 'ID' => $id, 'post_name' => $source->post_name . '-' . $lang ) );
        }
        foreach ( array( '_fp_kind', '_fp_start_price', '_thumbnail_id', '_wp_page_template' ) as $meta ) {
            $value = get_post_meta( $source->ID, $meta, true );
            if ( '' !== $value ) { update_post_meta( $id, $meta, $value ); }
        }
        $created[] = array( $id, $lang );
        WP_CLI::log( "Created $lang $key #$id (" . get_post_field( 'post_name', $id ) . ')' );
    }
}

// 5. Point {{english-slug}} placeholders at the page in the same language.
foreach ( $created as list( $id, $lang ) ) {
    $content = get_post_field( 'post_content', $id );
    $linked = preg_replace_callback( '/\{\{([a-z0-9-]+)\}\}/', function ( $match ) use ( $lang ) {
        $page = get_page_by_path( $match[1] );
        if ( ! $page ) { return home_url( '/' ); }
        $translated = pll_get_post( $page->ID, $lang );
        return wp_make_link_relative( get_permalink( $translated ? $translated : $page->ID ) );
    }, $content );
    if ( $linked !== $content ) { wp_update_post( array( 'ID' => $id, 'post_content' => $linked ) ); }
}
flush_rewrite_rules();
WP_CLI::success( count( $created ) . ' translations created.' );
