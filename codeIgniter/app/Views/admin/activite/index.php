<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

<div class="admin-container">
    <div class="admin-card">
        <div class="admin-header">
            <h1>Gestion des activités</h1>
            <div>
                <a href="/admin/activite/create" class="btn-primary">Créer une activité</a>
                </div>
            </div>

            <?= $this->endSection() ?>
        <?php if (session()->getFlashdata('success')): ?>
                <div class="flash-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('erreur')): ?>
                <div class="flash-error"><?= session()->getFlashdata('erreur') ?></div>
        <?php endif; ?>

        <table class="table-simple">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Poids influence</th>
                    <th>Actions</th>
                </tr>
            </thead>
                    <tbody>
                        <?php if (empty($activites)): ?>
                            <tr>
                                <td colspan="4">Aucune activité trouvée. Ajoutez-en via "Créer une activité".</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($activites as $a): ?>
                                <tr>
                                    <td><?= esc($a['id']) ?></td>
                                    <td><?= esc($a['nom']) ?></td>
                                    <td><?= esc($a['poidsInfluenceActivite']) ?></td>
                                    <td>
                                        <a href="/admin/activite/edit/<?= $a['id'] ?>" class="btn-primary">Éditer</a>
                                        <form method="post" action="/admin/activite/delete/<?= $a['id'] ?>" style="display:inline" onsubmit="return confirm('Supprimer ?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn-danger">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
        </table>
    </div>
</div>
