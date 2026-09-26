<?php defined( 'ABSPATH' ) || exit; $proposal_key = isset( $_GET['proposal'] ) && is_string( $_GET['proposal'] ) ? sanitize_key( wp_unslash( $_GET['proposal'] ) ) : ''; $proposal_labels = array( 'the-intimate-reveal' => 'The Intimate Reveal', 'the-sparkling-yes' => 'The Sparkling Yes', 'the-grand-proposal' => 'The Grand Proposal' ); $proposal = $proposal_labels[$proposal_key] ?? '';  $status = isset( $_GET['inquiry'] ) && is_string( $_GET['inquiry'] ) ? sanitize_key( wp_unslash( $_GET['inquiry'] ) ) : ''; ?>
<section class="section"><div class="container quote-grid" id="quote-form"><div><p class="eyebrow">Request a quote</p><h2>Tell us about your celebration.</h2><p class="copy">Share what you know so far. We’ll recommend a fireworks display, proposal package, fire dance show or a combination based on your date, venue and plans.</p><p>Phuket · Khao Lak · Krabi</p><?php if ( get_theme_mod( 'fp_whatsapp', '' ) ) : ?><a class="text-link" href="<?php echo esc_url( fp_contact_url() ); ?>">Prefer WhatsApp? Message us directly →</a><?php endif; ?></div><div>
<?php $messages = array( 'saved' => 'Your inquiry has been saved. Thank you for sharing your plans.', 'expired' => 'This form expired. Please enter your details and submit again.', 'invalid' => 'Please check your details, enter a valid upcoming date, provide a phone number or email, and tick the contact consent box.', 'wait' => 'Please wait a minute before sending another inquiry.', 'error' => 'We could not save your inquiry. Please try again.' ); ?>
<?php if ( isset( $messages[$status] ) ) : ?><p class="form-notice" role="status"><?php echo esc_html( $messages[$status] ); ?></p><?php endif; ?>
<?php if ( 'saved' !== $status ) : ?><form class="quote-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
<input type="hidden" name="action" value="fp_inquiry"><?php wp_nonce_field( 'fp_inquiry', 'fp_nonce' ); ?>
<div class="honeypot" aria-hidden="true"><label>Leave this empty<input name="website" type="text" tabindex="-1" autocomplete="off"></label></div>
<label>Name <span aria-hidden="true">*</span><input name="name" required autocomplete="name" maxlength="300"></label>
<label>WhatsApp / phone<input name="phone" type="tel" autocomplete="tel" maxlength="300"></label>
<label>Email<input name="email" type="email" autocomplete="email" maxlength="300"></label>
<label>Event date <span aria-hidden="true">*</span><input name="date" type="date" required min="<?php echo esc_attr( wp_date( 'Y-m-d' ) ); ?>"></label>
<label>Venue / location <span aria-hidden="true">*</span><input name="venue" required maxlength="300"></label>
<label>Interested in<select name="service"><option value="">Please select</option><option value="Proposal package" <?php selected( (bool) $proposal ); ?>>Proposal package</option><option value="Fireworks">Fireworks</option><option value="Fire dance show">Fire dance show</option><option value="Fireworks and fire dance show">Both fireworks and fire dance</option></select></label>
<label>Event type<input name="event" maxlength="300" value="<?php echo $proposal ? esc_attr( 'Marriage proposal — ' . $proposal ) : ''; ?>"></label>
<label>Approximate budget<input name="budget" maxlength="300"></label>
<label class="full">Tell us what you have in mind<textarea name="message" rows="5" maxlength="4000"></textarea></label>
<p class="small copy full">Please provide at least one contact method. Your details are saved privately in this website’s WordPress inquiry inbox so the team can respond.</p>
<label class="consent full"><input type="checkbox" name="consent" value="1" required><span>I agree to be contacted about this inquiry.</span></label>
<button class="button full" type="submit">Request a Quote →</button></form><?php endif; ?>
</div></div></section>
