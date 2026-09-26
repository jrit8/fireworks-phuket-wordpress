# Fireworks Phuket — native WordPress theme

Version 0.5 ports the Lovable site into server-rendered WordPress PHP, CSS and a small navigation script. No React runtime, iframe, page builder or npm build is required.

## Install on SiteGround WordPress

1. Use a staging copy if available, or take a SiteGround backup before activation.
2. In WordPress, open **Appearance → Themes → Add New Theme → Upload Theme** and select `fireworks-phuket-wordpress.zip`.
3. Install, then use **Live Preview**. Activate when the preview is approved.
4. Open **Appearance → Customize → Fireworks Phuket**. Set the public WhatsApp number, optional public inquiry email, private notification email and homepage introduction. If the private notification email is blank, inquiry alerts go to the WordPress admin email. Select replacement images from the Media Library.
5. Open **Appearance → Menus** to assign primary and footer menus. Without custom menus the theme uses working homepage section links.
6. To create the eleven dedicated pages, three editable fireworks packages and import the reference photographs, run `wp eval-file wp-content/themes/fireworks-phuket-wordpress/tools/create-content.php`. This preserves existing pages, packages and selected images. Navigation uses dedicated pages as soon as they exist.

The theme displays its landing page at the site root. Existing WordPress content is preserved; generic pages and posts use the native content template.

## Editing content

- **Packages**: title, short label in Excerpt, description in editor, public guide price in the side panel, featured image and Order. The setup script seeds Classic (around ฿40,000+), Signature (around ฿70,000+) and Grand (around ฿108,000+), each with a distinct image. Public markers are editable and intentionally broader than the private eight-set quotation. Confirm package economics and inclusions before accepting bookings.
- **FAQs**: title is the question; editor content is the answer. Published entries replace the default FAQ list.
- **Fire shows**: the dedicated page and homepage section show provisional budget guides for solo through five-dancer formats. These are separate from fireworks prices. Update the figures in `template-parts/home-fire-shows.php` once performer quotes and margins are confirmed. The photo is reused from the user's PhuketWeds fire-show slide.
- **Proposals**: homepage and dedicated page show The Intimate Reveal, The Sparkling Yes and The Grand Proposal, each with a different image. The latter two show fireworks-only guides; proposal setups and extras require separate quotations. Edit these options in `template-parts/home-proposals.php`. Package links prefill the contact form with an allowlisted proposal name. The fire-letter and sparkler images are labelled concepts.
- **Gallery items**: title, caption in editor, featured image and Order. Published entries replace the three reference images.
- **Testimonials**: title is the attribution; editor content is the approved review. Hidden until genuine entries are published.
- Use the Order value under Page Attributes to arrange items. Only published content appears.
- **Pages**: edit titles, excerpts, body blocks and featured images for the dedicated pages. Page kinds are assigned by the setup script and share reusable PHP templates.
- **Inquiries**: administrator-only private inbox for submitted quote requests. These entries are not exposed through REST or public pages. Delete entries when no longer needed according to your business retention policy.

Content types are currently registered by the theme. Data is retained if the theme is switched; a companion plugin should register these types to keep their editing screens available under another theme.

## Reference and deliberate changes

Visual source: `jrit8/phuket-sky-sparkle`, main tree observed as `9d6c6a4d1bf2eacc16ed8f151cc1dcea6f401ade`. Original repository is unchanged. The supplied four JPGs are bundled as fallbacks; Media Library selections receive WordPress responsive image markup. Confirm ownership/permission for supplied photography before launch.

Palette, typography, hero, homepage section order, grids and hover effects follow the reference. Fonts are self-hosted with their SIL OFL licenses in `assets/fonts`.

The source contained placeholder pricing, video play symbols, invented review examples and a WhatsApp URL with no phone number. This version uses broad public price guides, static images, no default testimonials, and configurable contact information. Three new generated concept images illustrate proposals/sparklers, daytime colour effects and offshore displays; the site labels them as inspiration rather than past events or guaranteed offerings.

The quote form requires a valid date, name, venue, a contact method and contact consent. Visitors can mark fireworks, fire dance or both. It validates a WordPress nonce, includes a honeypot and limits submissions using a short-lived salted IP hash. Details are saved privately before a success message is shown. An email notification goes to the private notification email or, by default, the WordPress admin email. It links to the private inquiry without including visitor details. Mail acceptance is recorded; delivery to an inbox is not guaranteed. SiteGround's supported cache exclusion hook keeps `/contact` dynamic.

## Scope and next work

Included: homepage, navigation, footer, responsive layout, editable content collections, Media Library controls, native FAQ disclosures, packages/fire-shows/wedding/gallery/locations/FAQ/contact pages, three location pages, a private inquiry inbox, SEO descriptions, social preview images and Organization/WebSite/Service structured data. WordPress supplies canonical links for pages and its XML sitemap.

Still needed: reconciliation of the private quotation's line-item arithmetic, owner confirmation of package margins and included effects, approved testimonials and real show videos, creation of the preferred events mailbox, Google Search Console connection and production Core Web Vitals measurement. Delivery of a test notification to the current admin inbox was confirmed by the owner. Common SEO plugins suppress the theme's fallback metadata to avoid duplicate tags. No analytics or marketing trackers are added.

## Validation

Run `php -l` on every PHP file and `node --check assets/theme.js`. Preview on a real WordPress installation at desktop and mobile widths; check navigation, FAQ keyboard interaction, content ordering, image replacement and configured/unconfigured contact states before launch.
