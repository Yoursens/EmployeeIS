<?php
/**
 * register.php — Apple-style split: Form 60% LEFT · eis.png 40% RIGHT
 * PC21 Advanced Web Development | Terminal Assessment 1
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Account — Employee IS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('css/register.css') ?>">
</head>
<body>

<!-- ── Fixed top nav ─────────────────────────────────────────── -->
<nav class="apple-nav">
  <a href="<?= base_url() ?>" class="apple-nav-brand">Employee<span>IS</span></a>
  <a href="<?= base_url('login') ?>" class="apple-nav-link">Sign in</a>
</nav>

<!-- ── Full-height 60 / 40 split ─────────────────────────────── -->
<div class="split-page">

  <!-- ════════════════════════════════════
       LEFT 60% — Registration Form
       ════════════════════════════════════ -->
  <div class="form-panel">
    <div class="form-inner">

      <!-- Logo -->
      <div class="card-logo">
        <a href="<?= base_url() ?>">
          <span class="logo-dot"></span>
          Employee<span>IS</span>
        </a>
      </div>

      <!-- Heading -->
      <div class="card-heading">
        <h1>Create your account.</h1>
        <p>One account is all you need to manage employee records.</p>
      </div>

      <div class="card-divider"></div>

      <!-- Flash errors -->
      <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-error show">
        <i class="fa-solid fa-circle-exclamation"></i>
        <span><?= session()->getFlashdata('error') ?></span>
      </div>
      <?php endif; ?>

      <?php if (isset($validation) && $validation->hasError('email')): ?>
      <div class="alert alert-error show">
        <i class="fa-solid fa-circle-exclamation"></i>
        <span><?= $validation->getError('email') ?></span>
      </div>
      <?php endif; ?>

      <!-- Form -->
      <form id="registerForm" action="<?= base_url('register') ?>" method="POST" novalidate>
        <?= csrf_field() ?>

        <!-- First + Last name -->
        <div class="form-row-2">
          <div class="form-group">
            <label for="firstNameInput">First Name <span class="req">*</span></label>
            <div class="input-wrap">
              <i class="fa-solid fa-user input-icon"></i>
              <input type="text" id="firstNameInput" name="first_name"
                placeholder="Maria" value="<?= old('first_name') ?>"
                autocomplete="given-name" data-required>
            </div>
            <div class="field-error" id="firstNameError">
              <i class="fa-solid fa-circle-exclamation"></i> First name is required.
            </div>
          </div>

          <div class="form-group">
            <label for="lastNameInput">Last Name <span class="req">*</span></label>
            <div class="input-wrap">
              <i class="fa-solid fa-user input-icon"></i>
              <input type="text" id="lastNameInput" name="last_name"
                placeholder="Santos" value="<?= old('last_name') ?>"
                autocomplete="family-name" data-required>
            </div>
            <div class="field-error" id="lastNameError">
              <i class="fa-solid fa-circle-exclamation"></i> Last name is required.
            </div>
          </div>
        </div>

        <!-- Email -->
        <div class="form-group">
          <label for="emailInput">Email Address <span class="req">*</span></label>
          <div class="input-wrap">
            <i class="fa-solid fa-envelope input-icon"></i>
            <input type="email" id="emailInput" name="email"
              placeholder="you@example.com" value="<?= old('email') ?>"
              autocomplete="email" data-required data-email
              class="<?= isset($validation) && $validation->hasError('email') ? 'is-invalid' : '' ?>">
          </div>
          <div class="field-error <?= isset($validation) && $validation->hasError('email') ? 'show' : '' ?>" id="emailError">
            <i class="fa-solid fa-circle-exclamation"></i>
            <?= isset($validation) ? ($validation->getError('email') ?? 'Enter a valid email address.') : 'Enter a valid email address.' ?>
          </div>
        </div>

        <!-- Password -->
        <div class="form-group">
          <label for="passwordInput">Password <span class="req">*</span></label>
          <div class="input-wrap">
            <i class="fa-solid fa-lock input-icon"></i>
            <input type="password" id="passwordInput" name="password"
              placeholder="Create a strong password"
              autocomplete="new-password" data-required
              class="<?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>">
            <button type="button" class="toggle-pass" data-target="passwordInput" aria-label="Show password">
              <i class="fa-solid fa-eye"></i>
            </button>
          </div>
          <div class="pw-strength">
            <div class="pw-bar-track"><div class="pw-bar-fill" id="pwBar"></div></div>
            <span class="pw-hint" id="pwHint">At least 6 characters required</span>
          </div>
          <div class="field-error" id="passwordError">
            <i class="fa-solid fa-circle-exclamation"></i> Password must be at least 6 characters.
          </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
          <label for="confirmInput">Confirm Password <span class="req">*</span></label>
          <div class="input-wrap">
            <i class="fa-solid fa-lock input-icon"></i>
            <input type="password" id="confirmInput" name="confirm_password"
              placeholder="Repeat your password"
              autocomplete="new-password" data-required
              class="<?= isset($validation) && $validation->hasError('confirm_password') ? 'is-invalid' : '' ?>">
            <button type="button" class="toggle-pass" data-target="confirmInput" aria-label="Show password">
              <i class="fa-solid fa-eye"></i>
            </button>
          </div>
          <div class="field-error <?= isset($validation) && $validation->hasError('confirm_password') ? 'show' : '' ?>" id="confirmError">
            <i class="fa-solid fa-circle-exclamation"></i> Passwords do not match.
          </div>
        </div>

        <!-- Terms -->
        <div class="terms-row">
          <input type="checkbox" id="termsCheck" name="terms" value="1">
          <label for="termsCheck">
            By creating an account you agree to the
            <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
          </label>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-submit" id="submitBtn">
          <div class="btn-spinner" id="btnSpinner"></div>
          <span class="btn-label" id="btnLabel">Create Account</span>
        </button>
      </form>

      <div class="card-footer">
        Already have an account? <a href="<?= base_url('login') ?>">Sign in</a>
      </div>

      <p class="privacy-note">
        Your information is used to verify your identity and is never shared with third parties.<br>
        <a href="#">Privacy Policy</a> &nbsp;&middot;&nbsp; <a href="#">Terms of Use</a>
      </p>

    </div><!-- /.form-inner -->
  </div><!-- /.form-panel -->


  <!-- ════════════════════════════════════
       RIGHT 40% — eis.png Image Panel
       ════════════════════════════════════ -->
  <div class="image-panel">
    <div class="panel-grid"></div>

    <div class="panel-content">

      <p class="panel-eyebrow">Employee Information System</p>

      <div class="panel-heading">
        <h2>Manage your team<br><em>with confidence.</em></h2>
        <p>Full CRUD operations, secure authentication,<br>and real-time search — all in one place.</p>
      </div>

      <!-- Screenshot + floating chips -->
      <div class="panel-img-wrap">
        <div class="panel-img-glow"></div>

        <div class="panel-chip panel-chip-tl">
          <span class="chip-dot chip-dot-green"></span>
          8 Employees Active
        </div>

        <img
          src="<?= base_url('images/eis1.png') ?>"
          alt="Employee IS — Record List"
          class="panel-img"
          loading="eager"
          draggable="false"
        >

        <div class="panel-chip panel-chip-br">
          <span class="chip-dot chip-dot-blue"></span>
          Full CRUD &nbsp;·&nbsp; 6 Departments
        </div>
      </div>

      <!-- Feature pills -->
      <div class="panel-pills">
        <span class="panel-pill">✅ Create &amp; Read</span>
        <span class="panel-pill">✏️ Update &amp; Delete</span>
        <span class="panel-pill">🔐 bcrypt Auth</span>
        <span class="panel-pill">⚙️ CodeIgniter 4</span>
        <span class="panel-pill">🛡 CSRF Protected</span>
        <span class="panel-pill">📋 MVC Architecture</span>
      </div>

    </div><!-- /.panel-content -->
  </div><!-- /.image-panel -->

</div><!-- /.split-page -->

<script src="<?= base_url('js/register.js') ?>"></script>
</body>
</html>