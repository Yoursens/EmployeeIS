<?php
/**
 * views/employees/view.php
 * Single Employee Detail Page
 * PC21 Advanced Web Development | Terminal Assessment 1
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($employee['name']) ?> | EIS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600&family=DM+Serif+Display:ital@0;1&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('css/view.css') ?>">
</head>
<body>

<!-- ── Nav ──────────────────────────────────────────────────── -->
<nav class="v-nav">
  <div class="v-nav-inner">
    <a href="<?= base_url('employees') ?>" class="v-brand">
      Employee<span>IS</span>
    </a>
    <div class="v-nav-links">
      <a href="<?= base_url('employees') ?>" class="v-nav-link">
        <i class="fa-solid fa-chevron-left"></i> Records
      </a>
      <a href="<?= base_url('employees/create') ?>" class="v-nav-link">Add Employee</a>
    </div>
    <div class="v-nav-end">
      <span class="v-nav-user">
        <i class="fa-solid fa-circle-user"></i>
        <?= esc(session()->get('user_name') ?? 'Account') ?>
      </span>
      <a href="<?= base_url('logout') ?>" class="v-nav-logout">Sign out</a>
    </div>
  </div>
</nav>

<!-- ── Page ─────────────────────────────────────────────────── -->
<div class="v-page">

  <!-- ── Hero Banner ──────────────────────────────────────────── -->
  <section class="v-hero">
    <div class="v-hero-glow" aria-hidden="true"></div>
    <div class="v-hero-inner">

      <!-- Avatar -->
      <div class="v-avatar-wrap">
        <div class="v-avatar">
          <?= mb_strtoupper(mb_substr($employee['name'], 0, 2)) ?>
        </div>
        <span class="v-avatar-ring" aria-hidden="true"></span>
      </div>

      <!-- Name + meta -->
      <div class="v-hero-text">
        <p class="v-hero-eyebrow">PC21 · Terminal Assessment 1</p>
        <h1 class="v-hero-name"><?= esc($employee['name']) ?></h1>
        <p class="v-hero-meta">
          <span class="v-position-tag"><?= esc($employee['position']) ?></span>
          <span class="v-sep" aria-hidden="true">·</span>
          <span class="v-dept-tag dept-<?= strtolower(preg_replace('/\s+/', '-', $employee['department'])) ?>">
            <?= esc($employee['department']) ?>
          </span>
        </p>
      </div>

    </div>
  </section>

  <!-- ── Main ─────────────────────────────────────────────────── -->
  <main class="v-main">

    <!-- Breadcrumb -->
    <nav class="v-breadcrumb" aria-label="breadcrumb">
      <a href="<?= base_url('employees') ?>" class="v-bc-link">
        <i class="fa-solid fa-users"></i> Employees
      </a>
      <i class="fa-solid fa-chevron-right v-bc-sep"></i>
      <span class="v-bc-current"><?= esc($employee['name']) ?></span>
    </nav>

    <!-- Two-column layout -->
    <div class="v-layout">

      <!-- ── Detail Card ───────────────────────────────────────── -->
      <div class="v-card">
        <div class="v-card-header">
          <h2 class="v-card-title">Employee Information</h2>
          <span class="v-id-badge">ID #<?= $employee['id'] ?></span>
        </div>

        <div class="v-fields">

          <div class="v-field">
            <span class="v-field-icon"><i class="fa-solid fa-user"></i></span>
            <div class="v-field-body">
              <span class="v-field-label">Full Name</span>
              <span class="v-field-value"><?= esc($employee['name']) ?></span>
            </div>
          </div>

          <div class="v-field">
            <span class="v-field-icon"><i class="fa-solid fa-briefcase"></i></span>
            <div class="v-field-body">
              <span class="v-field-label">Position</span>
              <span class="v-field-value"><?= esc($employee['position']) ?></span>
            </div>
          </div>

          <div class="v-field">
            <span class="v-field-icon"><i class="fa-solid fa-building"></i></span>
            <div class="v-field-body">
              <span class="v-field-label">Department</span>
              <span class="v-field-value">
                <span class="v-badge dept-<?= strtolower(preg_replace('/\s+/', '-', $employee['department'])) ?>">
                  <?= esc($employee['department']) ?>
                </span>
              </span>
            </div>
          </div>

          <div class="v-field v-field--highlight">
            <span class="v-field-icon v-field-icon--salary"><i class="fa-solid fa-peso-sign"></i></span>
            <div class="v-field-body">
              <span class="v-field-label">Monthly Salary</span>
              <span class="v-field-value v-salary">
                &#8369;<?= number_format((float)$employee['salary'], 2) ?>
              </span>
            </div>
          </div>

          <div class="v-field">
            <span class="v-field-icon"><i class="fa-solid fa-calendar-plus"></i></span>
            <div class="v-field-body">
              <span class="v-field-label">Date Added</span>
              <span class="v-field-value">
                <?= date('F d, Y', strtotime($employee['created_at'])) ?>
                <span class="v-time"><?= date('h:i A', strtotime($employee['created_at'])) ?></span>
              </span>
            </div>
          </div>

          <?php if (!empty($employee['updated_at']) && $employee['updated_at'] !== $employee['created_at']): ?>
          <div class="v-field">
            <span class="v-field-icon"><i class="fa-solid fa-calendar-pen"></i></span>
            <div class="v-field-body">
              <span class="v-field-label">Last Updated</span>
              <span class="v-field-value">
                <?= date('F d, Y', strtotime($employee['updated_at'])) ?>
                <span class="v-time"><?= date('h:i A', strtotime($employee['updated_at'])) ?></span>
              </span>
            </div>
          </div>
          <?php endif; ?>

        </div>
      </div>

      <!-- ── Side Panel ────────────────────────────────────────── -->
      <aside class="v-side">

        <!-- Quick stats -->
        <div class="v-stat-card">
          <p class="v-stat-label">Employee ID</p>
          <p class="v-stat-val">#<?= $employee['id'] ?></p>
        </div>
        <div class="v-stat-card v-stat-card--salary">
          <p class="v-stat-label">Monthly Salary</p>
          <p class="v-stat-val">&#8369;<?= number_format((float)$employee['salary'], 2) ?></p>
        </div>
        <div class="v-stat-card">
          <p class="v-stat-label">Member Since</p>
          <p class="v-stat-val v-stat-val--sm"><?= date('M Y', strtotime($employee['created_at'])) ?></p>
        </div>

        <!-- Actions -->
        <div class="v-actions">
          <a href="<?= base_url('employees/edit/' . $employee['id']) ?>" class="v-btn v-btn--edit">
            <i class="fa-solid fa-pen-to-square"></i> Edit Record
          </a>
          <button
            class="v-btn v-btn--delete act-delete"
            data-delete-url="<?= base_url('employees/delete/' . $employee['id']) ?>"
            data-name="<?= esc($employee['name']) ?>">
            <i class="fa-solid fa-trash"></i> Delete
          </button>
          <a href="<?= base_url('employees') ?>" class="v-btn v-btn--back">
            <i class="fa-solid fa-arrow-left"></i> Back to List
          </a>
        </div>

      </aside>
    </div><!-- /v-layout -->

  </main>

  <!-- ── Footer ───────────────────────────────────────────────── -->
  <footer class="v-footer">
    <span>© <?= date('Y') ?> Employee IS</span>
    <span class="v-footer-sep">·</span>
    <span>PC21 Advanced Web Development</span>
    <span class="v-footer-sep">·</span>
    <span>Terminal Assessment 1</span>
  </footer>

</div><!-- /v-page -->

<!-- ── Delete Modal ─────────────────────────────────────────── -->
<div id="deleteModal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
  <div class="modal-box">
    <div class="modal-icon-wrap">
      <i class="fa-solid fa-trash modal-trash-icon"></i>
    </div>
    <h3 id="modalTitle">Delete Employee?</h3>
    <p>You're about to permanently delete<br><strong id="deleteTargetName"></strong>.<br>This action cannot be undone.</p>
    <div class="modal-actions">
      <button class="modal-btn modal-cancel" data-dismiss="modal">Cancel</button>
      <a id="confirmDeleteBtn" href="#" class="modal-btn modal-confirm">Delete</a>
    </div>
  </div>
</div>

<script src="<?= base_url('js/employees.js') ?>"></script>
</body>
</html>