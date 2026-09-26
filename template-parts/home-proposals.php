<?php defined( 'ABSPATH' ) || exit;
$proposal_options = array(
    array( 'The Intimate Reveal', 'concept-fire-letters.webp', 'Concept of MARRY ME spelled in fire letters on a beach at dusk', 'A personal proposal centred on a “Marry Me” reveal. Ask about fire letters, an illuminated alternative and a discreetly coordinated cue.', 'Tailored quote', 'Letters, location and setup quoted to suit your plans.' ),
    array( 'The Sparkling Yes', 'concept-marry-me.webp', 'Concept of a romantic proposal with illuminated letters and sparklers', 'Pair your proposal reveal with a private fireworks moment. Sparklers, letters, flowers or photography can be discussed as separate additions.', 'Fireworks guide: ฿40,000+', 'Proposal setup and all extras quoted separately.' ),
    array( 'The Grand Proposal', 'proposal-fireworks.jpg', 'Fireworks inspiration for a larger proposal finale', 'Build a fuller celebration around your big question, with a larger fireworks finale and optional live fire performance.', 'Fireworks guide: ฿70,000+', 'Fire performance, proposal setup and extras quoted separately.' ),
);
?>
<section id="proposals" class="section proposals bordered"><div class="container">
<?php fp_title( 'Make the question unforgettable', 'Proposal packages in Phuket', 'Three starting points for your “Marry Me” moment. Choose the feeling you want, then we will shape a written proposal around your venue, date and budget.' ); ?>
<div class="proposal-grid">
<?php foreach ( $proposal_options as $option ) : ?>
<article class="proposal-card"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $option[1] ); ?>" alt="<?php echo esc_attr( $option[2] ); ?>" width="1600" height="900" loading="lazy" decoding="async"><div class="proposal-card-copy"><h3><?php echo esc_html( $option[0] ); ?></h3><p class="copy"><?php echo esc_html( $option[3] ); ?></p><p class="proposal-price"><?php echo esc_html( $option[4] ); ?></p><p class="small copy"><?php echo esc_html( $option[5] ); ?></p><a class="text-link" href="<?php echo esc_url( add_query_arg( 'proposal', sanitize_title( $option[0] ), fp_page_url( 'contact', 'contact' ) ) . '#quote-form' ); ?>">Plan this proposal →</a></div></article>
<?php endforeach; ?>
</div><p class="small copy concept-disclosure">Images show concept and display inspiration, not guaranteed package inclusions. Fire-letter and sparkler options depend on venue approval and supplier availability. The fireworks guides exclude 7% VAT, permission fees, venue charges and special logistics; a full proposal total is confirmed in writing.</p>
<?php if ( ! is_page( 'proposals' ) ) : ?><p class="proposal-more"><a class="text-link" href="<?php echo esc_url( fp_page_url( 'proposals', 'proposals' ) ); ?>">Explore proposal packages →</a></p><?php endif; ?>
</div></section>
