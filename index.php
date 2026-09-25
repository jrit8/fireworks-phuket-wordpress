<?php defined( 'ABSPATH' ) || exit; get_header(); ?>
<div class="container page-content">
<?php if ( have_posts() ) : ?>
<?php if ( is_home() && ! is_front_page() ) : ?><h1><?php single_post_title(); ?></h1><?php elseif ( is_archive() ) : ?><h1><?php the_archive_title(); ?></h1><?php elseif ( is_search() ) : ?><h1><?php printf( esc_html__( 'Search results for: %s', 'fireworks-phuket' ), esc_html( get_search_query() ) ); ?></h1><?php endif; ?>
<?php while ( have_posts() ) : the_post(); ?><article <?php post_class(); ?>>
<?php if ( is_singular() ) : ?><h1><?php the_title(); ?></h1><?php the_content(); wp_link_pages(); ?>
<?php else : ?><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); endif; ?>
</article><?php endwhile; the_posts_pagination(); ?>
<?php else : ?><h1>Nothing found</h1><p>Please try another search.</p><?php get_search_form(); endif; ?>
</div><?php get_footer(); ?>
