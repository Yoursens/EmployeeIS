/**
 * register.js — Employee IS Register Page
 */
(function () {
  'use strict';

  /* ── Toggle password visibility ── */
  setupToggle('password', 'togglePass', 'togglePassIcon');
  setupToggle('confirm_password', 'toggleConfirm', 'toggleConfirmIcon');

  function setupToggle(inputId, btnId, iconId) {
    const input = document.getElementById(inputId);
    const btn   = document.getElementById(btnId);
    const icon  = document.getElementById(iconId);
    if (!input || !btn) return;
    btn.addEventListener('click', () => {
      const hidden = input.type === 'password';
      input.type = hidden ? 'text' : 'password';
      if (icon) icon.className = hidden ? 'fa fa-eye-slash' : 'fa fa-eye';
    });
  }

  /* ── Password strength ── */
  const pwInput = document.getElementById('password');
  const pwBar   = document.getElementById('pwBar');
  const pwHint  = document.getElementById('pwHint');

  const strengthLevels = [
    { label: 'Too weak',     class: 'weak',   width: '20%' },
    { label: 'Fair',         class: 'fair',   width: '50%' },
    { label: 'Good',         class: 'good',   width: '75%' },
    { label: 'Strong',       class: 'strong', width: '100%' },
  ];

  function checkStrength(pw) {
    let score = 0;
    if (pw.length >= 8)          score++;
    if (/[A-Z]/.test(pw))        score++;
    if (/[0-9]/.test(pw))        score++;
    if (/[^A-Za-z0-9]/.test(pw)) score++;
    return Math.min(score, 3);
  }

  if (pwInput && pwBar && pwHint) {
    pwInput.addEventListener('input', () => {
      const val = pwInput.value;
      if (!val) {
        pwBar.style.width = '0';
        pwBar.className = 'pw-bar-fill';
        pwHint.textContent = 'Enter a password to check strength';
        return;
      }
      const idx   = checkStrength(val);
      const level = strengthLevels[idx];
      pwBar.style.width = level.width;
      pwBar.className   = `pw-bar-fill ${level.class}`;
      pwHint.textContent = level.label;
      pwHint.style.color = idx <= 0 ? '#e05c5c' : idx === 1 ? '#f5c842' : 'var(--accent)';
    });
  }

  /* ── Client-side validation ── */
  const form       = document.getElementById('registerForm');
  const submitBtn  = document.getElementById('submitBtn');
  const submitText = document.getElementById('submitText');

  if (form) {
    form.addEventListener('submit', function (e) {
      clearErrors();
      let valid = true;

      const firstName = document.getElementById('first_name');
      const lastName  = document.getElementById('last_name');
      const email     = document.getElementById('email');
      const role      = document.getElementById('role');
      const password  = document.getElementById('password');
      const confirm   = document.getElementById('confirm_password');
      const terms     = document.getElementById('terms');

      if (!firstName.value.trim()) { showFieldError(firstName, 'First name is required.'); valid = false; }
      if (!lastName.value.trim())  { showFieldError(lastName,  'Last name is required.');  valid = false; }

      if (!email.value.trim()) {
        showFieldError(email, 'Email is required.'); valid = false;
      } else if (!isValidEmail(email.value.trim())) {
        showFieldError(email, 'Enter a valid email.'); valid = false;
      }

      if (!role.value) { showFieldError(role, 'Please select a role.'); valid = false; }

      if (!password.value) {
        showFieldError(password, 'Password is required.'); valid = false;
      } else if (password.value.length < 8) {
        showFieldError(password, 'Password must be at least 8 characters.'); valid = false;
      }

      if (!confirm.value) {
        showFieldError(confirm, 'Please confirm your password.'); valid = false;
      } else if (password.value !== confirm.value) {
        showFieldError(confirm, 'Passwords do not match.'); valid = false;
      }

      if (!terms.checked) {
        const termsRow = terms.closest('.terms-row');
        const err = document.createElement('span');
        err.className = 'field-error';
        err.style.cssText = 'display:block;font-size:.76rem;color:#f08080;margin-top:.3rem;';
        err.textContent = 'You must agree to the terms.';
        termsRow.after(err);
        valid = false;
      }

      if (!valid) { e.preventDefault(); return; }
      setLoading(true);
    });
  }

  /* ── Real-time confirm match ── */
  const confirmInput = document.getElementById('confirm_password');
  if (confirmInput && pwInput) {
    confirmInput.addEventListener('input', () => {
      clearFieldError(confirmInput);
      if (confirmInput.value && confirmInput.value !== pwInput.value) {
        confirmInput.style.borderColor = 'var(--danger)';
      } else if (confirmInput.value) {
        confirmInput.style.borderColor = 'var(--accent)';
      }
    });
  }

  /* ── Helpers ── */
  function isValidEmail(email) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email); }

  function showFieldError(input, message) {
    clearFieldError(input);
    input.style.borderColor = 'var(--danger)';
    input.style.boxShadow = '0 0 0 3px rgba(224,92,92,.15)';
    const err = document.createElement('span');
    err.className = 'field-error';
    err.style.cssText = 'display:block;font-size:.76rem;color:#f08080;margin-top:.35rem;';
    err.textContent = message;
    const wrap = input.closest('.input-wrap') || input.parentElement;
    wrap.after(err);
  }

  function clearFieldError(input) {
    input.style.borderColor = '';
    input.style.boxShadow   = '';
    const wrap = input.closest('.input-wrap') || input.parentElement;
    const next = wrap?.nextElementSibling;
    if (next?.classList.contains('field-error')) next.remove();
  }

  function clearErrors() {
    document.querySelectorAll('.field-error').forEach(el => el.remove());
    document.querySelectorAll('input, select').forEach(el => {
      el.style.borderColor = '';
      el.style.boxShadow   = '';
    });
  }

  function setLoading(loading) {
    if (!submitBtn || !submitText) return;
    submitBtn.disabled = loading;
    submitText.textContent = loading ? 'Creating account…' : 'Create Account';
  }

})();