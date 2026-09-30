<?php defined( 'ABSPATH' ) || exit; get_header(); ?>
<?php while ( have_posts() ) : the_post(); $kind = fp_page_kind(); ?>
<?php if ( $kind ) : ?>
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
<?php if ( in_array( $kind, array( 'real-event', 'contact' ), true ) ) : ?>
<section class="event-heading container"><p class="eyebrow"><?php echo esc_html( 'contact' === $kind ? __( 'Plan your celebration', 'fireworks-phuket' ) : __( 'From the PhuketWeds album', 'fireworks-phuket' ) ); ?></p><h1><?php the_title(); ?></h1><p class="copy"><?php echo esc_html( get_the_excerpt() ); ?></p></section>
<?php else : ?>
<section class="page-hero">
<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'full', array( 'fetchpriority' => 'high', 'loading' => 'eager' ) ); } elseif ( 'proposals' === $kind ) { echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/concept-fire-letters.webp' ) . '" alt="' . esc_attr__( 'Concept of MARRY ME fire letters on a beach at dusk', 'fireworks-phuket' ) . '" width="1672" height="941" fetchpriority="high">'; } elseif ( 'fire-shows' === $kind ) { echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/phuketweds-fire-show.jpg' ) . '" alt="' . esc_attr__( 'Fire dance performance at a PhuketWeds wedding reception', 'fireworks-phuket' ) . '" width="1336" height="452" fetchpriority="high">'; } else { fp_image( 'wedding' === $kind ? 'wedding' : 'hero', __( 'Fireworks display inspiration in southern Thailand', 'fireworks-phuket' ), true ); } ?>
<div class="hero-shade"></div><div class="container"><p class="eyebrow">Fireworks Phuket</p><h1><?php the_title(); ?></h1><?php if ( has_excerpt() ) : ?><p class="copy"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?></div></section>
<?php endif; ?>
<?php if ( get_the_content() ) : ?><section class="section"><div class="container editorial"><?php the_content(); wp_link_pages(); ?></div></section><?php endif; ?>
<?php if ( in_array( $kind, array( 'packages', 'fire-shows', 'proposals', 'gallery', 'locations', 'faq' ), true ) ) { get_template_part( 'template-parts/home', $kind ); } ?>
<?php if ( 'gallery' === $kind ) : ?><section class="section"><div class="container"><p class="eyebrow"><?php esc_html_e( 'Real wedding moments', 'fireworks-phuket' ); ?></p><h2><?php esc_html_e( 'Fire performances by the sea', 'fireworks-phuket' ); ?></h2><?php get_template_part( 'template-parts/fire-event-gallery' ); ?><a class="text-link" href="<?php echo esc_url( fp_page_url( 'fire-shows' ) ); ?>"><?php esc_html_e( 'Explore fire dance shows →', 'fireworks-phuket' ); ?></a></div></section><?php endif; ?>
<?php if ( 'contact' === $kind ) { get_template_part( 'template-parts/quote-form' ); } else { get_template_part( 'template-parts/home', 'contact' ); } ?>
<?php else : ?><article class="container page-content"><h1><?php the_title(); ?></h1><?php the_content(); wp_link_pages(); ?></article><?php endif; ?>
<?php endwhile; get_footer(); ?>
