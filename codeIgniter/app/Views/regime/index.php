<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Le Titre du site — Régimes</title>
<link rel="stylesheet" href="<?= base_url('assets/css/regime-page.css') ?>">
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
      <div class="logout"><a href="<?= site_url('/logout') ?>">Déconnexion</a></div>
    </div>
  </div>
</header>
<main class="login-container" style="margin-top:80px;">
  <div class="wellness-card">
    <div class="mindful-header">
      <div class="zen-logo" aria-hidden>
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="12" cy="12" r="10" stroke="#4caf50" stroke-width="1.5" fill="none" />
          <path d="M8 14c1-2 4-3 6-1" stroke="#4caf50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <h1>Choisissez un objectif</h1>
      <p>Sélectionnez un objectif pour voir des régimes et activités adaptés</p>
    </div>
    <div class="organic-field" style="margin-bottom:8px;">
      <div class="field-nature"></div>
      <div id="choices"></div>
    </div>
    <div class="content-row" style="margin-top:18px;">
      <div class="regimes-panel">
        <div id="regimesArea">
          <div class="placeholder"></div>
        </div>
      </div>
      <aside class="forecast-panel">
        <h3>Prévision</h3>
        <div style="margin-top:8px;">
          <p>Poids estimé: <strong id="forecastWeight">-</strong> kg</p>
          <p>Durée estimée: <strong id="forecastDuration">-</strong> jours</p>
          <p>Coût estimé: <strong id="forecastCost">-</strong></p>
        </div>
      </aside>
    </div>
  </div>
</main>

<script src="<?= base_url('assets/js/regime.js') ?>"></script>
</body>
</html>