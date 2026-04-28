<?php
/**
 * views/employees/edit.php
 * Edit Employee Record Form (UPDATE — CRUD)
 * PC21 Advanced Web Development | Terminal Assessment 1
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title) ?> | EIS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600&family=DM+Serif+Display:ital@0;1&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('css/edit.css') ?>">
</head>
<body>

<!-- ── Nav ──────────────────────────────────────────────────── -->
<nav class="e-nav">
  <div class="e-nav-inner">
    <a href="<?= base_url('employees') ?>" class="e-brand">
      Employee<span>IS</span>
    </a>
    <div class="e-nav-links">
      <a href="<?= base_url('employees') ?>" class="e-nav-link">
        <i class="fa-solid fa-chevron-left"></i> Records
      </a>
      <a href="<?= base_url('employees/create') ?>" class="e-nav-link">Add Employee</a>
    </div>
    <div class="e-nav-end">
      <span class="e-nav-user">
        <i class="fa-solid fa-circle-user"></i>
        <?= esc(session()->get('user_name') ?? 'Account') ?>
      </span>
      <a href="<?= base_url('logout') ?>" class="e-nav-logout">Sign out</a>
    </div>
  </div>
</nav>

<!-- ── Page ─────────────────────────────────────────────────── -->
<div class="e-page">

  <!-- Fullpage background video — place at public/videos/hero.mp4 -->
  <video
    class="e-bg-video"
    src="<?= base_url('videos/hero.mp4') ?>"
    autoplay loop muted playsinline
    aria-hidden="true"
  ></video>
  <div class="e-bg-overlay" aria-hidden="true"></div>

  <!-- ── Hero Banner ──────────────────────────────────────────── -->
  <section class="e-hero">
    <div class="e-hero-glow" aria-hidden="true"></div>
    <div class="e-hero-inner">

      <!-- Avatar -->
      <div class="e-avatar-wrap">
        <div class="e-avatar">
          <?= mb_strtoupper(mb_substr($employee['name'], 0, 2)) ?>
        </div>
        <span class="e-avatar-ring" aria-hidden="true"></span>
      </div>

      <!-- Title -->
      <div class="e-hero-text">
        <p class="e-hero-eyebrow">PC21 · Terminal Assessment 1</p>
        <h1 class="e-hero-name">Edit <em>Record.</em></h1>
        <p class="e-hero-meta">
          Updating information for
          <span class="e-hero-emp"><?= esc($employee['name']) ?></span>
          <span class="e-sep">·</span>
          <span class="e-id-chip">ID #<?= $employee['id'] ?></span>
        </p>
      </div>

    </div>
  </section>

  <!-- ── Main ─────────────────────────────────────────────────── -->
  <main class="e-main">

    <!-- Breadcrumb -->
    <nav class="e-breadcrumb" aria-label="breadcrumb">
      <a href="<?= base_url('employees') ?>" class="e-bc-link">
        <i class="fa-solid fa-users"></i> Employees
      </a>
      <i class="fa-solid fa-chevron-right e-bc-sep"></i>
      <a href="<?= base_url('employees/view/' . $employee['id']) ?>" class="e-bc-link">
        <?= esc($employee['name']) ?>
      </a>
      <i class="fa-solid fa-chevron-right e-bc-sep"></i>
      <span class="e-bc-current">Edit</span>
    </nav>

    <!-- Form Card -->
    <div class="e-card">

      <div class="e-card-header">
        <div class="e-card-header-left">
          <span class="e-card-icon"><i class="fa-solid fa-pen-to-square"></i></span>
          <h2 class="e-card-title">Edit Employee</h2>
        </div>
        <span class="e-id-badge">ID #<?= $employee['id'] ?></span>
      </div>

      <div class="e-card-body">
        <form
          id="employeeForm"
          action="<?= base_url('employees/update/' . $employee['id']) ?>"
          method="POST"
          novalidate
        >
          <?= csrf_field() ?>

          <div class="e-form-grid">

            <!-- Full Name -->
            <div class="e-form-group e-full">
              <label class="e-label" for="nameInput">
                Full Name <span class="e-req">*</span>
              </label>
              <div class="e-input-wrap">
                <i class="fa-solid fa-user e-input-icon"></i>
                <input
                  type="text"
                  id="nameInput"
                  name="name"
                  class="e-input <?= $validation->hasError('name') ? 'is-invalid' : '' ?>"
                  value="<?= old('name', esc($employee['name'])) ?>"
                  maxlength="100"
                  data-required
                  autocomplete="name"
                  placeholder="Enter full name"
                >
              </div>
              <?php if ($validation->hasError('name')): ?>
              <span class="e-error"><i class="fa-solid fa-circle-exclamation"></i> <?= $validation->getError('name') ?></span>
              <?php endif; ?>
            </div>

            <!-- Position -->
            <div class="e-form-group">
              <label class="e-label" for="positionInput">
                Position <span class="e-req">*</span>
              </label>
              <div class="e-input-wrap">
                <i class="fa-solid fa-briefcase e-input-icon"></i>
                <input
                  type="text"
                  id="positionInput"
                  name="position"
                  class="e-input <?= $validation->hasError('position') ? 'is-invalid' : '' ?>"
                  value="<?= old('position', esc($employee['position'])) ?>"
                  maxlength="100"
                  data-required
                  placeholder="e.g. Senior Developer"
                >
              </div>
              <?php if ($validation->hasError('position')): ?>
              <span class="e-error"><i class="fa-solid fa-circle-exclamation"></i> <?= $validation->getError('position') ?></span>
              <?php endif; ?>
            </div>

            <!-- Department -->
            <div class="e-form-group">
              <label class="e-label" for="departmentInput">
                Department <span class="e-req">*</span>
              </label>
              <div class="e-input-wrap e-select-wrap">
                <i class="fa-solid fa-building e-input-icon"></i>
                <select
                  id="departmentInput"
                  name="department"
                  class="e-input e-select <?= $validation->hasError('department') ? 'is-invalid' : '' ?>"
                  data-required
                >
                  <option value="">— Select Department —</option>
                  <?php
                  $departments = [
                    'Administration','Finance','Human Resources',
                    'Information Technology','Marketing','Operations',
                    'Research & Development','Sales','Legal','Procurement'
                  ];
                  $currentDept = old('department', $employee['department']);
                  foreach ($departments as $dept):
                    $selected = ($currentDept === $dept) ? 'selected' : '';
                  ?>
                    <option value="<?= $dept ?>" <?= $selected ?>><?= $dept ?></option>
                  <?php endforeach; ?>
                </select>
                <i class="fa-solid fa-chevron-down e-select-chevron"></i>
              </div>
              <?php if ($validation->hasError('department')): ?>
              <span class="e-error"><i class="fa-solid fa-circle-exclamation"></i> <?= $validation->getError('department') ?></span>
              <?php endif; ?>
            </div>

            <!-- Salary -->
            <div class="e-form-group e-full">
              <label class="e-label" for="salaryInput">
                Monthly Salary (PHP) <span class="e-req">*</span>
              </label>
              <div class="e-input-wrap">
                <i class="fa-solid fa-peso-sign e-input-icon"></i>
                <input
                  type="number"
                  id="salaryInput"
                  name="salary"
                  class="e-input <?= $validation->hasError('salary') ? 'is-invalid' : '' ?>"
                  value="<?= old('salary', $employee['salary']) ?>"
                  min="1"
                  step="0.01"
                  data-required
                  placeholder="0.00"
                >
              </div>
              <p class="e-hint">
                <i class="fa-solid fa-circle-info"></i>
                Current salary: <strong>&#8369;<?= number_format((float)$employee['salary'], 2) ?></strong>
              </p>
              <?php if ($validation->hasError('salary')): ?>
              <span class="e-error"><i class="fa-solid fa-circle-exclamation"></i> <?= $validation->getError('salary') ?></span>
              <?php endif; ?>
            </div>

          </div><!-- /e-form-grid -->

          <!-- Form Footer -->
          <div class="e-form-footer">
            <a href="<?= base_url('employees/view/' . $employee['id']) ?>" class="e-btn e-btn--cancel">
              <i class="fa-solid fa-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="e-btn e-btn--submit">
              <i class="fa-solid fa-floppy-disk"></i> Update Employee
            </button>
          </div>

        </form>
      </div><!-- /e-card-body -->

    </div><!-- /e-card -->

  </main>

  <!-- ── Footer ───────────────────────────────────────────────── -->
  <footer class="e-footer">
    <span>© <?= date('Y') ?> Employee IS</span>
    <span class="e-footer-sep">·</span>
    <span>PC21 Advanced Web Development</span>
    <span class="e-footer-sep">·</span>
    <span>Terminal Assessment 1</span>
  </footer>

</div><!-- /e-page -->

<script src="<?= base_url('js/employees.js') ?>"></script>
</body>
</html>