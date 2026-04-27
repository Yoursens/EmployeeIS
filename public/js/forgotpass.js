/**
 * forgotpass.js — Employee IS Forgot Password Page
 */
(function () {
  'use strict';

  const form        = document.getElementById('forgotForm');
  const submitBtn   = document.getElementById('submitBtn');
  const submitText  = document.getElementById('submitText');
  const formState   = document.getElementById('formState');
  const successState = document.getElementById('successState');

  /* ── Client-side validation + UX ── */
  if (form) {
    form.addEventListener('submit', function (e) {
      clearErrors();
      const emailInput = document.getElementById('email');
      const val = emailInput ? emailInput.value.trim() : '';

      let valid = true;

      if (!val) {
        showFieldError(emailInput, 'Email address is required.');
        valid = false;
      } else if (!isValidEmail(val)) {
        showFieldError(emailInput, 'Please enter a valid email address.');
        valid = false;
      }

      if (!valid) {
        e.preventDefault();
        return;
      }

      setLoading(true);
    });
  }

  /* ── Real-time input clear ── */
  const emailInput = document.getElementById('email');
  if (emailInput) {
    emailInput.addEventListener('input', () => clearFieldError(emailInput));
  }

  /* ── Show success state if flashdata already set on load ── */
  if (successState && successState.classList.contains('show')) {
    if (formState) formState.style.display = 'none';
  }

  /* ── Countdown to redirect after success ── */
  if (successState && successState.classList.contains('show')) {
    let secs = 10;
    const redirectHint = document.createElement('p');
    redirectHint.style.cssText = 'font-size:.8rem;color:var(--text-muted);margin-top:1rem;';
    redirectHint.textContent = `Redirecting to login in ${secs}s…`;
    successState.appendChild(redirectHint);

    const interval = setInterval(() => {
      secs--;
      redirectHint.textContent = `Redirecting to login in ${secs}s…`;
      if (secs <= 0) {
        clearInterval(interval);
        window.location.href = document.querySelector('a[href*="login"]')?.href || '/login';
      }
    }, 1000);
  }

  /* ── Helpers ── */
  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  function showFieldError(input, message) {
    if (!input) return;
    clearFieldError(input);
    input.style.borderColor = 'var(--danger)';
    input.style.boxShadow   = '0 0 0 3px rgba(224,92,92,.15)';
    const err = document.createElement('span');
    err.className = 'field-error';
    err.style.cssText = 'display:block;font-size:.76rem;color:#f08080;margin-top:.35rem;';
    err.textContent = message;
    const wrap = input.closest('.input-wrap') || input.parentElement;
    if (wrap) wrap.after(err);
  }

  function clearFieldError(input) {
    if (!input) return;
    input.style.borderColor = '';
    input.style.boxShadow   = '';
    const wrap = input.closest('.input-wrap') || input.parentElement;
    const next = wrap?.nextElementSibling;
    if (next?.classList.contains('field-error')) next.remove();
  }

  function clearErrors() {
    document.querySelectorAll('.field-error').forEach(el => el.remove());
    if (emailInput) { emailInput.style.borderColor = ''; emailInput.style.boxShadow = ''; }
  }

  function setLoading(loading) {
    if (!submitBtn || !submitText) return;
    submitBtn.disabled = loading;
    submitText.textContent = loading ? 'Sending link…' : 'Send Reset Link';
  }

})();