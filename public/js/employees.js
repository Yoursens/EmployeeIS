/**
 * employees.js — Employee Information System Scripts
 * PC21 Advanced Web Development | Terminal Assessment 1
 */

'use strict';

/* ── Utility: generate initials avatar from name ───────────────────────── */
function getInitials(name) {
  return name
    .trim()
    .split(/\s+/)
    .slice(0, 2)
    .map(w => w[0].toUpperCase())
    .join('');
}

/* ── Utility: format currency (PHP) ────────────────────────────────────── */
function formatSalary(amount) {
  return new Intl.NumberFormat('en-PH', {
    style: 'currency',
    currency: 'PHP',
    maximumFractionDigits: 2,
  }).format(amount);
}

/* ── Flash Message Auto-dismiss ─────────────────────────────────────────── */
function initAlerts() {
  document.querySelectorAll('.alert').forEach(alert => {
    // Auto-dismiss after 5 seconds
    const timer = setTimeout(() => dismissAlert(alert), 5000);

    const closeBtn = alert.querySelector('.alert-close');
    if (closeBtn) {
      closeBtn.addEventListener('click', () => {
        clearTimeout(timer);
        dismissAlert(alert);
      });
    }
  });
}

function dismissAlert(alert) {
  alert.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
  alert.style.opacity    = '0';
  alert.style.transform  = 'translateY(-6px)';
  setTimeout(() => alert.remove(), 380);
}

/* ── Delete Confirmation Modal ──────────────────────────────────────────── */
function initDeleteModal() {
  const overlay = document.getElementById('deleteModal');
  if (!overlay) return;

  const confirmLink  = document.getElementById('confirmDeleteBtn');
  const cancelBtns   = overlay.querySelectorAll('[data-dismiss="modal"]');

  // Open modal when any delete button is clicked
  document.querySelectorAll('[data-delete-url]').forEach(btn => {
    btn.addEventListener('click', e => {
      e.preventDefault();
      const url  = btn.dataset.deleteUrl;
      const name = btn.dataset.name || 'this record';

      document.getElementById('deleteTargetName').textContent = name;
      confirmLink.href = url;
      overlay.classList.add('active');
    });
  });

  // Close on cancel / overlay click
  cancelBtns.forEach(btn => btn.addEventListener('click', closeModal));
  overlay.addEventListener('click', e => { if (e.target === overlay) closeModal(); });

  // Keyboard ESC
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeModal();
  });

  function closeModal() {
    overlay.classList.remove('active');
  }
}

/* ── Live Search Highlight ──────────────────────────────────────────────── */
function initTableSearch() {
  const searchInput = document.getElementById('tableSearch');
  if (!searchInput) return;

  searchInput.addEventListener('input', function () {
    const keyword = this.value.toLowerCase().trim();
    const rows    = document.querySelectorAll('.eis-table tbody tr.data-row');

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(keyword) ? '' : 'none';
    });

    // Show/hide empty state
    const visible = [...rows].filter(r => r.style.display !== 'none');
    const emptyRow = document.getElementById('noResultsRow');
    if (emptyRow) emptyRow.style.display = visible.length === 0 ? '' : 'none';
  });
}

/* ── Salary Input Formatting (form) ─────────────────────────────────────── */
function initSalaryField() {
  const salaryInput = document.getElementById('salaryInput');
  if (!salaryInput) return;

  const preview = document.getElementById('salaryPreview');

  salaryInput.addEventListener('input', function () {
    const val = parseFloat(this.value);
    if (preview) {
      preview.textContent = isNaN(val) ? '' : formatSalary(val);
    }
  });
}

/* ── Client-side Form Validation ────────────────────────────────────────── */
function initFormValidation() {
  const form = document.getElementById('employeeForm');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    let valid = true;

    const fields = form.querySelectorAll('[data-required]');
    fields.forEach(field => {
      const val     = field.value.trim();
      const errEl   = document.getElementById(`${field.id}Error`);
      const isValid = val.length > 0;

      field.classList.toggle('is-invalid', !isValid);
      if (errEl) errEl.style.display = isValid ? 'none' : 'flex';
      if (!isValid) valid = false;
    });

    // Salary must be > 0
    const salary  = document.getElementById('salaryInput');
    const salErr  = document.getElementById('salaryError');
    if (salary) {
      const salVal  = parseFloat(salary.value);
      const salOk   = !isNaN(salVal) && salVal > 0;
      salary.classList.toggle('is-invalid', !salOk);
      if (salErr) salErr.style.display = salOk ? 'none' : 'flex';
      if (!salOk) valid = false;
    }

    if (!valid) {
      e.preventDefault();
      // Scroll to first error
      const firstErr = form.querySelector('.is-invalid');
      if (firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });

  // Real-time clear on input
  form.querySelectorAll('.form-control').forEach(field => {
    field.addEventListener('input', () => {
      field.classList.remove('is-invalid');
      const errEl = document.getElementById(`${field.id}Error`);
      if (errEl) errEl.style.display = 'none';
    });
  });
}

/* ── Row Entrance Animation ─────────────────────────────────────────────── */
function initRowAnimation() {
  const rows = document.querySelectorAll('.eis-table tbody tr.data-row');
  rows.forEach((row, i) => {
    row.style.opacity   = '0';
    row.style.transform = 'translateY(8px)';
    row.style.transition = `opacity 0.3s ease ${i * 40}ms, transform 0.3s ease ${i * 40}ms`;
    requestAnimationFrame(() => {
      row.style.opacity   = '1';
      row.style.transform = 'translateY(0)';
    });
  });
}

/* ── Bootstrap ──────────────────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
  initAlerts();
  initDeleteModal();
  initTableSearch();
  initSalaryField();
  initFormValidation();
  initRowAnimation();
});