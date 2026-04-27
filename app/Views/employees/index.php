<?php
/**
 * views/employees/index.php
 * Employee List Page — Apple.com aesthetic
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=SF+Pro+Display:wght@300;400;500;600&family=Instrument+Sans:wght@400;500;600&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('css/employees.css') ?>">
</head>
<body>

<!-- ── Nav ────────────────────────────────────────────────── -->
<nav class="eis-nav">
  <div class="nav-inner">
    <a href="<?= base_url('employees') ?>" class="nav-brand">
      Employee<span>IS</span>
    </a>
    <div class="nav-links">
      <a href="<?= base_url('employees') ?>" class="nav-link active">Records</a>
      <a href="<?= base_url('employees/create') ?>" class="nav-link">Add Employee</a>
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

<!-- ── Page Shell ─────────────────────────────────────────── -->
<div class="page-shell">

  <!-- Looping background video — place your file at public/videos/hero.mp4 -->
  <video
    class="page-bg-video"
    src="<?= base_url('videos/hero.mp4') ?>"
    autoplay
    loop
    muted
    playsinline
    aria-hidden="true"
  ></video>
  <div class="page-bg-overlay" aria-hidden="true"></div>

  <!-- ── Hero Strip ───────────────────────────────────────── -->
  <section class="hero-strip">
    <div class="hero-inner">
      <div class="hero-text">
        <p class="hero-eyebrow">PC21 · Terminal Assessment 1</p>
        <h1 class="hero-title">Employee <em>Records.</em></h1>
        <p class="hero-sub">Full CRUD · Secure auth · Real-time search</p>
      </div>
      <a href="<?= base_url('employees/create') ?>" class="btn-add">
        <i class="fa-solid fa-plus"></i> Add Employee
      </a>
    </div>
  </section>

  <!-- ── Main ─────────────────────────────────────────────── -->
  <main class="eis-main">

    <!-- Flash -->
    <?php if (session()->getFlashdata('success')): ?>
    <div class="flash flash-success" role="alert">
      <i class="fa-solid fa-circle-check"></i>
      <?= session()->getFlashdata('success') ?>
      <button class="flash-close" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
    <div class="flash flash-error" role="alert">
      <i class="fa-solid fa-circle-exclamation"></i>
      <?= session()->getFlashdata('error') ?>
      <button class="flash-close" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <?php endif; ?>

    <!-- Toolbar: search + count -->
    <div class="toolbar">
      <form action="<?= base_url('employees') ?>" method="GET" class="search-form">
        <div class="search-wrap">
          <i class="fa-solid fa-magnifying-glass search-icon"></i>
          <input
            type="text" name="search" id="tableSearch"
            class="search-input"
            placeholder="Search name, position, department…"
            value="<?= esc($keyword ?? '') ?>"
            autocomplete="off"
          >
          <?php if (!empty($keyword)): ?>
          <a href="<?= base_url('employees') ?>" class="search-clear" title="Clear">
            <i class="fa-solid fa-xmark"></i>
          </a>
          <?php endif; ?>
        </div>
      </form>
      <div class="toolbar-right">
        <span class="record-pill">
          <?= count($employees) ?> record<?= count($employees) !== 1 ? 's' : '' ?>
        </span>
      </div>
    </div>

    <!-- Table card -->
    <div class="table-card">
      <?php if (empty($employees)): ?>
        <!-- Empty state -->
        <div class="empty-state">
          <div class="empty-icon"><i class="fa-solid fa-users-slash"></i></div>
          <h3>No employees found</h3>
          <p>
            <?php if (!empty($keyword)): ?>
              No results for "<strong><?= esc($keyword) ?></strong>". Try a different search.
            <?php else: ?>
              No records yet.
            <?php endif; ?>
          </p>
          <a href="<?= base_url('employees/create') ?>" class="btn-add-sm">+ Add First Employee</a>
        </div>

      <?php else: ?>
        <table class="eis-table" aria-label="Employee Records">
          <thead>
            <tr>
              <th class="col-num">#</th>
              <th class="col-name">Name</th>
              <th class="col-pos">Position</th>
              <th class="col-dept">Department</th>
              <th class="col-sal">Salary</th>
              <th class="col-date">Added</th>
              <th class="col-act">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($employees as $i => $emp): ?>
            <tr class="data-row" style="--row-delay:<?= $i * 40 ?>ms">
              <td class="col-num muted"><?= $i + 1 ?></td>

              <td class="col-name">
                <div class="emp-cell">
                  <div class="avatar" data-initial="<?= mb_strtoupper(mb_substr($emp['name'], 0, 2)) ?>" aria-hidden="true">
                    <?= mb_strtoupper(mb_substr($emp['name'], 0, 2)) ?>
                  </div>
                  <div class="emp-info">
                    <span class="emp-name"><?= esc($emp['name']) ?></span>
                    <span class="emp-id">ID <?= $emp['id'] ?></span>
                  </div>
                </div>
              </td>

              <td class="col-pos">
                <span class="pos-text"><?= esc($emp['position']) ?></span>
              </td>

              <td class="col-dept">
                <span class="dept-badge dept-<?= strtolower(preg_replace('/\s+/', '-', $emp['department'])) ?>">
                  <?= esc($emp['department']) ?>
                </span>
              </td>

              <td class="col-sal">
                <span class="salary-val">
                  &#8369;<?= number_format((float)$emp['salary'], 2) ?>
                </span>
              </td>

              <td class="col-date muted">
                <?= date('M d, Y', strtotime($emp['created_at'])) ?>
              </td>

              <td class="col-act">
                <div class="action-group">
                  <a href="<?= base_url('employees/view/' . $emp['id']) ?>"
                     class="act-btn act-view" title="View">
                    <i class="fa-solid fa-eye"></i>
                  </a>
                  <a href="<?= base_url('employees/edit/' . $emp['id']) ?>"
                     class="act-btn act-edit" title="Edit">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                  <button
                    class="act-btn act-delete"
                    data-delete-url="<?= base_url('employees/delete/' . $emp['id']) ?>"
                    data-name="<?= esc($emp['name']) ?>"
                    title="Delete">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div><!-- /table-card -->

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

<!-- ── Delete Modal ─────────────────────────────────────── -->
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