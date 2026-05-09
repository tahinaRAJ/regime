<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>IMC — Recommandations</title>
<link rel="stylesheet" href="<?= base_url('assets/css/regime-page.css') ?>">
</head>
<body>
<header style="position:fixed;top:0;left:0;right:0;z-index:50;">
  <div style="background:#0b0b0b;color:#fff;padding:12px 0;">
    <div style="max-width:1100px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;padding:0 16px;">
      <div class="site-title">Le Titre du site</div>
      <div class="logout"><a href="<?= site_url('/logout') ?>">Déconnexion</a></div>
    </div>
  </div>
</header>
<main style="margin-top:80px;max-width:1100px;margin-left:auto;margin-right:auto;padding:16px;">
  <div style="display:flex;gap:18px;align-items:flex-start;">
    <div style="flex:1;">
      <div style="background:#fff;padding:18px;border-radius:8px;box-shadow:0 6px 18px rgba(8,10,15,.06);">
        <h2>IMC cible</h2>
        <form id="imcTopForm">
          <label for="imc_ideal_top">IMC souhaité</label>
          <input id="imc_ideal_top" name="imc_ideal" type="number" step="0.1" required />
          <button id="seeRecBtn" type="submit">Voir recommandations</button>
        </form>
      </div>

      <div id="recommendationsPanel" style="margin-top:18px;">
      </div>
    </div>

    <aside style="width:280px;">
      <div style="background:#fff;padding:18px;border-radius:8px;box-shadow:0 6px 18px rgba(8,10,15,.06);">
        <h3>IMC actuel</h3>
        <div id="imcActuelBox" style="font-size:28px;font-weight:700;margin-top:12px;"><?= esc($imc_actuel ?? '-') ?></div>
        <p style="margin-top:8px;color:#6b7280;">Utilisez le formulaire pour voir des régimes adaptés.</p>
      </div>
    </aside>
  </div>
</main>

<script src="<?= base_url('assets/js/regime-imc.js') ?>"></script>
</body>
</html>
