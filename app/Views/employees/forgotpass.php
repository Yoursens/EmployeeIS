<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Password — Employee IS</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;1,300&display=swap">
  <link rel="stylesheet" href="<?= base_url('css/forgot.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <!-- ── Top nav ── -->
  <nav class="apple-nav">
    <a href="<?= base_url() ?>" class="apple-nav-brand">Employee <span>IS</span></a>
    <a href="<?= base_url('login') ?>" class="apple-nav-link">Sign In</a>
  </nav>

  <!-- ── Split layout ── -->
  <div class="split-page">

    <!-- ════════════════════════════
         LEFT — Form (60%)
         ════════════════════════════ -->
    <div class="form-panel">
      <div class="form-inner">

        <!-- Logo -->
        <div class="card-logo">
          <a href="<?= base_url() ?>">
            <span class="logo-dot"></span>
            Employee <span>IS</span>
          </a>
        </div>

        <!-- ── FORM STATE ── -->
        <div id="formState">

          <!-- Key icon -->
          <div class="key-icon-wrap">
            <div class="key-icon">🔑</div>
          </div>

          <!-- Heading -->
          <div class="card-heading">
            <h1>Forgot password?</h1>
            <p>No worries. Enter your email address and we'll send you a link to reset your password.</p>
          </div>

          <div class="card-divider"></div>

          <!-- Flash error -->
          <?php if (session('error')): ?>
          <div class="alert alert-error show">
            <i class="fa fa-circle-exclamation"></i>
            <?= esc(session('error')) ?>
          </div>
          <?php endif; ?>

          <!-- Server-side success — show success state immediately -->
          <?php if (session('success')): ?>
          <script>document.addEventListener('DOMContentLoaded',function(){ showSuccess('<?= esc(session('_email') ?? '') ?>'); });</script>
          <?php endif; ?>

          <!-- Form -->
          <form id="forgotForm" action="<?= base_url('auth/forgot-password') ?>" method="POST" novalidate>
            <?= csrf_field() ?>

            <div class="form-group">
              <label for="email">
                Email Address <span class="req">*</span>
              </label>
              <div class="input-wrap">
                <i class="fa fa-envelope input-icon"></i>
                <input
                  type="email" id="email" name="email"
                  placeholder="you@example.com"
                  value="<?= old('email') ?>"
                  autocomplete="email" required>
              </div>
              <div class="field-error" id="emailErr">
                <i class="fa fa-circle-exclamation"></i>
                <span></span>
              </div>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">
              <span class="btn-label" id="submitText">Send Reset Link</span>
            </button>

          </form>

        </div><!-- /#formState -->

        <!-- ── SUCCESS STATE ── -->
        <div class="success-state <?= session('success') ? 'show' : '' ?>" id="successState">
          <div class="success-circle">✉️</div>
          <h2>Check your inbox!</h2>
          <p>We sent a password reset link to:</p>
          <span class="email-highlight" id="successEmail">
            <?= old('email') ? esc(old('email')) : 'your email address' ?>
          </span>
          <p>The link expires in <strong>30 minutes</strong>. If you don't see it, check your spam folder.</p>
          <p class="countdown-text" id="countdownText"></p>
        </div>

        <!-- Footer -->
        <div class="card-footer">
          <i class="fa fa-arrow-left" style="font-size:.75rem;"></i>
          <a href="<?= base_url('login') ?>">Back to Sign In</a>
        </div>

        <p class="privacy-note">
          For security, reset links expire after 30 minutes and can only be used once.<br>
          <a href="#">Privacy Policy</a> &nbsp;&middot;&nbsp; <a href="#">Terms of Use</a>
        </p>

      </div>
    </div>

    <!-- ════════════════════════════
         RIGHT — Image panel (40%)
         Identical HTML to register & login
         ════════════════════════════ -->
    <div class="image-panel">

      <div class="panel-grid"></div>

      <div class="panel-content">

        <p class="panel-eyebrow">Employee Information System</p>

        <div class="panel-heading">
          <h2>Your data is<br><em>always secure.</em></h2>
          <p>bcrypt password hashing, CSRF-protected forms,<br>and single-use reset tokens — built in.</p>
        </div>

        <!-- Screenshot image — width:100% height:auto matching register & login -->
        <div class="panel-img-wrap">
          <div class="panel-img-glow"></div>

          <!-- Floating chip — top left -->
          <div class="panel-chip panel-chip-tl">
            <span class="chip-dot chip-dot-green"></span>
            Secure Reset Flow
          </div>

          <img
            src="<?= base_url('images/eis2.png') ?>"
            alt="Employee Information System Security"
            class="panel-img"
            onerror="this.onerror=null; this.src='<?= base_url('images/login-panel.jpg') ?>';">

          <!-- Floating chip — bottom right -->
          <div class="panel-chip panel-chip-br">
            <span class="chip-dot chip-dot-blue"></span>
            Expires in 30 min
          </div>
        </div>

        <!-- Feature pills -->
        <div class="panel-pills">
          <span class="panel-pill">🔐 bcrypt Hashing</span>
          <span class="panel-pill">🛡️ CSRF Protected</span>
          <span class="panel-pill">⏱️ 30 min Expiry</span>
          <span class="panel-pill">✅ Single-use Token</span>
        </div>

      </div>
    </div>

  </div><!-- /split-page -->

  <script src="<?= base_url('js/forgotpass.js') ?>"></script>
</body>
</html>