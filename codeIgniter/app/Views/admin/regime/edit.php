<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

<div class="admin-container">
    <div class="admin-card">
        <h1>Éditer un régime</h1>

        <form method="post" action="/admin/regime/update/<?= $regime['id'] ?>">
            <?= csrf_field() ?>
            <div class="form-grid">
                <div class="form-row">
                    <label>Nom</label>
                    <input type="text" name="nom" value="<?= esc($regime['nom']) ?>" required />
                </div>

                <div class="form-row full">
                    <label>Description</label>
                    <textarea name="description"><?= esc($regime['description']) ?></textarea>
                </div>

                <div class="form-row">
                    <label>Prix journalier</label>
                    <input type="number" step="0.01" name="prixJournalier" value="<?= esc($regime['prixJournalier']) ?>" required />
                </div>

                <div class="form-row">
                    <label>Poids influence food (kg par cycle)</label>
                    <input type="number" step="0.01" name="poidsInfluencefood" value="<?= esc($regime['poidsInfluencefood']) ?>" required />
                </div>

                <div class="form-row">
                    <label>Durée influence food (jours)</label>
                    <input type="number" name="dureeInfluencefood" value="<?= esc($regime['dureeInfluencefood']) ?>" required />
                </div>

                <div class="form-row">
                    <label>% Viande</label>
                    <input type="number" step="0.01" name="pourcentageViande" value="<?= esc($regime['pourcentageViande']) ?>" />
                </div>

                <div class="form-row">
                    <label>% Poisson</label>
                    <input type="number" step="0.01" name="pourcentagePoisson" value="<?= esc($regime['pourcentagePoisson']) ?>" />
                </div>

                <div class="form-row">
                    <label>% Volaille</label>
                    <input type="number" step="0.01" name="pourcentageVolaille" value="<?= esc($regime['pourcentageVolaille']) ?>" />
                </div>

                <div class="form-row full">
                    <button type="submit" class="btn-primary">Mettre à jour</button>
                </div>
            </div>
        </form>

        <p><a href="/admin/regime">Retour</a></p>
    </div>
</div>

<?= $this->endSection() ?>
