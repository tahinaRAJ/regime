<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

<style>
:root {
    --dash-bg: #f4f7f2;
    --dash-card: #ffffff;
    --dash-text: #17311f;
    --dash-muted: #61705f;
    --dash-primary: #2f6d45;
    --dash-accent: #d39d3e;
    --dash-success: #2e7d32;
    --dash-border: rgba(31, 61, 40, 0.08);
}

.dashboard-shell {
    display: grid;
    grid-template-columns: 260px 1fr;
    gap: 24px;
    max-width: 1440px;
    margin: 0 auto;
    padding: 24px;
}

.dashboard-sidebar,
.dashboard-panel,
.dash-card {
    background: var(--dash-card);
    border: 1px solid var(--dash-border);
    border-radius: 20px;
    box-shadow: 0 12px 30px rgba(17, 41, 24, 0.06);
}

.dashboard-sidebar {
    padding: 22px;
    position: sticky;
    top: 100px;
    align-self: start;
}

.brand-block {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 24px;
}

.brand-mark {
    width: 46px;
    height: 46px;
    border-radius: 16px;
    background: linear-gradient(135deg, #3d8b54, #214d2d);
    display: grid;
    place-items: center;
    color: #fff;
    flex: 0 0 auto;
}

.brand-title {
    font-size: 20px;
    font-weight: 800;
    color: var(--dash-text);
}

.brand-subtitle {
    color: var(--dash-muted);
    font-size: 13px;
}

.side-section {
    margin: 18px 0 10px;
    color: var(--dash-muted);
    text-transform: uppercase;
    font-size: 11px;
    letter-spacing: .14em;
}

.side-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 14px;
    border-radius: 14px;
    text-decoration: none;
    color: var(--dash-text);
    font-weight: 600;
}

.side-link:hover,
.side-link.active {
    background: rgba(47, 109, 69, .08);
    color: var(--dash-primary);
}

.side-link small {
    color: var(--dash-muted);
    font-weight: 700;
}

.sidebar-footer {
    margin-top: 22px;
    padding-top: 18px;
    border-top: 1px solid var(--dash-border);
    color: var(--dash-muted);
    font-size: 13px;
}

.dashboard-panel {
    padding: 24px;
}

.dash-topbar {
    display: flex;
    justify-content: space-between;
    align-items: start;
    gap: 18px;
    margin-bottom: 24px;
}

.dash-title {
    margin: 0;
    font-size: 32px;
    color: var(--dash-text);
}

.dash-subtitle {
    margin-top: 6px;
    color: var(--dash-muted);
}

.dash-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.dash-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 16px;
    border-radius: 14px;
    text-decoration: none;
    font-weight: 700;
    border: 1px solid var(--dash-border);
}

.dash-btn.primary {
    background: var(--dash-primary);
    color: #fff;
    border-color: var(--dash-primary);
}

.dash-btn.light {
    background: #fff;
    color: var(--dash-text);
}

.kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 18px;
}

.kpi-card {
    padding: 18px;
    border-radius: 18px;
    background: linear-gradient(180deg, #fff, #fbfcfa);
    border: 1px solid var(--dash-border);
}

.kpi-label {
    color: var(--dash-muted);
    font-size: 13px;
    margin-bottom: 8px;
}

.kpi-value {
    font-size: 30px;
    font-weight: 800;
    color: var(--dash-text);
}

.kpi-note {
    margin-top: 6px;
    color: var(--dash-muted);
    font-size: 13px;
}

.dash-grid {
    display: grid;
    grid-template-columns: 1.35fr .95fr;
    gap: 18px;
    margin-top: 18px;
}

.dash-card {
    padding: 18px;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.card-title {
    margin: 0;
    font-size: 18px;
    color: var(--dash-text);
}

.chart-bars {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 10px;
    align-items: end;
    height: 220px;
    margin-top: 18px;
}

.chart-col {
    display: grid;
    gap: 8px;
    justify-items: center;
}

.chart-bar {
    width: 100%;
    max-width: 28px;
    border-radius: 999px 999px 8px 8px;
    min-height: 18px;
}

.chart-bar.primary { background: linear-gradient(180deg, #4aa06b, #2f6d45); }
.chart-bar.accent { background: linear-gradient(180deg, #e2b45c, #c88f2f); }

.chart-labels {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    margin-top: 10px;
    color: var(--dash-muted);
    font-size: 12px;
}

.list-stack {
    display: grid;
    gap: 12px;
}

.list-item {
    display: flex;
    justify-content: space-between;
    gap: 14px;
    padding: 14px 0;
    border-bottom: 1px solid var(--dash-border);
}

.list-item:last-child {
    border-bottom: 0;
}

.list-title {
    font-weight: 700;
    color: var(--dash-text);
}

.list-meta {
    color: var(--dash-muted);
    font-size: 13px;
    margin-top: 4px;
}

.badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    background: rgba(47, 109, 69, .08);
    color: var(--dash-primary);
}

@media (max-width: 1200px) {
    .dashboard-shell { grid-template-columns: 1fr; }
    .dashboard-sidebar { position: static; }
    .kpi-grid, .dash-grid { grid-template-columns: 1fr 1fr; }
}

@media (max-width: 760px) {
    .kpi-grid, .dash-grid { grid-template-columns: 1fr; }
    .dash-topbar { flex-direction: column; }
}
</style>

<div class="dashboard-shell">
    <aside class="dashboard-sidebar">
        <div class="brand-block">
            <div class="brand-mark">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l9 4.5V17l-9 5-9-5V6.5L12 2z"/></svg>
            </div>
            <div>
                <div class="brand-title">MonNouveauMoi</div>
                <div class="brand-subtitle">Dashboard projet régime</div>
            </div>
        </div>

        <div class="side-section">Navigation</div>
        <a class="side-link active" href="<?= site_url('/admin') ?>">Tableau de bord <small>overview</small></a>
        <a class="side-link" href="<?= site_url('/admin/regime') ?>">Régimes <small><?= esc((string) $regimeCount) ?></small></a>
        <a class="side-link" href="<?= site_url('/admin/activite') ?>">Activités <small><?= esc((string) $activiteCount) ?></small></a>
        <a class="side-link" href="<?= site_url('/regime') ?>">Interface client <small>front office</small></a>
        <a class="side-link" href="<?= site_url('/portemonaie/recharge') ?>">Portefeuille <small>code</small></a>
        <a class="side-link" href="<?= site_url('/paiement/gold') ?>">Option Gold <small>remise</small></a>

        <div class="side-section">Système</div>
        <a class="side-link" href="#">Paramètres <small>à venir</small></a>
        <a class="side-link" href="#">Exports <small>PDF</small></a>

        <div class="sidebar-footer">
            <div class="badge">Admin connecté</div>
            <div style="margin-top:12px;">Gère les régimes, les activités, les codes et les achats utilisateur.</div>
        </div>
    </aside>

    <main class="dashboard-panel">
        <div class="dash-topbar">
            <div>
                <h1 class="dash-title">Tableau de bord</h1>
                <div class="dash-subtitle">Vue d’ensemble de l’application de sélection de régime alimentaire adaptée aux objectifs.</div>
            </div>
            <div class="dash-actions">
                <a class="dash-btn light" href="<?= site_url('/admin/regime/create') ?>">Créer un régime</a>
                <a class="dash-btn light" href="<?= site_url('/admin/activite/create') ?>">Créer une activité</a>
                <a class="dash-btn primary" href="<?= site_url('/regime') ?>">Voir le front client</a>
            </div>
        </div>

        <section class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-label">Utilisateurs</div>
                <div class="kpi-value"><?= esc((string) $userCount) ?></div>
                <div class="kpi-note">Comptes enregistrés dans la base</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Régimes</div>
                <div class="kpi-value"><?= esc((string) $regimeCount) ?></div>
                <div class="kpi-note">Régimes alimentaires disponibles</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Activités</div>
                <div class="kpi-value"><?= esc((string) $activiteCount) ?></div>
                <div class="kpi-note">Activités liées aux régimes</div>
            </div>
            <div class="kpi-card">
                <div class="kpi-label">Gold / Wallet</div>
                <div class="kpi-value"><?= esc((string) $goldUserCount) ?></div>
                <div class="kpi-note"><?= esc((string) $codeCount) ?> codes actifs, solde total: <?= esc((string) $totalWallet) ?></div>
            </div>
        </section>

        <section class="dash-grid">
            <article class="dash-card">
                <div class="card-header">
                    <h2 class="card-title">Répartition des objectifs</h2>
                    <span class="badge"><?= esc((string) $choiceCount) ?> choix</span>
                </div>

                <div class="chart-bars">
                    <?php
                        $labels = ['Perdre', 'Gagner', 'IMC idéal'];
                        $totals = [0, 0, 0];
                        foreach ($objectiveStats as $row) {
                                $label = $row['label'] ?? '';
                                $index = array_search($label, ['Perdre du poids', 'Gagner du poids', 'Atteindre un imc ideal'], true);
                                if ($index !== false) {
                                        $totals[$index] = (int) $row['total'];
                                }
                        }
                        $max = max(1, max($totals));
                    ?>
                    <?php foreach ($totals as $index => $total): ?>
                        <div class="chart-col">
                            <div class="chart-bar <?= $index === 1 ? 'accent' : 'primary' ?>" style="height: <?= 20 + (int) round(($total / $max) * 180) ?>px"></div>
                            <div style="font-weight:700;color:var(--dash-text)"><?= esc((string) $total) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="chart-labels">
                    <span>Perdre du poids</span>
                    <span>Gagner du poids</span>
                    <span>IMC idéal</span>
                    <span></span><span></span><span></span>
                </div>
            </article>

            <article class="dash-card">
                <div class="card-header">
                    <h2 class="card-title">Derniers achats / objectifs</h2>
                    <span class="badge"><?= esc((string) $paymentCount) ?> paiements</span>
                </div>

                <div class="list-stack">
                    <?php if (empty($recentChoices)): ?>
                        <div class="list-item">
                            <div>
                                <div class="list-title">Aucun choix enregistré</div>
                                <div class="list-meta">Les sélections de régime apparaîtront ici.</div>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($recentChoices as $choice): ?>
                            <div class="list-item">
                                <div>
                                    <div class="list-title"><?= esc((string) $choice['userName']) ?> · <?= esc((string) $choice['regimeName']) ?></div>
                                    <div class="list-meta"><?= esc((string) $choice['objectifName']) ?> · <?= esc((string) $choice['duree']) ?> jours</div>
                                </div>
                                <div class="badge"><?= esc((string) $choice['dateChoix']) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </article>
        </section>

        <section class="dash-grid">
            <article class="dash-card">
                <div class="card-header">
                    <h2 class="card-title">Recharges portefeuille</h2>
                    <span class="badge">5 dernières opérations</span>
                </div>

                <div class="list-stack">
                    <?php if (empty($recentTopups)): ?>
                        <div class="list-item">
                            <div>
                                <div class="list-title">Aucune recharge</div>
                                <div class="list-meta">Les montants rechargés s’afficheront ici.</div>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($recentTopups as $topup): ?>
                            <div class="list-item">
                                <div>
                                    <div class="list-title"><?= esc((string) $topup['userName']) ?></div>
                                    <div class="list-meta">Recharge de portefeuille</div>
                                </div>
                                <div class="badge"><?= esc((string) $topup['montant']) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </article>

            <article class="dash-card">
                <div class="card-header">
                    <h2 class="card-title">Accès rapides</h2>
                </div>

                <div class="list-stack">
                    <a class="side-link" href="<?= site_url('/admin/regime') ?>">Gérer les régimes <small>CRUD</small></a>
                    <a class="side-link" href="<?= site_url('/admin/activite') ?>">Gérer les activités <small>CRUD</small></a>
                    <a class="side-link" href="<?= site_url('/portemonaie/recharge') ?>">Recharger le portefeuille <small>code</small></a>
                    <a class="side-link" href="<?= site_url('/paiement/gold') ?>">Acheter Gold <small>-15%</small></a>
                    <a class="side-link" href="<?= site_url('/regime/imc') ?>">Voir l’IMC idéal <small>client</small></a>
                </div>
            </article>
        </section>
    </main>
</div>
<?= $this->endSection() ?>
