<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

<div class="admin-container">
    <div class="admin-card">
        <div class="admin-header">
            <h1>Gestion des régimes</h1>
            <div>
                <a href="/admin/regime/create" class="btn-primary">Créer un régime</a>
            </div>
        </div>

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
                    <th>Prix/jour</th>
                    <th>Poids influence food</th>
                    <th>Durée food</th>
                    <th>Actions</th>
                </tr>
            </thead>
                    <tbody>
                        <?php if (empty($regimes)): ?>
                            <tr>
                                <td colspan="6">Aucun régime trouvé. Ajoutez-en via "Créer un régime".</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($regimes as $r): ?>
                                <tr>
                                    <td><?= esc((string)$r['id']) ?></td>
                                    <td><?= esc((string)$r['nom']) ?></td>
                                    <td><?= esc((string)$r['prixJournalier']) ?></td>
                                    <td><?= esc((string)$r['poidsInfluencefood']) ?></td>
                                    <td><?= esc((string)$r['dureeInfluencefood']) ?></td>
                                    <td>
                                        <a href="/admin/regime/edit/<?= $r['id'] ?>" class="btn-primary">Éditer</a>
                                        <form method="post" action="/admin/regime/delete/<?= $r['id'] ?>" style="display:inline" onsubmit="return confirm('Supprimer ?')">
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

<?= $this->endSection() ?>
