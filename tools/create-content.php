<?php
// Run only with wp eval-file. Creates missing pages; never overwrites site content.
if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) { exit; }
$pages = array(
  'proposals' => array('Marriage Proposal Packages in Phuket', 'proposals', 'Plan a private proposal with Marry Me fire letters, sparklers and optional fireworks. Explore three starting points, with every detail quoted for your venue.', ''),
  'packages' => array('Fireworks Packages', 'packages', 'Choose a starting point, then let us shape the display around your venue, timeline and celebration.', ''),
  'fire-shows' => array('Fire Dance Shows in Phuket', 'fire-shows', 'Explore solo, duo and group fire dance shows with 1–5 performers for Phuket weddings, villas and events. Request a quote for your venue.', '<!-- wp:paragraph --><p>Fire dance shows can be arranged as a standalone feature or alongside a fireworks display. Tell us your event date, venue, preferred number of dancers and the kind of atmosphere you would like.</p><!-- /wp:paragraph -->'),
  'wedding-fireworks' => array('Wedding Fireworks in Phuket', 'wedding', 'A breathtaking shared moment, coordinated quietly and professionally around every part of your celebration.', '<!-- wp:heading --><h2 class="wp-block-heading">One unforgettable moment. No extra supplier to manage.</h2><!-- /wp:heading --><!-- wp:paragraph --><p>We can coordinate with your wedding planner, venue, photographer, DJ and timeline to align the firing moment. From access and suitable locations to cues and guest experience, the practical details are arranged before confirmation.</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">Designed around your day</h2><!-- /wp:heading --><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">The reveal</h3><!-- /wp:heading --><!-- wp:paragraph --><p>A surprise moment after the ceremony or dinner.</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">The first dance</h3><!-- /wp:heading --><!-- wp:paragraph --><p>A precisely timed backdrop for an iconic photograph.</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">The finale</h3><!-- /wp:heading --><!-- wp:paragraph --><p>A shared spectacle that closes the night beautifully.</p><!-- /wp:paragraph -->'),
  'gallery' => array('Celebrations, Illuminated', 'gallery', 'Fireworks inspiration for weddings, proposals, villas and resort celebrations. Real customer photography and films will be added as the collection grows.', ''),
  'locations' => array('Fireworks Across Southern Thailand', 'locations', 'We arrange displays for suitable venues in Phuket, Khao Lak and Krabi, with every location reviewed before confirmation.', ''),
  'faq' => array('Your Questions, Answered', 'faq', 'Clear guidance before you choose a display, with every venue and celebration considered individually.', ''),
  'contact' => array('Plan Your Celebration', 'contact', 'Request a tailored fireworks quote for your wedding, proposal, villa, resort or private event.', ''),
  'phuket-fireworks' => array('Fireworks in Phuket', 'location', 'From west-coast resorts and private villas to destination weddings, plan a display around your Phuket celebration.', '<!-- wp:heading --><h2 class="wp-block-heading">Designed around your Phuket venue</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Share your venue and event date so we can review access, surroundings and a suitable firing position. We coordinate with your venue or planner before a display is confirmed.</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">Weddings, proposals and private events</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Choose an intimate moment or a larger finale. The display, timing and logistics are shaped around your celebration and the venue requirements.</p><!-- /wp:paragraph -->'),
  'khao-lak-fireworks' => array('Fireworks in Khao Lak', 'location', 'Beautiful beachfront celebrations, subject to venue and firing-location suitability.', '<!-- wp:heading --><h2 class="wp-block-heading">A finale for your Khao Lak celebration</h2><!-- /wp:heading --><!-- wp:paragraph --><p>We help plan fireworks for suitable weddings, beachfront resorts and private events in Khao Lak. The event date, venue access and proposed firing position are reviewed before confirmation.</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">Coordinate the details early</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Send your venue name and planner’s details with your inquiry. Availability and pricing depend on location requirements, logistics and operator availability.</p><!-- /wp:paragraph -->'),
  'krabi-fireworks' => array('Fireworks in Krabi', 'location', 'Dramatic coastal settings for weddings, private events and resort celebrations.', '<!-- wp:heading --><h2 class="wp-block-heading">A shared moment on the Krabi coast</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Tell us about your wedding, resort celebration or private event in Krabi. We review the proposed location, access and surroundings before confirming whether a display can be arranged.</p><!-- /wp:paragraph --><!-- wp:heading --><h2 class="wp-block-heading">A display that fits the venue</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Timing, show design and the firing position are coordinated with the venue team. Every quotation reflects the practical requirements of that setting.</p><!-- /wp:paragraph -->'),
);
foreach ($pages as $slug=>$data) {
  $existing=get_page_by_path($slug);
  if ($existing) { WP_CLI::log('Preserved existing page: '.$slug); continue; }
  $id=wp_insert_post(array('post_type'=>'page','post_status'=>'publish','post_name'=>$slug,'post_title'=>$data[0],'post_excerpt'=>$data[2],'post_content'=>$data[3]),true);
  if (is_wp_error($id)) { WP_CLI::error($id->get_error_message()); }
  update_post_meta($id,'_fp_kind',$data[1]);
  WP_CLI::log('Created '.$slug.' #'.$id);
}
// Import the bundled reference photographs only where no image was selected.
require_once ABSPATH.'wp-admin/includes/file.php';
require_once ABSPATH.'wp-admin/includes/media.php';
require_once ABSPATH.'wp-admin/includes/image.php';
foreach (array('hero'=>'fireworks-hero','wedding'=>'wedding-fireworks','villa'=>'villa-fireworks','proposal'=>'proposal-fireworks') as $key=>$file) {
  if (get_theme_mod('fp_image_'.$key)) { continue; }
  $source=get_template_directory().'/assets/images/'.$file.'.jpg';
  $temp=wp_tempnam($file.'.jpg');
  if (!$temp || !copy($source,$temp)) { WP_CLI::error('Could not prepare image '.$file); }
  $id=media_handle_sideload(array('name'=>$file.'.jpg','tmp_name'=>$temp),0,'Fireworks Phuket — '.$key.' reference image');
  if (is_wp_error($id)) { @unlink($temp); WP_CLI::error($id->get_error_message()); }
  set_theme_mod('fp_image_'.$key,$id);
  WP_CLI::log('Imported media '.$key.' #'.$id);
}
// Publish editable package cards only when a matching package does not exist.
foreach (array(
  array('classic','Classic','Intimate moments','Ideal for intimate weddings, proposals and smaller celebrations.',40000,'proposal',0),
  array('signature','Signature','A balanced finale','A fuller display with stronger pacing and a memorable finale.',70000,'hero',1),
  array('grand','Grand','Maximum impact','A large-scale display designed for major weddings, resorts and events.',108000,'villa',2),
) as $package) {
  if (get_page_by_path($package[0],OBJECT,'fp_package')) { WP_CLI::log('Preserved existing package: '.$package[0]); continue; }
  $id=wp_insert_post(array('post_type'=>'fp_package','post_status'=>'publish','post_name'=>$package[0],'post_title'=>$package[1],'post_excerpt'=>$package[2],'post_content'=>'<p>'.esc_html($package[3]).'</p>','menu_order'=>$package[6]),true);
  if (is_wp_error($id)) { WP_CLI::error($id->get_error_message()); }
  update_post_meta($id,'_fp_start_price',$package[4]);
  $image_id=absint(get_theme_mod('fp_image_'.$package[5]));
  if ($image_id && wp_attachment_is_image($image_id)) { set_post_thumbnail($id,$image_id); }
  WP_CLI::log('Created package '.$package[0].' #'.$id);
}
$packages_page=get_page_by_path('packages');
if ($packages_page && $packages_page->post_excerpt === 'Choose a starting point, then let us shape the display around your venue, timeline and celebration.') {
  wp_update_post(array('ID'=>$packages_page->ID,'post_excerpt'=>'Explore fireworks ideas around ฿40,000+, ฿70,000+ and ฿108,000+ for Phuket weddings, proposals and private events. Every display is quoted for your venue.'));
}
