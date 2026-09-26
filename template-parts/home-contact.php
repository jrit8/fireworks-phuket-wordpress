<?php defined( 'ABSPATH' ) || exit; $phone = get_theme_mod( 'fp_whatsapp', '' ); $email = sanitize_email( get_theme_mod( 'fp_email', '' ) ); ?>
<section id="contact" class="section panel contact"><div class="container"><p class="eyebrow">Your celebration, beautifully handled</p><h2>Planning Something Special?</h2><p class="copy">Send us your date, venue and idea and we’ll recommend a fireworks display, fire dance show or both.</p><div class="actions">
<?php if ( $phone ) : ?><a class="button" href="<?php echo esc_url( fp_contact_url() ); ?>">WhatsApp Us →</a><?php endif; ?>
<?php if ( $email ) : ?><a class="button outline" href="<?php echo esc_url( 'mailto:' . $email ); ?>">Email your event details</a><?php endif; ?>
<?php $contact_page = get_page_by_path( 'contact' ); if ( $contact_page && 'publish' === $contact_page->post_status ) : ?><a class="button outline" href="<?php echo esc_url( get_permalink( $contact_page ) ); ?>">Request a Quote</a><?php elseif ( ! $phone && ! $email ) : ?><p>Online inquiries will be available soon.</p><?php endif; ?>
</div></div></section>
