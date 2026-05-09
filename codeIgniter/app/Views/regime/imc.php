<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div style="max-width:1100px;margin-left:auto;margin-right:auto;padding:16px;">
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
</div>

<script src="<?= base_url('assets/js/regime-imc.js') ?>"></script>
<?= $this->endSection() ?>
