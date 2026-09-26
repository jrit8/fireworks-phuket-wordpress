(() => {
  const form = document.querySelector('.quote-form');
  if (form) {
    const phone = form.elements.phone;
    const email = form.elements.email;
    const validateContact = () => {
      const phoneValue = phone.value.trim();
      phone.setCustomValidity(!phoneValue && !email.value.trim()
        ? 'Please enter a WhatsApp number or email address.'
        : phoneValue && phoneValue.replace(/\D/g, '').length < 7
          ? 'Please enter a phone number with at least seven digits.' : '');
    };
    phone.addEventListener('input', validateContact);
    email.addEventListener('input', validateContact);
    form.querySelector('button[type="submit"]').addEventListener('click', validateContact);
    form.addEventListener('submit', event => {
      validateContact();
      if (!form.reportValidity()) { event.preventDefault(); return; }
      const button = form.querySelector('button[type="submit"]');
      button.disabled = true;
      button.textContent = 'Sending your inquiry…';
    });
    window.addEventListener('pageshow', () => {
      const button = form.querySelector('button[type="submit"]');
      button.disabled = false;
      button.textContent = 'Request a Quote →';
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

