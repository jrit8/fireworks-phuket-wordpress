# Fireworks Phuket — rules for every AI agent (Codex, Claude Code)

Live site: https://fireworksphuket.com — WordPress on SiteGround, this repo is the theme
(`wp-content/themes/fireworks-phuket-wordpress`). Branch in use: `codex/native-wordpress-theme`.

## Working together
- **GitHub is the source of truth, and it must match what is live.** Before starting: `git pull`.
  After deploying to SiteGround: commit and push immediately, so the next agent doesn't overwrite live changes.
- **One agent at a time.** Never force-push or rewrite pushed history.
- Pushing to GitHub does **not** deploy. Deploy over SSH: back up first
  (`~/backups/`: `wp db export` + tar of the theme), upload, `php -l` every PHP file, then `wp sg purge`.
- Check all four languages after any change: `/`, `/ru/`, `/zh/`, `/th/` and a few subpages.

## Languages (Polylang plugin) — English (default, root URLs), Russian `/ru/`, Chinese `/zh/`, Thai `/th/`
- **Never hard-code visible text.** Wrap it: `esc_html_e( 'Text', 'fireworks-phuket' )`, `__( 'Text', 'fireworks-phuket' )`.
- **When you add or change a theme string, add its translation** to all three files in `languages/`:
  `ru_RU.l10n.php`, `zh_CN.l10n.php`, `th.l10n.php` (PHP arrays, loaded by WordPress 6.5+), and the matching `.po`.
  The array key must be the exact English string. Untranslated strings simply show in English.
- Page/package **content lives in WordPress**, one post per language, linked by Polylang
  (translated slugs end in `-ru`, `-zh`, `-th`). Edit translations in WP admin → Pages (language columns).
  `tools/setup-languages.php` + `tools/translations/content-*.php` created them; re-running only adds missing ones.
- Package prices, page kinds (`_fp_kind`), images and order are synced across translations by Polylang.
- In templates, use the helpers in `inc/i18n.php`, never raw slugs/URLs:
  `fp_page_url( 'english-slug' )`, `fp_is_page( 'english-slug' )`, `fp_get_page()`, `fp_home_url()`, `fp_lang()`.
- Translations are AI-drafted; a native speaker should review before promoting a language.

## Contact policy
- **All first contact goes through the quote form** (`template-parts/quote-form.php`).
  No direct messaging or social links; supported apps appear only as icons (`fp_chat_apps()`)
  with the note that we continue there after the first enquiry.
- The form asks for a preferred contact method (Email, supported apps, Phone call) + app username or ID,
  and sends the visitor's language; notification emails for non-English enquiries are tagged e.g. "(RU)".
