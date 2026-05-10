<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/regime-page.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

<style>
/* Adjustments requested by user */
.dashboard-container {
  max-width: 1200px;
  width: 100%;
  margin: 100px auto 40px auto; /* Margin top to account for fixed header */
  padding: 0 20px;
}
.header-with-options {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  flex-wrap: wrap;
  gap: 20px;
  margin-bottom: 24px;
}
.mindful-header {
  flex: 1;
}
/* Title legibility over gradient background */
.mindful-header h1 {
  color: #1b5e20 !important; /* Darker green */
  text-shadow: 0 1px 2px rgba(255,255,255,0.8);
}
.mindful-header p {
  color: #2e7d32 !important; /* Dark solid green instead of light green */
}
#choices {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
  justify-content: flex-end;
}
/* Hide the white background initially to avoid empty white block */
.regimes-panel.empty {
  background: transparent !important;
  box-shadow: none !important;
  border: none !important;
}
/* Improve forecast panel */
.forecast-panel {
  background: rgba(255,255,255,0.7) !important;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.4) !important;
  border-radius: 16px !important;
  padding: 24px !important;
  box-shadow: 0 8px 32px rgba(0,0,0,0.05) !important;
}
.forecast-panel h3 {
  font-size: 14px !important;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #2e7d32 !important;
  margin-bottom: 16px !important;
  border-bottom: 1px solid rgba(46, 125, 50, 0.2);
  padding-bottom: 8px;
}
.forecast-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 0;
  border-bottom: 1px dashed rgba(0,0,0,0.05);
}
.forecast-item:last-child {
  border-bottom: none;
}
.forecast-label {
  color: #555;
  font-size: 14px;
}
.forecast-value {
  font-size: 18px;
  font-weight: 600;
  color: #1b5e20;
}

#regimesArea {
  display: grid !important;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
  gap: 16px !important;
  width: 100%;
}
.regime-card {
  background: white;
  border: 1px solid #eee;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.05);
  transition: transform 0.2s, box-shadow 0.2s;
  display: flex !important;
  flex-direction: column;
  margin-top: 0 !important; /* Override the margin-top added for non-grid layout */
  height: 100%; /* Force equal heights */
}
.regime-card > .see-more {
  margin-top: auto; /* Push the button to the bottom */
}
.regime-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 15px rgba(0,0,0,0.1);
  border-color: #4caf50;
}
</style>

<div class="dashboard-container">
  <div class="header-with-options">
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
      <div class="organic-field">
        <div class="field-nature"></div>
        <div id="choices"></div>
      </div>
    </div>
    <div class="content-row" style="margin-top:18px;">
      <div class="regimes-panel empty" id="regimesPanelTarget">
        <div id="regimesArea">
          <div class="placeholder">Sélectionnez d'abord un objectif pour afficher les régimes.</div>
        </div>
      </div>
      <aside class="forecast-panel">
        <h3>Prévision</h3>
        <div style="margin-top:8px;">
          <div class="forecast-item">
            <span class="forecast-label">Poids estimé</span>
            <span><strong class="forecast-value" id="forecastWeight">-</strong> kg</span>
          </div>
          <div class="forecast-item">
            <span class="forecast-label">Durée estimée</span>
            <span><strong class="forecast-value" id="forecastDuration">-</strong> jours</span>
          </div>
          <div class="forecast-item">
            <span class="forecast-label">Coût estimé</span>
            <strong class="forecast-value" id="forecastCost">-</strong>
          </div>
        </div>
      </aside>
    </div>
</div>

<script src="<?= base_url('assets/js/regime.js') ?>"></script>
<script>
  // Script to remove 'empty' class when a choice is made
  document.addEventListener('DOMContentLoaded', () => {
    const choicesContainer = document.getElementById('choices');
    const panel = document.getElementById('regimesPanelTarget');
    
    // Using event delegation on choices container
    choicesContainer.addEventListener('click', (e) => {
        if(e.target.tagName.toLowerCase() === 'button' || e.target.closest('.choice-btn')) {
            panel.classList.remove('empty');
        }
    });
  });
</script>
<?= $this->endSection() ?>