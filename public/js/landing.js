/**
 * landing.js — Employee IS Landing Page Scripts
 * PC21 Advanced Web Development | Terminal Assessment 1
 */

'use strict';

/* ── Scroll Reveal ──────────────────────────────────────────────────────── */
function initReveal() {
  const els = document.querySelectorAll('.reveal');
  if (!els.length) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.08, rootMargin: '0px 0px -40px 0px' }
  );

  els.forEach(el => observer.observe(el));
}

/* ── Department Bar Fill Animation ──────────────────────────────────────── */
function initDeptBars() {
  const bars = document.querySelectorAll('.dept-bar-fill');
  if (!bars.length) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          // Width is already set via inline style — just trigger reflow
          const el = entry.target;
          const targetW = el.style.width;
          el.style.width = '0%';
          requestAnimationFrame(() => {
            requestAnimationFrame(() => { el.style.width = targetW; });
          });
          observer.unobserve(el);
        }
      });
    },
    { threshold: 0.5 }
  );

  bars.forEach(bar => observer.observe(bar));
}

/* ── Stat Counter Animation ─────────────────────────────────────────────── */
function initCounters() {
  const cells = document.querySelectorAll('.stat-num span');
  if (!cells.length) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const el  = entry.target;
        const end = parseInt(el.textContent, 10);
        if (isNaN(end)) return;

        let start = 0;
        const step = Math.ceil(end / 30);
        const timer = setInterval(() => {
          start = Math.min(start + step, end);
          el.textContent = start;
          if (start >= end) clearInterval(timer);
        }, 40);

        observer.unobserve(el);
      });
    },
    { threshold: 0.7 }
  );

  cells.forEach(el => observer.observe(el));
}

/* ── Nav: highlight active section on scroll ────────────────────────────── */
function initNavHighlight() {
  const sections = document.querySelectorAll('section[id], div[id]');
  const links    = document.querySelectorAll('.nav-links a[href^="#"]');
  if (!sections.length || !links.length) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const id = entry.target.getAttribute('id');
        links.forEach(link => {
          link.style.color = link.getAttribute('href') === `#${id}`
            ? 'var(--gray-800)' : '';
        });
      });
    },
    { rootMargin: '-40% 0px -55% 0px' }
  );

  sections.forEach(s => observer.observe(s));
}

/* ── Bootstrap ──────────────────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
  initReveal();
  initDeptBars();
  initCounters();
  initNavHighlight();
});