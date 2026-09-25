<?php defined( 'ABSPATH' ) || exit; get_header(); ?>
<?php while ( have_posts() ) : the_post(); $kind = fp_page_kind(); ?>
<?php if ( $kind ) : ?>
<section class="page-hero">
<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full', array( 'fetchpriority' => 'high', 'loading' => 'eager' ) ); } else { fp_image( 'wedding' === $kind ? 'wedding' : 'hero', 'Fireworks display inspiration in southern Thailand', true ); } ?>
<div class="hero-shade"></div><div class="container"><p class="eyebrow">Fireworks Phuket</p><h1><?php the_title(); ?></h1><?php if ( has_excerpt() ) : ?><p class="copy"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?></div></section>
<?php if ( get_the_content() ) : ?><section class="section"><div class="container editorial"><?php the_content(); wp_link_pages(); ?></div></section><?php endif; ?>
<?php if ( in_array( $kind, array( 'packages', 'gallery', 'locations', 'faq' ), true ) ) { get_template_part( 'template-parts/home', $kind ); } ?>
<?php if ( 'contact' === $kind ) { get_template_part( 'template-parts/quote-form' ); } else { get_template_part( 'template-parts/home', 'contact' ); } ?>
<?php else : ?><article class="container page-content"><h1><?php the_title(); ?></h1><?php the_content(); wp_link_pages(); ?></article><?php endif; ?>
<?php endwhile; get_footer(); ?>
