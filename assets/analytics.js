(() => {
  'use strict';
  const config = window.fpAnalytics;
  if (!config || !/^G-[A-Z0-9]+$/.test(config.id)) return;
  const banner = document.getElementById('fp-analytics-consent');
  const settings = document.getElementById('fp-privacy-settings');
  if (!banner || !settings) return;
  const cookie = name => document.cookie.split('; ').find(item => item.startsWith(name + '='))?.split('=')[1];
  let choice = cookie('fp_analytics_choice');
  let started = false;
  // Query strings, fragments, contact values and free text never enter event payloads.
  const page = location.origin + location.pathname;
  const referrer = (() => { try { return new URL(document.referrer).origin; } catch (_) { return ''; } })();
  const emit = (name, values = {}) => {
    if (choice === 'granted' && started) window.gtag('event', name, {send_to: config.id, page_location: page, page_referrer: referrer, ...values});
  };
  const start = () => {
    if (started || choice !== 'granted') return;
    started = true;
    window.dataLayer = window.dataLayer || [];
    window.gtag = function () { window.dataLayer.push(arguments); };
    window.gtag('consent', 'default', {analytics_storage: 'granted', ad_storage: 'denied', ad_user_data: 'denied', ad_personalization: 'denied'});
    window.gtag('js', new Date());
    window.gtag('config', config.id, {send_page_view: false, page_location: page, page_referrer: referrer, allow_google_signals: false, allow_ad_personalization_signals: false});
    emit('page_view');
    const script = document.createElement('script');
    script.async = true;
    script.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(config.id);
    script.onload = () => {
      if (choice !== 'granted' || new URLSearchParams(location.search).get('inquiry') !== 'saved') return;
      fetch(config.receiptUrl, {method: 'POST', credentials: 'same-origin', cache: 'no-store'})
        .then(response => response.ok ? response.json() : null)
        .then(result => { if (result?.success && result.data) emit('generate_lead', {method: 'quote_form', service_type: result.data.service_type}); })
        .catch(() => {});
    };
    document.head.appendChild(script);
  };
  settings.hidden = false;
  banner.hidden = choice === 'granted' || choice === 'denied';
  settings.addEventListener('click', () => { banner.hidden = false; banner.querySelector('button').focus(); });
  banner.addEventListener('click', event => {
    const button = event.target.closest('[data-fp-consent]');
    if (!button) return;
    const previouslyStarted = started;
    choice = button.dataset.fpConsent;
    document.cookie = 'fp_analytics_choice=' + choice + '; Path=/; Max-Age=15552000; SameSite=Lax; Secure';
    banner.hidden = true;
    settings.focus();
    if (choice === 'granted') start();
    else if (previouslyStarted) {
      window['ga-disable-' + config.id] = true;
      const domains = ['', location.hostname, '.' + location.hostname];
      document.cookie.split('; ').forEach(item => {
        const name = item.split('=')[0];
        if (!/^_ga(?:_|$)/.test(name)) return;
        domains.forEach(domain => { document.cookie = name + '=; Max-Age=0; Path=/' + (domain ? '; Domain=' + domain : ''); });
      });
      location.reload();
    }
  });
  document.addEventListener('click', event => {
    const link = event.target.closest('a[href]');
    if (!link) return;
    const url = new URL(link.href, location.origin);
    const name = url.protocol === 'tel:' ? 'phone_click' : ['wa.me', 'api.whatsapp.com'].includes(url.hostname) ? 'whatsapp_click' : '';
    if (name) emit(name, {contact_placement: link.closest('header') ? 'header' : link.closest('footer') ? 'footer' : link.classList.contains('mobile-cta') ? 'mobile_sticky' : 'content'});
  });
  start();
})();
