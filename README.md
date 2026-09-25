# Fireworks Phuket — native WordPress theme

Stage 1 ports the Lovable homepage into server-rendered WordPress PHP, CSS and a small navigation script. No React runtime, iframe, page builder or npm build is required.

## Install on SiteGround WordPress

1. Use a staging copy if available, or take a SiteGround backup before activation.
2. In WordPress, open **Appearance → Themes → Add New Theme → Upload Theme** and select `fireworks-phuket-wordpress.zip`.
3. Install, then use **Live Preview**. Activate when the preview is approved.
4. Open **Appearance → Customize → Fireworks Phuket**. Set the public WhatsApp number (country code and digits only), inquiry email and homepage introduction. Select replacement images from the Media Library.
5. Open **Appearance → Menus** to assign primary and footer menus. Without custom menus the theme uses working homepage section links.

The theme displays its landing page at the site root. Existing WordPress content is preserved; generic pages and posts use the native content template.

## Editing content

- **Packages**: title, editor content, featured image and Order. Publish entries to replace the three default package cards. Include confirmed prices in the editor content if desired.
- **FAQs**: title is the question; editor content is the answer. Published entries replace the default FAQ list.
- **Gallery items**: title, caption in editor, featured image and Order. Published entries replace the three reference images.
- **Testimonials**: title is the attribution; editor content is the approved review. Hidden until genuine entries are published.
- Use the Order value under Page Attributes to arrange items. Only published content appears.

Content types are currently registered by the theme. Data is retained if the theme is switched; a companion plugin should register these types to keep their editing screens available under another theme.

## Reference and deliberate changes

Visual source: `jrit8/phuket-sky-sparkle`, main tree observed as `9d6c6a4d1bf2eacc16ed8f151cc1dcea6f401ade`. Original repository is unchanged. The supplied four JPGs are bundled as fallbacks; Media Library selections receive WordPress responsive image markup. Confirm ownership/permission for supplied photography before launch.

Palette, typography, hero, homepage section order, grids and hover effects follow the reference. Fonts are self-hosted with their SIL OFL licenses in `assets/fonts`.

The source contained placeholder pricing, video play symbols, invented review examples and a WhatsApp URL with no phone number. This version uses Request pricing, static images, no default testimonials, and configurable contact information. It does not claim a form submission was sent. No email is sent by the theme.

## Stage 1 scope and next work

Included: native scaffold, homepage, navigation, footer, mobile layout, editable content collections, Media Library controls, accessible native FAQ disclosures and reduced-motion support.

Not yet included: dedicated service/location/package/gallery/contact pages, inquiry form delivery, video integration, final SEO metadata, production Core Web Vitals measurement, or SiteGround deployment. Use an SEO plugin for production metadata. This is a review build, not an automatically published live-site update.

## Validation

Run `php -l` on every PHP file and `node --check assets/theme.js`. Preview on a real WordPress installation at desktop and mobile widths; check navigation, FAQ keyboard interaction, content ordering, image replacement and configured/unconfigured contact states before launch.
