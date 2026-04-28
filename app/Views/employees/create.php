<?php
/**
 * views/employees/create.php
 * Add New Employee — Apple.com aesthetic
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('css/employees.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/create.css') ?>">
</head>
<body>

<!-- ── Nav ────────────────────────────────────────────────── -->
<nav class="eis-nav">
  <div class="nav-inner">
    <a href="<?= base_url('employees') ?>" class="nav-brand">
      Employee<span>IS</span>
    </a>
    <div class="nav-links">
      <a href="<?= base_url('employees') ?>" class="nav-link">Records</a>
      <a href="<?= base_url('employees/create') ?>" class="nav-link active">Add Employee</a>
    </div>
    <div class="nav-end">
      <span class="nav-user">
        <i class="fa-solid fa-circle-user"></i>
        <?= esc(session()->get('user_name') ?? 'Account') ?>
      </span>
      <a href="<?= base_url('logout') ?>" class="nav-logout">Sign out</a>
    </div>
  </div>
</nav>

<!-- ── Page shell ─────────────────────────────────────────── -->
<div class="page-shell">

  <!-- ── Fullpage background video ────────────────────────── -->
  <video
    class="create-bg-video"
    src="<?= base_url('videos/hero.mp4') ?>"
    autoplay loop muted playsinline
    aria-hidden="true"
  ></video>
  <div class="create-bg-overlay" aria-hidden="true"></div>

  <!-- ── Hero strip ───────────────────────────────────────── -->
  <section class="hero-strip">
    <div class="hero-inner">
      <div class="hero-text">
        <p class="hero-eyebrow">Employee Records</p>
        <h1 class="hero-title">Add <em>New Employee.</em></h1>
        <p class="hero-sub">Fill in the details below to create a new record.</p>
      </div>
    </div>
  </section>

  <!-- ── Main ─────────────────────────────────────────────── -->
  <main class="eis-main create-main">

    <!-- Breadcrumb -->
    <nav class="breadcrumb" aria-label="breadcrumb">
      <a href="<?= base_url('employees') ?>" class="bc-link">
        <i class="fa-solid fa-house-chimney"></i> Employees
      </a>
      <span class="bc-sep"><i class="fa-solid fa-chevron-right"></i></span>
      <span class="bc-current">Add New</span>
    </nav>

    <!-- Two-column layout: form left, tips right -->
    <div class="create-layout">

      <!-- ── Form card ───────────────────────────────────── -->
      <div class="form-card">

        <div class="form-card-head">
          <div class="form-card-icon">
            <i class="fa-solid fa-user-plus"></i>
          </div>
          <div>
            <h2 class="form-card-title">Employee Information</h2>
            <p class="form-card-sub">All fields marked <span class="req">*</span> are required.</p>
          </div>
        </div>

        <div class="form-card-divider"></div>

        <!-- Validation error summary -->
        <?php if (isset($validation) && $validation->getErrors()): ?>
        <div class="flash flash-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          <span>Please fix the errors below before saving.</span>
        </div>
        <?php endif; ?>

        <form id="employeeForm"
              action="<?= base_url('employees/store') ?>"
              method="POST"
              novalidate>
          <?= csrf_field() ?>

          <!-- Full Name -->
          <div class="field-group">
            <label class="field-label" for="nameInput">
              Full Name <span class="req">*</span>
            </label>
            <div class="field-wrap">
              <i class="fa-solid fa-user field-icon"></i>
              <input
                type="text"
                id="nameInput"
                name="name"
                class="field-input <?= (isset($validation) && $validation->hasError('name')) ? 'is-invalid' : '' ?>"
                placeholder="e.g. Maria Clara Santos"
                value="<?= old('name') ?>"
                maxlength="100"
                autocomplete="name"
              >
            </div>
            <div class="field-error <?= (isset($validation) && $validation->hasError('name')) ? 'show' : '' ?>">
              <i class="fa-solid fa-circle-exclamation"></i>
              <?= (isset($validation) && $validation->hasError('name'))
                  ? $validation->getError('name')
                  : 'Full name is required.' ?>
            </div>
          </div>

          <!-- Position -->
          <div class="field-group">
            <label class="field-label" for="positionInput">
              Position <span class="req">*</span>
            </label>
            <div class="field-wrap">
              <i class="fa-solid fa-briefcase field-icon"></i>
              <input
                type="text"
                id="positionInput"
                name="position"
                class="field-input <?= (isset($validation) && $validation->hasError('position')) ? 'is-invalid' : '' ?>"
                placeholder="e.g. Senior Software Engineer"
                value="<?= old('position') ?>"
                maxlength="100"
              >
            </div>
            <div class="field-error <?= (isset($validation) && $validation->hasError('position')) ? 'show' : '' ?>">
              <i class="fa-solid fa-circle-exclamation"></i>
              <?= (isset($validation) && $validation->hasError('position'))
                  ? $validation->getError('position')
                  : 'Position is required.' ?>
            </div>
          </div>

          <!-- Department -->
          <div class="field-group">
            <label class="field-label" for="departmentInput">
              Department <span class="req">*</span>
            </label>
            <div class="field-wrap select-wrap">
              <i class="fa-solid fa-building field-icon"></i>
              <select
                id="departmentInput"
                name="department"
                class="field-input field-select <?= (isset($validation) && $validation->hasError('department')) ? 'is-invalid' : '' ?>"
              >
                <option value="">— Select Department —</option>
                <?php
                $departments = [
                  'Administration','Finance','Human Resources',
                  'Information Technology','Legal','Marketing',
                  'Operations','Procurement','Research & Development','Sales'
                ];
                foreach ($departments as $dept):
                  $selected = (old('department') === $dept) ? 'selected' : '';
                ?>
                  <option value="<?= $dept ?>" <?= $selected ?>><?= $dept ?></option>
                <?php endforeach; ?>
              </select>
              <i class="fa-solid fa-chevron-down select-caret"></i>
            </div>
            <div class="field-error <?= (isset($validation) && $validation->hasError('department')) ? 'show' : '' ?>">
              <i class="fa-solid fa-circle-exclamation"></i>
              <?= (isset($validation) && $validation->hasError('department'))
                  ? $validation->getError('department')
                  : 'Department is required.' ?>
            </div>
          </div>

          <!-- Salary -->
          <div class="field-group">
            <label class="field-label" for="salaryInput">
              Monthly Salary (PHP) <span class="req">*</span>
            </label>
            <div class="field-wrap">
              <span class="field-prefix">₱</span>
              <input
                type="number"
                id="salaryInput"
                name="salary"
                class="field-input field-salary <?= (isset($validation) && $validation->hasError('salary')) ? 'is-invalid' : '' ?>"
                placeholder="0.00"
                value="<?= old('salary') ?>"
                min="1" step="0.01"
              >
            </div>
            <!-- Live salary preview -->
            <div class="salary-preview" id="salaryPreview" style="display:none;">
              <i class="fa-solid fa-peso-sign"></i>
              <span id="salaryPreviewVal"></span> per month
            </div>
            <div class="field-error <?= (isset($validation) && $validation->hasError('salary')) ? 'show' : '' ?>">
              <i class="fa-solid fa-circle-exclamation"></i>
              <?= (isset($validation) && $validation->hasError('salary'))
                  ? $validation->getError('salary')
                  : 'A valid salary greater than 0 is required.' ?>
            </div>
          </div>

          <!-- Actions -->
          <div class="form-actions">
            <a href="<?= base_url('employees') ?>" class="btn-cancel">
              <i class="fa-solid fa-arrow-left"></i> Cancel
            </a>
            <button type="submit" class="btn-save" id="saveBtn">
              <i class="fa-solid fa-check"></i> Save Employee
            </button>
          </div>

        </form>
      </div><!-- /form-card -->

      <!-- ── Side tips ────────────────────────────────────── -->
      <aside class="side-tips">

        <div class="tips-card">
          <h3 class="tips-title">
            <i class="fa-solid fa-lightbulb"></i> Tips
          </h3>
          <ul class="tips-list">
            <li>Use the employee's <strong>full legal name</strong> as it appears on official documents.</li>
            <li>Position should reflect their <strong>official job title</strong>.</li>
            <li>Select the <strong>primary department</strong> they belong to.</li>
            <li>Salary is the <strong>monthly gross</strong> in Philippine Peso.</li>
          </ul>
        </div>

        <div class="tips-card tips-card-alt">
          <h3 class="tips-title">
            <i class="fa-solid fa-shield-halved"></i> Data Policy
          </h3>
          <p class="tips-body">All employee records are stored securely. Access is restricted to authenticated users only. Records are protected against CSRF attacks.</p>
        </div>

        <div class="dept-preview-card" id="deptPreviewCard" style="display:none;">
          <p class="dept-preview-label">Selected Department</p>
          <p class="dept-preview-name" id="deptPreviewName">—</p>
          <span class="dept-preview-badge" id="deptPreviewBadge"></span>
        </div>

      </aside>

    </div><!-- /create-layout -->

  </main>

  <!-- ── Footer ───────────────────────────────────────────── -->
  <footer class="eis-footer">
    <span>© <?= date('Y') ?> Employee IS</span>
    <span class="footer-sep">·</span>
    <span>PC21 Advanced Web Development</span>
    <span class="footer-sep">·</span>
    <span>Terminal Assessment 1</span>
  </footer>

</div><!-- /page-shell -->

<script src="<?= base_url('js/employees.js') ?>"></script>
<script>
// ── Live salary preview ───────────────────────────────────
const salaryInput   = document.getElementById('salaryInput');
const salaryPreview = document.getElementById('salaryPreview');
const salaryVal     = document.getElementById('salaryPreviewVal');

salaryInput?.addEventListener('input', () => {
  const v = parseFloat(salaryInput.value);
  if (v > 0) {
    salaryPreview.style.display = 'flex';
    salaryVal.textContent = new Intl.NumberFormat('en-PH', {
      minimumFractionDigits: 2, maximumFractionDigits: 2
    }).format(v);
  } else {
    salaryPreview.style.display = 'none';
  }
});

// ── Department preview card ───────────────────────────────
const deptSelect      = document.getElementById('departmentInput');
const deptCard        = document.getElementById('deptPreviewCard');
const deptName        = document.getElementById('deptPreviewName');
const deptBadge       = document.getElementById('deptPreviewBadge');

const deptColors = {
  'Administration':        '#6e6e73',
  'Finance':               '#b7770d',
  'Human Resources':       '#a05e05',
  'Information Technology':'#005bb5',
  'Legal':                 '#8a35b7',
  'Marketing':             '#c0001e',
  'Operations':            '#1a7fa0',
  'Procurement':           '#5a5a5a',
  'Research & Development':'#1a7a32',
  'Sales':                 '#1d8348',
};

deptSelect?.addEventListener('change', () => {
  const val = deptSelect.value;
  if (val) {
    deptCard.style.display = 'block';
    deptName.textContent  = val;
    const c = deptColors[val] || '#0071e3';
    deptBadge.textContent = val;
    deptBadge.style.cssText = `background:${c}18;color:${c};border:1px solid ${c}30;`;
  } else {
    deptCard.style.display = 'none';
  }
});
</script>
</body>
</html>