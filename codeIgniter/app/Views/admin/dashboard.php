<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

<div class="admin-container">
    <div class="admin-card">
        <div class="admin-header">
            <h1>Administration</h1>
            <div class="admin-links">
                <a href="/admin/activite" class="btn-primary">Activités</a>
                <a href="/admin/regime" class="btn-primary">Régimes</a>
            </div>
        </div>

        <p>Bienvenue dans l'espace administration. Choisissez une section ci-dessus.</p>
    </div>
</div>
<?= $this->endSection() ?>
