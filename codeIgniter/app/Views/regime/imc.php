<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/regime-page.css') ?>">
<style>
/* Modern styling consistent with the dashboard */
.dashboard-container {
  max-width: 1200px;
  width: 100%;
  margin: 100px auto 40px auto;
  padding: 0 20px;
}

.imc-grid {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 24px;
  align-items: start;
}

@media (max-width: 800px) {
  .imc-grid {
    grid-template-columns: 1fr;
  }
}

/* Form Panel */
.imc-form-panel {
  background: rgba(255,255,255,0.95);
  backdrop-filter: blur(10px);
  padding: 32px;
  border-radius: 16px;
  box-shadow: 0 8px 32px rgba(0,0,0,0.05);
  border: 1px solid rgba(76, 175, 80, 0.1);
}

.imc-form-panel h2 {
  color: #1b5e20;
  margin-bottom: 24px;
  font-size: 24px;
  text-shadow: 0 1px 2px rgba(255,255,255,0.8);
}

.modern-form {
  display: flex;
  gap: 16px;
  align-items: flex-end;
  flex-wrap: wrap;
}

.input-group {
  flex: 1;
  min-width: 200px;
}

.input-group label {
  display: block;
  font-size: 14px;
  font-weight: 600;
  color: #2e7d32;
  margin-bottom: 8px;
}

.input-group input {
  width: 100%;
  padding: 12px 16px;
  font-size: 16px;
  border: 1px solid rgba(46, 125, 50, 0.2);
  border-radius: 10px;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
  background: white;
}

.input-group input:focus {
  border-color: #4caf50;
  box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.15);
}

.btn-modern {
  background: linear-gradient(135deg, #4caf50, #2e7d32);
  color: white;
  border: none;
  padding: 12px 28px;
  font-size: 16px;
  font-weight: 600;
  border-radius: 10px;
  cursor: pointer;
  height: 45px;
  transition: transform 0.2s, box-shadow 0.2s;
  white-space: nowrap;
}

.btn-modern:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(46, 125, 50, 0.3);
}

/* Glassmorphic IMC Widget */
.imc-widget {
  background: rgba(255,255,255,0.7) !important;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.4) !important;
  border-radius: 16px !important;
  padding: 32px 24px !important;
  box-shadow: 0 8px 32px rgba(0,0,0,0.05) !important;
  text-align: center;
}

.imc-widget h3 {
  font-size: 14px !important;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #2e7d32 !important;
  margin-bottom: 8px !important;
  border-bottom: 1px solid rgba(46, 125, 50, 0.2);
  padding-bottom: 12px;
  display: block;
}

.imc-value {
  font-size: 56px;
  font-weight: 800;
  color: #1b5e20;
  margin: 24px 0;
  text-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.imc-widget p {
  color: #555;
  font-size: 14px;
  line-height: 1.6;
}

/* Recommendation Grid */
#recommendationsPanel {
  margin-top: 24px;
}

.regime-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 16px;
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
  height: 100%;
}

.regime-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 15px rgba(0,0,0,0.1);
  border-color: #4caf50;
}

.placeholder {
  background: rgba(255,255,255,0.5);
  border-radius: 12px;
  padding: 40px;
  text-align: center;
  color: #555;
  font-style: italic;
  border: 1px dashed rgba(46, 125, 50, 0.3);
}

.imc-status.error {
  color: #e53935;
  margin-top: 10px;
  font-size: 14px;
}
</style>

<div class="dashboard-container">
  <div class="imc-grid">
    <!-- Main Content (Form + Results) -->
    <div>
      <div class="imc-form-panel">
        <h2>Atteindre un IMC idéal</h2>
        <form id="imcTopForm" class="modern-form">
          <div class="input-group">
            <label for="imc_ideal_top">Votre IMC cible</label>
            <input id="imc_ideal_top" name="imc_ideal" type="number" step="0.1" placeholder="Ex: 22.5" required />
          </div>
          <button id="seeRecBtn" type="submit" class="btn-modern">Voir les régimes</button>
        </form>
      </div>

      <div id="recommendationsPanel">
        <!-- Results injected here by JS -->
      </div>
    </div>

    <!-- Sidebar Widget -->
    <aside>
      <div class="imc-widget">
        <h3>Votre IMC actuel</h3>
        <div id="imcActuelBox" class="imc-value"><?= esc($imc_actuel ?? '-') ?></div>
        <p>Utilisez le formulaire pour définir votre nouvel objectif et recevoir des programmes ciblés.</p>
      </div>
    </aside>
  </div>
</div>

<script src="<?= base_url('assets/js/regime-imc.js') ?>"></script>
<?= $this->endSection() ?>
