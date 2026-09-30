(() => {
  // Match content clearance to the actual translated, wrapping header.
  const header = document.querySelector('.site-header');
  if (header) {
    const updateHeaderHeight = () => {
      if (header.querySelector('.menu-toggle[aria-expanded="true"]')) return;
      document.documentElement.style.setProperty('--fp-header-height', `${Math.ceil(header.getBoundingClientRect().bottom)}px`);
    };
    updateHeaderHeight();
    if ('ResizeObserver' in window) new ResizeObserver(updateHeaderHeight).observe(header);
    window.addEventListener('resize', updateHeaderHeight);
  }

  const form = document.querySelector('.quote-form');
  if (form) {
    // Translated messages come from wp_localize_script (functions.php); English is the fallback.
    const t = Object.assign({
      contactRequired: 'Please enter a phone number, email address or messaging app ID.',
      phoneDigits: 'Please enter a phone number with at least seven digits.',
      sending: 'Sending your inquiry…',
      submit: 'Request a Quote →',
    }, window.fpI18n || {});
    const phone = form.elements.phone;
    const email = form.elements.email;
    const handle = form.elements.handle;
    const validateContact = () => {
      const phoneValue = phone.value.trim();
      phone.setCustomValidity(!phoneValue && !email.value.trim() && !(handle && handle.value.trim())
        ? t.contactRequired
        : phoneValue && phoneValue.replace(/\D/g, '').length < 7
          ? t.phoneDigits : '');
    };
    phone.addEventListener('input', validateContact);
    email.addEventListener('input', validateContact);
    if (handle) handle.addEventListener('input', validateContact);
    form.querySelector('button[type="submit"]').addEventListener('click', validateContact);
    form.addEventListener('submit', event => {
      validateContact();
      if (!form.reportValidity()) { event.preventDefault(); return; }
      const button = form.querySelector('button[type="submit"]');
      button.disabled = true;
      button.textContent = t.sending;
    });
    window.addEventListener('pageshow', () => {
      const button = form.querySelector('button[type="submit"]');
      button.disabled = false;
      button.textContent = t.submit;
    });
  }
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('#primary-navigation');
  if (!toggle || !nav) return;
  toggle.hidden = false;
  document.documentElement.classList.add('js');
  const close = () => {
    toggle.setAttribute('aria-expanded', 'false');
    nav.classList.remove('is-open');
  };
  toggle.addEventListener('click', () => {
    const open = toggle.getAttribute('aria-expanded') !== 'true';
    toggle.setAttribute('aria-expanded', String(open));
    nav.classList.toggle('is-open', open);
  });
  nav.addEventListener('click', event => { if (event.target.closest('a')) close(); });
  document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') { close(); toggle.focus(); }
  });
  window.matchMedia('(min-width: 1100px)').addEventListener('change', close);
})();

