<?php defined( 'ABSPATH' ) || exit; ?></main>
<footer class="site-footer"><div class="container footer-grid">
<div><a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">Fireworks <span>Phuket</span></a><p class="copy">Professionally coordinated fireworks for unforgettable celebrations across Phuket, Khao Lak and Krabi.</p></div>
<div><p class="eyebrow">Explore</p><nav aria-label="Footer navigation"><?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => 'fp_menu_fallback', 'depth' => 1 ) ); ?></nav></div>
<div><p class="eyebrow">Start planning</p><a href="<?php echo esc_url( fp_contact_url() ); ?>"><?php echo esc_html( fp_contact_label() ); ?> →</a><p class="copy">Phuket · Khao Lak · Krabi</p></div>
</div><p class="container copyright">© <?php echo esc_html( wp_date( 'Y' ) ); ?> Fireworks Phuket. Displays subject to venue, location and approval requirements.</p></footer>
<a class="mobile-cta button" href="<?php echo esc_url( fp_contact_url() ); ?>"><?php echo esc_html( fp_contact_label() ); ?></a>
<?php wp_footer(); ?></body></html>
