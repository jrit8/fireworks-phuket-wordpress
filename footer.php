<?php defined( 'ABSPATH' ) || exit; ?></main>
<footer class="site-footer"><div class="container footer-grid">
<div><a class="brand" href="<?php echo esc_url( fp_home_url() ); ?>">Fireworks <span>Phuket</span></a><p class="copy"><?php esc_html_e( 'Professionally coordinated fireworks and fire dance shows for celebrations across Phuket, Khao Lak and Krabi.', 'fireworks-phuket' ); ?></p></div>
<div><p class="eyebrow"><?php esc_html_e( 'Explore', 'fireworks-phuket' ); ?></p><nav aria-label="<?php esc_attr_e( 'Footer navigation', 'fireworks-phuket' ); ?>"><?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => 'fp_menu_fallback', 'depth' => 1 ) ); ?></nav></div>
<div class="footer-booking"><p class="eyebrow"><?php esc_html_e( 'How to book', 'fireworks-phuket' ); ?></p>
<ol class="booking-steps">
<li><strong><?php esc_html_e( 'Send your enquiry', 'fireworks-phuket' ); ?></strong><p><?php esc_html_e( 'Use the form to share your date, venue and ideas.', 'fireworks-phuket' ); ?></p></li>
<li><strong><?php esc_html_e( 'Plan the details', 'fireworks-phuket' ); ?></strong><p><?php esc_html_e( 'We review your plans and follow up by email or your preferred app.', 'fireworks-phuket' ); ?></p></li>
<li><strong><?php esc_html_e( 'Confirm your celebration', 'fireworks-phuket' ); ?></strong><p><?php esc_html_e( 'Review your written quote, then agree the booking terms, venue requirements and timing with us.', 'fireworks-phuket' ); ?></p></li>
</ol><a class="text-link" href="<?php echo esc_url( fp_contact_url() ); ?>"><?php echo esc_html( fp_contact_label() ); ?> →</a>
<?php fp_chat_apps(); fp_language_switcher( 'footer-lang' ); ?></div>
</div><p class="container copyright">© <?php echo esc_html( wp_date( 'Y' ) ); ?> Fireworks Phuket. <?php esc_html_e( 'Shows subject to venue, location and approval requirements.', 'fireworks-phuket' ); ?></p></footer>
<?php if ( ! fp_is_page( 'contact' ) ) : ?><a class="mobile-cta button" href="<?php echo esc_url( fp_contact_url() ); ?>"><?php echo esc_html( fp_contact_label() ); ?></a>
<?php endif; ?>
<?php wp_footer(); ?></body></html>
