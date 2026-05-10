<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

<div class="admin-container">
    <div class="admin-card">
        <h1>Créer un régime</h1>

        <form method="post" action="/admin/regime/store">
            <?= csrf_field() ?>
            <div class="form-grid">
                <div class="form-row">
                    <label>Nom</label>
                    <input type="text" name="nom" value="<?= set_value('nom') ?>" required />
                </div>

                <div class="form-row full">
                    <label>Description</label>
                    <textarea name="description"><?= set_value('description') ?></textarea>
                </div>

                <div class="form-row">
                    <label>Prix journalier</label>
                    <input type="number" step="0.01" name="prixJournalier" value="<?= set_value('prixJournalier') ?>" required />
                </div>

                <div class="form-row">
                    <label>Poids influence food (kg par cycle, ex: -1.5)</label>
                    <input type="number" step="0.01" name="poidsInfluencefood" value="<?= set_value('poidsInfluencefood') ?>" required />
                </div>

                <div class="form-row">
                    <label>Durée influence food (jours)</label>
                    <input type="number" name="dureeInfluencefood" value="<?= set_value('dureeInfluencefood') ?>" required />
                </div>

                <div class="form-row">
                    <label>% Viande</label>
                    <input type="number" step="0.01" name="pourcentageViande" value="<?= set_value('pourcentageViande') ?>" />
                </div>

                <div class="form-row">
                    <label>% Poisson</label>
                    <input type="number" step="0.01" name="pourcentagePoisson" value="<?= set_value('pourcentagePoisson') ?>" />
                </div>

                <div class="form-row">
                    <label>% Volaille</label>
                    <input type="number" step="0.01" name="pourcentageVolaille" value="<?= set_value('pourcentageVolaille') ?>" />
                </div>

                <div class="form-row full">
                    <button type="submit" class="btn-primary">Créer</button>
                </div>
            </div>
        </form>

        <p><a href="/admin/regime">Retour</a></p>
    </div>
</div>

<?= $this->endSection() ?>
