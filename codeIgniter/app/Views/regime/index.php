<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="login-container">
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
</div>

<script src="<?= base_url('assets/js/regime.js') ?>"></script>
<?= $this->endSection() ?>