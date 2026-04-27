<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign In — Employee IS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap">
  <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <!-- ── Top nav ── -->
  <nav class="apple-nav">
    <a href="<?= base_url() ?>" class="apple-nav-brand">Employee <span>IS</span></a>
    <a href="<?= base_url('register') ?>" class="apple-nav-link">Create Account</a>
  </nav>

  <!-- ── Split layout ── -->
  <div class="split-page">

    <!-- LEFT — Form (60%) -->
    <div class="form-panel">
      <div class="form-inner">

        <div class="card-logo">
          <a href="<?= base_url() ?>">
            <span class="logo-dot"></span>
            Employee <span>IS</span>
          </a>
        </div>

        <div class="card-heading">
          <h1>Sign in.</h1>
          <p>One account is all you need to manage employee records.</p>
        </div>

        <div class="card-divider"></div>

        <?php if (session('success')): ?>
        <div class="alert alert-success show">
          <i class="fa fa-circle-check"></i>
          <?= esc(session('success')) ?>
        </div>
        <?php endif; ?>

        <?php if (session('error')): ?>
        <div class="alert alert-error show">
          <i class="fa fa-circle-exclamation"></i>
          <?= esc(session('error')) ?>
        </div>
        <?php endif; ?>

        <!-- ✅ FIXED: was base_url('auth/login') -->
        <form id="loginForm" action="<?= base_url('login') ?>" method="POST" novalidate>
          <?= csrf_field() ?>

          <div class="form-group">
            <label for="email">Email Address <span class="req">*</span></label>
            <div class="input-wrap">
              <i class="fa fa-envelope input-icon"></i>
              <input type="email" id="email" name="email"
                placeholder="you@example.com"
                value="<?= old('email') ?>"
                autocomplete="email" required>
            </div>
            <div class="field-error" id="emailErr">
              <i class="fa fa-circle-exclamation"></i>
              <span></span>
            </div>
          </div>

          <div class="form-group">
            <label for="password">
              Password <span class="req">*</span>
              <a href="<?= base_url('forgot-password') ?>" class="label-link">Forgot password?</a>
            </label>
            <div class="input-wrap">
              <i class="fa fa-lock input-icon"></i>
              <input type="password" id="password" name="password"
                placeholder="Enter your password"
                autocomplete="current-password" required>
              <button type="button" class="toggle-pass" id="togglePass" aria-label="Show/hide password">
                <i class="fa fa-eye" id="togglePassIcon"></i>
              </button>
            </div>
            <div class="field-error" id="passErr">
              <i class="fa fa-circle-exclamation"></i>
              <span></span>
            </div>
          </div>

          <div class="form-check-row">
            <label class="checkbox-label">
              <input type="checkbox" name="remember" value="1">
              Keep me signed in
            </label>
          </div>

          <button type="submit" class="btn-submit" id="submitBtn">
            <span class="btn-label" id="submitText">Sign In</span>
          </button>

        </form>

        <div class="card-footer">
          Don't have an account? <a href="<?= base_url('register') ?>">Sign up</a>
        </div>

        <p class="privacy-note">
          Your information is used to verify your identity and is never shared with third parties.<br>
          <a href="#">Privacy Policy</a> &nbsp;&middot;&nbsp; <a href="#">Terms of Use</a>
        </p>

      </div>
    </div>

    <!-- RIGHT — Image panel (40%) -->
    <div class="image-panel">
      <div class="panel-grid"></div>
      <div class="panel-content">

        <p class="panel-eyebrow">Employee Information System</p>

        <div class="panel-heading">
          <h2>Manage your team<br><em>with confidence.</em></h2>
          <p>Full CRUD operations, secure authentication,<br>and real-time search — all in one place.</p>
        </div>

        <div class="panel-img-wrap">
          <div class="panel-img-glow"></div>
          <div class="panel-chip panel-chip-tl">
            <span class="chip-dot chip-dot-green"></span>
            8 Employees Active
          </div>
          <img
            src="<?= base_url('images/eis.png') ?>"
            alt="Employee Information System"
            class="panel-img">
          <div class="panel-chip panel-chip-br">
            <span class="chip-dot chip-dot-blue"></span>
            Full CRUD &middot; 6 Departments
          </div>
        </div>

        <div class="panel-pills">
          <span class="panel-pill">🔐 Secure Auth</span>
          <span class="panel-pill">🔍 Real-time Search</span>
          <span class="panel-pill">⚙️ CodeIgniter 4</span>
          <span class="panel-pill">💰 Salary Tracking</span>
        </div>

      </div>
    </div>

  </div><!-- /split-page -->

  <script src="<?= base_url('js/login.js') ?>"></script>
</body>
</html>