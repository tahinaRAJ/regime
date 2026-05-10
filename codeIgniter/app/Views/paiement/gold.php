<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

<div class="admin-container">
    <div class="admin-card" style="max-width:760px;margin:0 auto;">
        <h1>Option Gold</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="flash-success"><?= esc((string) session()->getFlashdata('success')) ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('erreur')): ?>
            <div class="flash-error"><?= esc((string) session()->getFlashdata('erreur')) ?></div>
        <?php endif; ?>

        <div class="regime-card" style="margin-top:18px;">
            <h3>Activation Gold</h3>
            <p>Une seule acquisition. Elle active la remise de 15% sur tous les régimes.</p>
            <p><strong>Prix de l’option :</strong> <?= esc((string) $goldPrice) ?></p>
            <p><strong>Votre solde actuel :</strong> <?= esc((string) $solde) ?></p>
            <p><strong>Statut :</strong> <?= $isGold ? 'Déjà activée' : 'Non activée' ?></p>

            <?php if (!$isGold): ?>
                <form method="post" action="<?= site_url('/paiement/gold') ?>">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn-primary">Acheter l’option Gold</button>
                </form>
            <?php else: ?>
                <div class="flash-success" style="margin-top:16px;">L’option Gold est déjà active sur votre compte.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>