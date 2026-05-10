<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

<div class="admin-container">
    <div class="admin-card" style="max-width:820px;margin:0 auto;">
        <h1>Détail du régime</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="flash-success"><?= esc((string) session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('erreur')): ?>
            <div class="flash-error"><?= esc((string) session()->getFlashdata('erreur')) ?></div>
        <?php endif; ?>

        <div class="regime-card" style="margin-top:18px;">
            <h3><?= esc((string) $regime['nom']) ?></h3>
            <p><?= esc((string) ($regime['description'] ?? '')) ?></p>
            <p><strong>Prix de base :</strong> <?= esc((string) $prixBase) ?></p>
            <p><strong>Prix à payer :</strong> <?= esc((string) $prixFinal) ?></p>
            <p><strong>Votre solde :</strong> <?= esc((string) $solde) ?></p>
            <p><strong>Remise Gold :</strong> <?= $isGold ? '15%' : 'Aucune' ?></p>
            <p><strong>Durée :</strong> <?= esc((string) ($regime['dureeInfluencefood'] ?? '-')) ?> jours</p>
            <p><strong>Variation alimentaire :</strong> <?= esc((string) ($regime['poidsInfluencefood'] ?? '-')) ?></p>
            <p><strong>Activité associée :</strong> <?= esc((string) ($regime['idActivite'] ?? '-')) ?></p>

            <form method="post" action="<?= site_url('/paiement/regime/' . $regime['id']) . ($objectifId ? '?objectif=' . $objectifId : '') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="objectif_id" value="<?= esc((string) $objectifId) ?>">
                <button type="submit" class="btn-primary">Acheter ce régime</button>
            </form>
            <?php if (!empty($bought)): ?>
                <div style="margin-top:12px;">
                    <a href="<?= site_url('/paiement/export/' . $regime['id']) ?>" class="btn-primary" style="background:#333;color:#fff">Exporter en PDF</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>