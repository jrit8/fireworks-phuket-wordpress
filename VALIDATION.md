# Theme validation

Validated locally on WordPress 7.1.2 with PHP 8.4.26 and the official SQLite Database Integration drop-in. Version 0.2 was also deployed and checked on SiteGround WordPress 7.1.2 with PHP 8.2.33.

- All 20 theme PHP files passed `php -l`.
- The navigation script passed `node --check`.
- Theme activation and front-page rendering succeeded in WordPress.
- 28 integration assertions passed: default content, empty-testimonial behavior, contact states, four editor registrations, published content rendering, title escaping, draft exclusion, package ordering, Media Library control registration and phone sanitization.
- Browser inspection at 1280px, 768px and 390px found no horizontal overflow. The desktop and mobile homepage were visually inspected.
- Mobile navigation opens, Escape closes it and returns focus to the toggle. Native FAQ disclosure opens correctly.
- Desktop rendering has one H1 and no failed loaded images.

The original source was inspected as code and its assets reused; a side-by-side comparison with a running Lovable deployment has not yet been performed. No claim is made that production Core Web Vitals or all accessibility requirements have been measured.

Before publishing: enter confirmed contact information, check approved imagery and business copy, review the preview on SiteGround, and complete the remaining dedicated pages and SEO work described in README.md.

## Version 0.2

- PHP syntax checks passed for the added page and inquiry templates.
- A local browser form submission saved exactly one private inquiry and showed confirmation.
- 31 additional integration checks passed, covering valid/invalid fields, required contact data, message limits, private storage, REST exclusion, subscriber access denial, nine page creations/URLs and SiteGround cache exclusion.
- Mobile contact form and desktop wedding page were visually inspected. Mobile contact rendering has one H1 and no horizontal overflow.
- Notification email delivery is untested because no recipient email has been configured.
- All nine dedicated live page URLs returned HTTP 200.
- A synthetic live form submission saved a private inquiry successfully; the test entry was then moved to Trash.
- Live contact response includes `x-cache-enabled: False` and `cache-control: no-cache, must-revalidate, max-age=0, no-store, private`.
- Classic, Signature and Grand use three distinct Media Library image URLs, verified in the live browser.
