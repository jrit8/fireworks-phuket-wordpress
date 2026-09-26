<?php defined( 'ABSPATH' ) || exit; $items = fp_items( 'faq' ); ?>
<section id="faq" class="section"><div class="container faq-grid"><?php fp_title( 'Details', 'Frequently asked questions' ); ?><div>
<?php if ( $items ) : foreach ( $items as $item ) : ?><details><summary><?php echo esc_html( $item->post_title ); ?></summary><div class="copy"><?php fp_item_content( $item ); ?></div></details><?php endforeach;
else : foreach ( fp_default_faqs() as $faq ) : ?><details><summary><?php echo esc_html( $faq[0] ); ?></summary><p class="copy"><?php echo esc_html( $faq[1] ); ?></p></details><?php endforeach; endif; ?>
</div></div></section>
