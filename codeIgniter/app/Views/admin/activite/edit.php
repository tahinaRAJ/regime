<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

<div class="admin-container">
    <div class="admin-card">
        <h1>Éditer une activité</h1>

        <form method="post" action="/admin/activite/update/<?= $activite['id'] ?>">
            <?= csrf_field() ?>
            <div class="form-grid">
                <div class="form-row">
                    <label>Nom</label>
                    <input type="text" name="nom" value="<?= esc($activite['nom']) ?>" required />
                </div>
                <div class="form-row">
                    <label>Poids influence</label>
                    <input type="number" step="0.01" name="poidsInfluenceActivite" value="<?= esc($activite['poidsInfluenceActivite']) ?>" required />
                </div>
                <div class="form-row full">
                    <button type="submit" class="btn-primary">Mettre à jour</button>
                </div>
            </div>
        </form>

        <p><a href="/admin/activite">Retour</a></p>
    </div>
</div>

<?= $this->endSection() ?>
