<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= isset($title) ? esc($title) : 'Le Titre du site' ?></title>
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body>
<div class="nature-background" aria-hidden="true">
  <div class="floating-leaf leaf-1"></div>
  <div class="floating-leaf leaf-2"></div>
  <div class="floating-leaf leaf-3"></div>
  <div class="floating-leaf leaf-4"></div>
</div>
<header style="position:fixed;top:0;left:0;right:0;z-index:50;">
  <div style="background:#0b0b0b;color:#fff;padding:12px 0;">
    <div style="max-width:1100px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;padding:0 16px;">
      <div class="site-title">Le Titre du site</div>
      <div class="nav-links">
        <?php if (session()->get('user')): ?>
          <a href="<?= site_url('/logout') ?>" style="color:#fff;text-decoration:none">Déconnexion</a>
          <?php if (session()->get('user')['role'] === 'admin'): ?>
            &nbsp; | &nbsp; <a href="<?= site_url('/admin') ?>" style="color:#fff;text-decoration:none">Administration</a>
          <?php endif; ?>
        <?php else: ?>
          <a href="<?= site_url('/login') ?>" style="color:#fff;text-decoration:none">Se connecter</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</header>

<main style="margin-top:80px;">
  <?= $this->renderSection('content') ?>
</main>

</body>
</html>
