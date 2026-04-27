/**
 * login.js — Employee IS Login Page
 */
(function () {
  'use strict';

  /* ── Toggle password visibility ── */
  const passInput = document.getElementById('password');
  const toggleBtn = document.getElementById('togglePass');
  const toggleIcon = document.getElementById('togglePassIcon');

  if (toggleBtn && passInput) {
    toggleBtn.addEventListener('click', () => {
      const isHidden = passInput.type === 'password';
      passInput.type = isHidden ? 'text' : 'password';
      toggleIcon.className = isHidden ? 'fa fa-eye-slash' : 'fa fa-eye';
    });
  }

  /* ── Client-side validation ── */
  const form = document.getElementById('loginForm');
  const submitBtn = document.getElementById('submitBtn');
  const submitText = document.getElementById('submitText');

  if (form) {
    form.addEventListener('submit', function (e) {
      clearErrors();
      let valid = true;

      const email = document.getElementById('email');
      const password = document.getElementById('password');

      if (!email.value.trim()) {
        showFieldError(email, 'Email address is required.');
        valid = false;
      } else if (!isValidEmail(email.value.trim())) {
        showFieldError(email, 'Please enter a valid email address.');
        valid = false;
      }

      if (!password.value) {
        showFieldError(password, 'Password is required.');
        valid = false;
      }

      if (!valid) {
        e.preventDefault();
        return;
      }

      // Loading state
      setLoading(true);
    });
  }

  /* ── Real-time input validation ── */
  document.querySelectorAll('input[required]').forEach(input => {
    input.addEventListener('input', () => clearFieldError(input));
    input.addEventListener('blur', () => {
      if (!input.value.trim()) {
        showFieldError(input, input.id === 'email' ? 'Email is required.' : 'This field is required.');
      }
    });
  });

  /* ── Helpers ── */
  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  function showFieldError(input, message) {
    clearFieldError(input);
    input.style.borderColor = 'var(--danger)';
    input.style.boxShadow = '0 0 0 3px rgba(224,92,92,.15)';
    const err = document.createElement('span');
    err.className = 'field-error';
    err.style.cssText = 'display:block;font-size:.76rem;color:#f08080;margin-top:.35rem;';
    err.textContent = message;
    input.closest('.input-wrap').after(err);
  }

  function clearFieldError(input) {
    input.style.borderColor = '';
    input.style.boxShadow = '';
    const next = input.closest('.input-wrap')?.nextElementSibling;
    if (next?.classList.contains('field-error')) next.remove();
  }

  function clearErrors() {
    document.querySelectorAll('.field-error').forEach(el => el.remove());
    document.querySelectorAll('input').forEach(input => {
      input.style.borderColor = '';
      input.style.boxShadow = '';
    });
  }

  function setLoading(loading) {
    if (!submitBtn || !submitText) return;
    submitBtn.disabled = loading;
    submitText.textContent = loading ? 'Signing in…' : 'Sign In';
  }

})();