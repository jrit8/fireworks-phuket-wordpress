<?php defined( 'ABSPATH' ) || exit; $proposal_key = isset( $_GET['proposal'] ) && is_string( $_GET['proposal'] ) ? sanitize_key( wp_unslash( $_GET['proposal'] ) ) : ''; $proposal_labels = array( 'the-intimate-reveal' => 'The Intimate Reveal', 'the-sparkling-yes' => 'The Sparkling Yes', 'the-grand-proposal' => 'The Grand Proposal' ); $proposal = $proposal_labels[$proposal_key] ?? ''; $fire_key = isset( $_GET['fire_show'] ) && is_string( $_GET['fire_show'] ) ? sanitize_key( wp_unslash( $_GET['fire_show'] ) ) : ''; $fire_labels = array( '2' => 'Duo Rhythm — 2 dancers', '3' => 'Choreographed Trio — 3 dancers', '4' => 'Ensemble — 4 dancers', '5' => 'Signature Troupe — 5 dancers' ); $fire_show = $proposal ? '' : ( $fire_labels[$fire_key] ?? '' );  $status = isset( $_GET['inquiry'] ) && is_string( $_GET['inquiry'] ) ? sanitize_key( wp_unslash( $_GET['inquiry'] ) ) : ''; ?>
<?php
$package_key = isset( $_GET['package'] ) && is_string( $_GET['package'] ) ? sanitize_title( wp_unslash( $_GET['package'] ) ) : '';
$package_label = '';
if ( ! $proposal && ! $fire_show && $package_key ) {
    $package_items = fp_items( 'package' );
    foreach ( $package_items as $package_item ) {
        if ( $package_item->post_name === $package_key ) { $package_label = $package_item->post_title; break; }
    }
    if ( ! $package_items ) { $package_label = array( 'classic' => 'Classic', 'signature' => 'Signature', 'grand' => 'Grand' )[$package_key] ?? ''; }
}
?>
<section class="section"><div class="container quote-grid" id="quote-form"><div><p class="eyebrow">Request a quote</p><h2>Tell us about your celebration.</h2><p class="copy">Share what you know so far. We’ll recommend a fireworks display, proposal package, fire dance show or a combination based on your date, venue and plans.</p><p>Phuket · Khao Lak · Krabi</p></div><div>
<?php $messages = array( 'saved' => 'Thank you — your inquiry is saved. Our team will review your plans and contact you using the details you provided.', 'expired' => 'This form expired. Please enter your details and submit again.', 'invalid' => 'Please check your details, enter a valid upcoming date, provide a phone number or email.', 'wait' => 'Please wait a minute before sending another inquiry.', 'error' => 'We could not save your inquiry. Please try again.' ); ?>
<?php if ( isset( $messages[$status] ) ) : ?><p class="form-notice" role="status"><?php echo esc_html( $messages[$status] ); ?></p><?php endif; ?>
<?php if ( 'saved' !== $status ) : ?><form class="quote-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
<input type="hidden" name="action" value="fp_inquiry"><?php wp_nonce_field( 'fp_inquiry', 'fp_nonce' ); ?>
<div class="honeypot" aria-hidden="true"><label>Leave this empty<input name="website" type="text" tabindex="-1" autocomplete="off"></label></div>
<label>Name <span aria-hidden="true">*</span><input name="name" required autocomplete="name" maxlength="300"></label>
<label>Phone / WhatsApp<input name="phone" type="tel" autocomplete="tel" maxlength="300"></label>
<label>Email<input name="email" type="email" autocomplete="email" maxlength="300"></label>
<label>Event date <span aria-hidden="true">*</span><input name="date" type="date" required min="<?php echo esc_attr( wp_date( 'Y-m-d' ) ); ?>"></label>
<label>Venue / location <span aria-hidden="true">*</span><input name="venue" required maxlength="300"></label>
<label>Interested in<select name="service"><option value="">Please select</option><option value="Proposal package" <?php selected( (bool) $proposal ); ?>>Proposal package</option><option value="Fireworks" <?php selected( (bool) $package_label ); ?>>Fireworks</option><option value="Fire dance show" <?php selected( (bool) $fire_show ); ?>>Fire dance show</option><option value="Fireworks and fire dance show">Both fireworks and fire dance</option></select></label>
<label>Event type<input name="event" maxlength="300" value="<?php echo $proposal ? esc_attr( 'Marriage proposal — ' . $proposal ) : ''; ?>"></label>
<label>Approximate budget<input name="budget" maxlength="300"></label>
<label class="full">Tell us what you have in mind<textarea name="message" rows="5" maxlength="4000"></textarea></label>
<p class="small copy full">Please provide at least one contact method. We’ll use your details to respond to your inquiry.</p>
<button class="button full" type="submit">Request a Quote →</button></form><?php endif; ?>
<p class="small copy" style="margin-top:24px"><?php if ( get_theme_mod( 'fp_whatsapp', '' ) ) : ?><a class="text-link" href="<?php echo esc_url( fp_whatsapp_url() ); ?>">Prefer WhatsApp? Message us directly →</a><?php endif; ?></p></div></div></section>
