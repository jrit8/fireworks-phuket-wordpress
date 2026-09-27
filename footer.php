<?php defined( 'ABSPATH' ) || exit; ?></main>
<footer class="site-footer"><div class="container footer-grid">
<div><a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">Fireworks <span>Phuket</span></a><p class="copy">Professionally coordinated fireworks and fire dance shows for celebrations across Phuket, Khao Lak and Krabi.</p></div>
<div><p class="eyebrow">Explore</p><nav aria-label="Footer navigation"><?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'fallback_cb' => 'fp_menu_fallback', 'depth' => 1 ) ); ?></nav></div>
<div><p class="eyebrow">Start planning</p><a href="<?php echo esc_url( fp_contact_url() ); ?>"><?php echo esc_html( fp_contact_label() ); ?> →</a><p class="copy">Phuket · Khao Lak · Krabi</p></div>
</div><p class="container copyright">© <?php echo esc_html( wp_date( 'Y' ) ); ?> Fireworks Phuket. Shows subject to venue, location and approval requirements.</p><details class="container photo-credits"><summary>Photography credits</summary><p>Licensed real fireworks photographs used as display inspiration; they do not depict Fireworks Phuket bookings or confirm package inclusions. Images resized/compressed and displayed with responsive crops.</p><ul>
<li><a href="https://commons.wikimedia.org/wiki/File:Fireworks_on_Patong_beach.jpg">Fireworks on Patong beach</a> — Rene Ehrhardt, <a href="https://creativecommons.org/licenses/by/2.0/">CC BY 2.0</a>.</li>
<li><a href="https://commons.wikimedia.org/wiki/File:New_Year_fireworks_at_Phi_Phi_island_(31919929842).jpg">New Year fireworks at Phi Phi island</a> — Phuket@photographer.net, <a href="https://creativecommons.org/licenses/by/2.0/">CC BY 2.0</a>.</li>
<li><a href="https://commons.wikimedia.org/wiki/File:Fireworks_Thailand_2006.jpg">Fireworks Thailand 2006</a> — Natthawut Kulnirundorn, <a href="https://creativecommons.org/licenses/by-sa/2.5/">CC BY-SA 2.5</a>; the adapted image remains under this license.</li>
<li><a href="https://commons.wikimedia.org/wiki/File:Beach_Fireworks_FLL_2014_4x6_JTPI_8673_(14415619580).jpg">Beach Fireworks, Fort Lauderdale</a> — JTOcchialini, <a href="https://creativecommons.org/licenses/by/2.0/">CC BY 2.0</a>. Coastal display inspiration, photographed outside Thailand.</li>
</ul></details></footer>
<?php if ( ! is_page( 'contact' ) ) : ?><a class="mobile-cta button" href="<?php echo esc_url( fp_contact_url() ); ?>"><?php echo esc_html( fp_contact_label() ); ?></a>
<?php endif; ?>
<?php wp_footer(); ?></body></html>
