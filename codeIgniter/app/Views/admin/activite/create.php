<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

<div class="admin-container">
    <div class="admin-card">
        <h1>Créer une activité</h1>

        <form method="post" action="/admin/activite/store">
            <?= csrf_field() ?>
            <div class="form-grid">
                <div class="form-row">
                    <label>Nom</label>
                    <input type="text" name="nom" value="<?= set_value('nom') ?>" required />
                </div>

                <div class="form-row">
                    <label>Poids influence</label>
                    <input type="number" step="0.01" name="poidsInfluenceActivite" value="<?= set_value('poidsInfluenceActivite') ?>" required />
                </div>

                <div class="form-row full">
                    <button type="submit" class="btn-primary">Créer</button>
                </div>
            </div>
        </form>

        <p><a href="/admin/activite">Retour</a></p>
    </div>
</div>

<?= $this->endSection() ?>
