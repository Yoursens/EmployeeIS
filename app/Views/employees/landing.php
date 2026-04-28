<?php
/**
 * landing.php — Employee Information System Landing Page
 * PC21 Advanced Web Development | Terminal Assessment 1
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Employee IS — Modern HR Management</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap">
  <link rel="stylesheet" href="<?= base_url('css/landing.css') ?>">
</head>
<body>

<!-- ── NAV ── -->
<nav class="nav">
  <a href="<?= base_url() ?>" class="nav-brand">
    <span class="nav-brand-word">Employee <span>IS</span></span>
  </a>
  <div class="nav-links">
    <a href="#features">Features</a>
    <a href="#fields">Data Model</a>
    <a href="#departments">Departments</a>
    <a href="#about">About</a>
  </div>
  <div class="nav-cta">
    <a href="<?= base_url('login') ?>"    class="btn-nav-ghost">Sign In</a>
    <a href="<?= base_url('register') ?>" class="btn-nav-solid">Get Started</a>
  </div>
</nav>

<!-- ═══════════════════════════════
     HERO
     ═══════════════════════════════ -->
<section class="hero">

  <!-- Full-bleed background video (existing eis.mp4) -->
  <div class="hero-video-wrap">
    <video class="hero-video-bg" autoplay muted loop playsinline preload="auto">
      <source src="<?= base_url('videos/eis.mp4') ?>" type="video/mp4">
    </video>
    <div class="hero-video-overlay"></div>
  </div>

  <!-- Hero split: text left, showcase video right -->
  <div class="hero-split">

    <!-- Left: text -->
    <div class="hero-content">
      <p class="hero-eyebrow">PC21 Advanced Web Development &mdash; Terminal Assessment 1</p>
      <h1 class="hero-title">HR management.<br><em>Reimagined.</em></h1>
      <p class="hero-subtitle">Beautifully simple. Powerfully organized.</p>
      <div class="hero-actions">
        <a href="<?= base_url('register') ?>" class="btn-primary-apple">Get Started Free</a>
        <a href="<?= base_url('login') ?>" class="btn-ghost-apple">View Records</a>
      </div>
    </div>

    <!-- Right: showcase video card with fake browser chrome -->
    <div class="hero-visual">
      <div class="hero-vid-wrap">
        <!-- Fake macOS browser bar -->
        <div class="hero-vid-chrome">
          <span class="chrome-dot red"></span>
          <span class="chrome-dot yellow"></span>
          <span class="chrome-dot green"></span>
          <div class="chrome-url">localhost:8080/employees</div>
        </div>
        <!-- Showcase video -->
        <video class="hero-vid" autoplay muted loop playsinline preload="auto">
          <source src="<?= base_url('videos/eis1.mp4') ?>" type="video/mp4">
        </video>
      </div>
    </div>

  </div><!-- /hero-split -->

</section><!-- /hero -->


<!-- ═══════════════════════════════
     TICKER BAND
     ═══════════════════════════════ -->
<div class="ticker-band">
  <div class="ticker-inner">
    <?php for ($i = 0; $i < 2; $i++): ?>
      <div class="ticker-item"><span class="ticker-dot"></span> CodeIgniter <em>4</em> MVC Framework</div>
      <div class="ticker-item"><span class="ticker-dot"></span> Full <em>CRUD</em> Operations</div>
      <div class="ticker-item"><span class="ticker-dot"></span> <em>bcrypt</em> Password Hashing</div>
      <div class="ticker-item"><span class="ticker-dot"></span> <em>CSRF</em> Protection</div>
      <div class="ticker-item"><span class="ticker-dot"></span> Server-Side <em>Validation</em></div>
      <div class="ticker-item"><span class="ticker-dot"></span> <em>MySQL</em> Database</div>
      <div class="ticker-item"><span class="ticker-dot"></span> <em>MVC</em> Architecture</div>
      <div class="ticker-item"><span class="ticker-dot"></span> Responsive <em>Design</em></div>
      <div class="ticker-item"><span class="ticker-dot"></span> Session-Based <em>Auth</em></div>
      <div class="ticker-item"><span class="ticker-dot"></span> PHP <em>8.1+</em> Compatible</div>
    <?php endfor; ?>
  </div>
</div>


<!-- ═══════════════════════════════
     STATS ROW
     ═══════════════════════════════ -->
<div class="stats-row reveal" id="features" style="margin-top:56px;">
  <div class="stat-cell">
    <div class="stat-num"><span>8</span></div>
    <div class="stat-label">Employees</div>
  </div>
  <div class="stat-cell">
    <div class="stat-num"><span>6</span></div>
    <div class="stat-label">Departments</div>
  </div>
  <div class="stat-cell">
    <div class="stat-num">CI<span>4</span></div>
    <div class="stat-label">CodeIgniter</div>
  </div>
  <div class="stat-cell">
    <div class="stat-num">CRUD</div>
    <div class="stat-label">Full Operations</div>
  </div>
</div>


<!-- ═══════════════════════════════════════════════
     SYSTEM OVERVIEW
     ═══════════════════════════════════════════════ -->
<section class="overview-section reveal" style="margin-top:56px;">
  <div class="overview-inner">
    <p class="section-eyebrow">System Overview</p>
    <h2 class="section-title">Everything you need.<br><em>Nothing you don't.</em></h2>
    <p class="section-sub">A complete Employee Information System built on CodeIgniter 4, covering all core web development concepts from routing to database security.</p>

    <div class="overview-cards">
      <div class="ov-card">
        <span class="ov-icon">📋</span>
        <div class="ov-label">Core Operations</div>
        <div class="ov-title">Full CRUD on Employee Records</div>
        <div class="ov-desc">Create, read, update, and delete employee records with instant feedback, server-side validation, and flash messaging on every action.</div>
        <div class="ov-tags">
          <span class="ov-tag create">Create</span>
          <span class="ov-tag read">Read</span>
          <span class="ov-tag update">Update</span>
          <span class="ov-tag delete">Delete</span>
        </div>
      </div>
      <div class="ov-card">
        <span class="ov-icon">🔐</span>
        <div class="ov-label">Authentication</div>
        <div class="ov-title">Secure Login & Registration</div>
        <div class="ov-desc">Complete auth flow — register, login, forgot password, and reset — with bcrypt hashing, CSRF tokens, and session-based access control protecting all routes.</div>
        <div class="ov-tags">
          <span class="ov-tag neutral">Register</span>
          <span class="ov-tag neutral">Login</span>
          <span class="ov-tag neutral">Forgot PW</span>
          <span class="ov-tag neutral">Reset PW</span>
        </div>
      </div>
      <div class="ov-card">
        <span class="ov-icon">⚙️</span>
        <div class="ov-label">Architecture</div>
        <div class="ov-title">Clean MVC on CodeIgniter 4</div>
        <div class="ov-desc">Separate Controllers, Models, and Views. Custom routing, mass-assignment protection, query-builder database access, and zero raw SQL for injection safety.</div>
        <div class="ov-tags">
          <span class="ov-tag read">Model</span>
          <span class="ov-tag update">View</span>
          <span class="ov-tag create">Controller</span>
          <span class="ov-tag neutral">Routes</span>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════
     FIELDS TABLE
     ═══════════════════════════════════════════════ -->
<section class="fields-section reveal" id="fields">
  <div class="fields-inner">

    <!-- Centered header -->
    <div class="fields-header">
      <p class="section-eyebrow">Data Model</p>
      <h2 class="section-title">Four fields.<br><em>Endless insight.</em></h2>
      <p class="section-sub">The Employee table is intentionally focused — capturing exactly the data needed for a complete, real-world HR record with proper types and constraints.</p>
    </div>

    <!-- CTA button -->
    <div class="fields-cta">
      <a href="<?= base_url('login') ?>" class="btn-primary-apple">+ Add an Employee</a>
    </div>

    <!-- Full-width table -->
    <div class="fields-table-wrap">
      <div class="fields-table-header">
        <span class="fth-dot"></span>
        <span>employees</span>
        <span style="margin-left:auto;opacity:.35;font-size:.7rem;">MySQL · InnoDB</span>
      </div>
      <table class="fields-table">
        <thead>
          <tr>
            <th>Field</th><th>Type</th><th>Required</th><th>Validation</th>
          </tr>
        </thead>
        <tbody>
          <tr><td><strong>id</strong></td><td><span class="field-badge int">INT UNSIGNED</span></td><td>—</td><td><span class="field-val">Auto-increment PK</span></td></tr>
          <tr><td><strong>name</strong></td><td><span class="field-badge varchar">VARCHAR(100)</span></td><td><span class="field-req">Required</span></td><td><span class="field-val">min: 2 · max: 100 chars</span></td></tr>
          <tr><td><strong>position</strong></td><td><span class="field-badge varchar">VARCHAR(100)</span></td><td><span class="field-req">Required</span></td><td><span class="field-val">min: 2 · max: 100 chars</span></td></tr>
          <tr><td><strong>department</strong></td><td><span class="field-badge varchar">VARCHAR(100)</span></td><td><span class="field-req">Required</span></td><td><span class="field-val">dropdown · 10 options</span></td></tr>
          <tr><td><strong>salary</strong></td><td><span class="field-badge decimal">DECIMAL(12,2)</span></td><td><span class="field-req">Required</span></td><td><span class="field-val">numeric · greater than 0</span></td></tr>
          <tr><td><strong>created_at</strong></td><td><span class="field-badge int">DATETIME</span></td><td>—</td><td><span class="field-val">Auto (CI4 timestamps)</span></td></tr>
          <tr><td><strong>updated_at</strong></td><td><span class="field-badge int">DATETIME</span></td><td>—</td><td><span class="field-val">Auto (CI4 timestamps)</span></td></tr>
        </tbody>
      </table>
    </div>

  </div>
</section>


<!-- ═══════════════════════════════════════════════
     AUTH FLOW STEPS
     ═══════════════════════════════════════════════ -->
<section class="auth-section reveal">
  <div class="auth-inner">
    <p class="section-eyebrow">Authentication Flow</p>
    <h2 class="section-title">Four steps to<br><em>secure access.</em></h2>
    <p class="section-sub">Role-based access control protects every employee record. Only authenticated users can create, edit, or delete data.</p>
    <div class="auth-steps">
      <div class="auth-step">
        <div class="step-num">1</div>
        <span class="step-icon">📝</span>
        <div class="step-title">Register</div>
        <div class="step-desc">Create an account with your name, email, and a secure password. Duplicate emails are rejected automatically.</div>
      </div>
      <div class="auth-step">
        <div class="step-num">2</div>
        <span class="step-icon">🔑</span>
        <div class="step-title">Sign In</div>
        <div class="step-desc">Log in with your credentials. Passwords are verified against a bcrypt hash — never stored in plain text.</div>
      </div>
      <div class="auth-step">
        <div class="step-num">3</div>
        <span class="step-icon">🗂️</span>
        <div class="step-title">Manage Records</div>
        <div class="step-desc">Access the full Employee CRUD system. All routes check your session — unauthenticated requests redirect to login.</div>
      </div>
      <div class="auth-step">
        <div class="step-num">4</div>
        <span class="step-icon">🔄</span>
        <div class="step-title">Reset Password</div>
        <div class="step-desc">Forgot your password? Request a time-limited reset token. Update your password and regain access instantly.</div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════
     DEPARTMENT BREAKDOWN
     ═══════════════════════════════════════════════ -->
<section class="dept-section reveal" id="departments">
  <div class="dept-inner">
    <p class="section-eyebrow">Department Breakdown</p>
    <h2 class="section-title">6 departments.<br><em>8 employees.</em></h2>
    <p class="section-sub" style="margin-bottom:2.5rem;">Seed data covers a realistic cross-section of a Philippine company, from IT and Finance to Legal and Sales.</p>
    <div class="dept-grid">
      <div class="dept-card">
        <div class="dept-color" style="background:rgba(58,123,213,.15);">💻</div>
        <div class="dept-info">
          <div class="dept-name">Information Technology</div>
          <div class="dept-meta">2 employees &nbsp;·&nbsp; Avg. ₱66,500/mo</div>
          <div class="dept-bar-wrap"><div class="dept-bar"><div class="dept-bar-fill" style="width:74%;background:#3a7bd5;"></div></div></div>
        </div>
      </div>
      <div class="dept-card">
        <div class="dept-color" style="background:rgba(245,200,66,.12);">💰</div>
        <div class="dept-info">
          <div class="dept-name">Finance</div>
          <div class="dept-meta">1 employee &nbsp;·&nbsp; ₱68,000/mo</div>
          <div class="dept-bar-wrap"><div class="dept-bar"><div class="dept-bar-fill" style="width:76%;background:#f5c842;"></div></div></div>
        </div>
      </div>
      <div class="dept-card">
        <div class="dept-color" style="background:rgba(255,160,80,.12);">🧑‍💼</div>
        <div class="dept-info">
          <div class="dept-name">Human Resources</div>
          <div class="dept-meta">1 employee &nbsp;·&nbsp; ₱45,000/mo</div>
          <div class="dept-bar-wrap"><div class="dept-bar"><div class="dept-bar-fill" style="width:50%;background:#ffaa55;"></div></div></div>
        </div>
      </div>
      <div class="dept-card">
        <div class="dept-color" style="background:rgba(176,111,216,.12);">⚖️</div>
        <div class="dept-info">
          <div class="dept-name">Legal</div>
          <div class="dept-meta">1 employee &nbsp;·&nbsp; ₱90,000/mo</div>
          <div class="dept-bar-wrap"><div class="dept-bar"><div class="dept-bar-fill" style="width:100%;background:#b06fd8;"></div></div></div>
        </div>
      </div>
      <div class="dept-card">
        <div class="dept-color" style="background:rgba(46,170,160,.12);">🏭</div>
        <div class="dept-info">
          <div class="dept-name">Operations</div>
          <div class="dept-meta">1 employee &nbsp;·&nbsp; ₱55,000/mo</div>
          <div class="dept-bar-wrap"><div class="dept-bar"><div class="dept-bar-fill" style="width:61%;background:#2eaaa0;"></div></div></div>
        </div>
      </div>
      <div class="dept-card">
        <div class="dept-color" style="background:rgba(80,180,120,.12);">📈</div>
        <div class="dept-info">
          <div class="dept-name">Sales</div>
          <div class="dept-meta">1 employee &nbsp;·&nbsp; ₱38,000/mo</div>
          <div class="dept-bar-wrap"><div class="dept-bar"><div class="dept-bar-fill" style="width:42%;background:#50c878;"></div></div></div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════
     FEATURE TILES
     ═══════════════════════════════ -->
<div class="tiles reveal">
  <div class="tile tile-dark tile-wide">
    <div class="tile-label">Employee Records</div>
    <div class="tile-body">
      <div class="tile-text">
        <div class="tile-title">All your people.<br><em>One place.</em></div>
        <p class="tile-desc">Search, filter, and manage every employee record instantly. Add, edit, or remove with full audit timestamps.</p>
        <a href="<?= base_url('login') ?>" class="tile-link">Explore Records</a>
      </div>
      <div class="tile-cards">
        <div class="mini-card">
          <div class="mini-card-label">Top Salary</div>
          <div class="mini-card-value">₱90K</div>
          <div class="mini-card-sub">Legal Counsel</div>
        </div>
        <div class="mini-card">
          <div class="mini-card-label">Departments</div>
          <div class="mini-card-value">6</div>
          <div class="mini-card-sub">Active divisions</div>
        </div>
      </div>
    </div>
  </div>
  <div class="tile tile-blue">
    <div class="tile-icon">🔍</div>
    <div class="tile-label">Instant Search</div>
    <div class="tile-title">Find anyone,<br><em>instantly.</em></div>
    <p class="tile-desc">Filter by name, position, or department in real time. No page reloads, no waiting.</p>
    <a href="<?= base_url('login') ?>" class="tile-link">Search Records</a>
  </div>
  <div class="tile tile-light">
    <div class="tile-icon">🔐</div>
    <div class="tile-label">Secure Auth</div>
    <div class="tile-title">Protected<br><em>access control.</em></div>
    <p class="tile-desc">CSRF-protected forms, bcrypt password hashing, session management, and token-based password reset.</p>
    <a href="<?= base_url('register') ?>" class="tile-link">Create Account</a>
  </div>
  <div class="tile tile-green">
    <div class="tile-icon">💰</div>
    <div class="tile-label">Salary Tracking</div>
    <div class="tile-title">Compensation,<br><em>clearly.</em></div>
    <p class="tile-desc">Philippine Peso formatting, live salary preview on forms, and at-a-glance visibility across all records.</p>
    <a href="<?= base_url('login') ?>" class="tile-link">Add Employee</a>
  </div>
  <div class="tile tile-dark">
    <div class="tile-icon">⚙️</div>
    <div class="tile-label">Architecture</div>
    <div class="tile-title">Pure<br><em>MVC.</em></div>
    <p class="tile-desc">CodeIgniter 4 with clean Controllers, Models, and Views. Server-side validation and CSRF protection throughout.</p>
    <a href="<?= base_url('register') ?>" class="tile-link">Get Started</a>
  </div>
</div>


<!-- ═══════════════════════════════
     CTA
     ═══════════════════════════════ -->
<section class="cta-banner reveal" id="about">
  <h2>Ready to get organized?</h2>
  <p>Set up in minutes. No configuration headaches.</p>
  <div class="cta-actions">
    <a href="<?= base_url('register') ?>" class="btn-primary-apple">Create Free Account</a>
    <a href="<?= base_url('login') ?>" class="btn-ghost-apple" style="color:#00d9a3;">Sign In</a>
  </div>
</section>


<!-- ═══════════════════════════════
     FOOTER
     ═══════════════════════════════ -->
<footer class="footer-wrap">
  <div class="footer-inner">
    <div class="footer-top">
      <div class="footer-col">
        <div class="footer-col-title">System</div>
        <a href="<?= base_url('login') ?>">Records</a>
        <a href="<?= base_url('login') ?>">Add Employee</a>
        <a href="<?= base_url('login') ?>">Sign In</a>
        <a href="<?= base_url('register') ?>">Register</a>
        <a href="<?= base_url('forgot-password') ?>">Forgot Password</a>
      </div>
      <div class="footer-col">
        <div class="footer-col-title">Departments</div>
        <a href="#">Information Technology</a>
        <a href="#">Finance</a>
        <a href="#">Human Resources</a>
        <a href="#">Legal</a>
      </div>
      <div class="footer-col">
        <div class="footer-col-title">More Depts.</div>
        <a href="#">Operations</a>
        <a href="#">Sales</a>
        <a href="#">Marketing</a>
        <a href="#">Procurement</a>
      </div>
      <div class="footer-col">
        <div class="footer-col-title">Project</div>
        <a href="#">PC21 — Terminal Assessment 1</a>
        <a href="#">Advanced Web Development</a>
        <a href="#">CodeIgniter 4 Framework</a>
        <a href="#">MVC Architecture</a>
      </div>
    </div>
    <div class="footer-bottom">
      <span>Copyright &copy; <?= date('Y') ?> Employee IS &mdash; PC21 Terminal Assessment 1</span>
      <div style="display:flex;gap:1.5rem;">
        <a href="<?= base_url('login') ?>">Sign In</a>
        <a href="<?= base_url('register') ?>">Register</a>
        <a href="<?= base_url('login') ?>">Records</a>
      </div>
    </div>
  </div>
</footer>

<script src="<?= base_url('js/landing.js') ?>"></script>
</body>
</html>