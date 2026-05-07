<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
    <div class="nature-background">
        <div class="floating-leaf leaf-1"></div>
        <div class="floating-leaf leaf-2"></div>
        <div class="floating-leaf leaf-3"></div>
        <div class="floating-leaf leaf-4"></div>
    </div>

    <div class="login-container">
        <div class="wellness-card">
            <div class="organic-border"></div>

            <div class="mindful-header">
                <div class="zen-logo">
                    <svg width="56" height="56" viewBox="0 0 56 56" fill="none">
                        <circle cx="28" cy="28" r="26" stroke="currentColor" stroke-width="2" fill="none" opacity="0.6"/>
                        <circle cx="28" cy="28" r="18" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.8"/>
                        <circle cx="28" cy="28" r="10" fill="currentColor" opacity="0.9"/>
                        <path d="M28 18v20M18 28h20" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    <div class="zen-glow"></div>
                </div>
                <h1>MonNouveauMoi</h1>
                <p>Étape 1/2 — Informations générales</p>
            </div>

            <?php if (!empty($erreur)) : ?>
                <div class="gentle-error" style="display:block;margin-bottom:12px;">
                    <?= esc($erreur) ?>
                </div>
            <?php endif; ?>

            <div class="gentle-error" id="clientError" style="display:none;margin-bottom:12px;"></div>

            <form class="harmony-form" method="post" action="/register" novalidate>
                <?= csrf_field() ?>

                <div class="organic-field">
                    <div class="field-nature"></div>
                    <input type="text" id="name" name="name" required value="<?= esc($data['name'] ?? '') ?>">
                    <label for="name">Nom</label>
                </div>

                <div class="organic-field">
                    <div class="field-nature"></div>
                    <input type="email" id="email" name="email" required value="<?= esc($data['email'] ?? '') ?>">
                    <label for="email">Email Address</label>
                </div>

                <div class="organic-field">
                    <div class="field-nature"></div>
                    <select id="genre" name="genre" required style="width:100%;padding:16px 20px;border-radius:20px;border:2px solid var(--sage-200);background:rgba(255,255,255,.85);">
                        <option value="" <?= empty($data['genre']) ? 'selected' : '' ?>>Genre...</option>
                        <option value="Homme" <?= ($data['genre'] ?? '') === 'Homme' ? 'selected' : '' ?>>Homme</option>
                        <option value="Femme" <?= ($data['genre'] ?? '') === 'Femme' ? 'selected' : '' ?>>Femme</option>
                    </select>
                </div>

                <div class="organic-field">
                    <div class="field-nature"></div>
                    <input type="number" id="age" name="age" required value="<?= esc($data['age'] ?? '') ?>">
                    <label for="age">Âge</label>
                </div>

                <div class="organic-field">
                    <div class="field-nature"></div>
                    <input type="password" id="password" name="password" required>
                    <label for="password">Password</label>
                </div>

                <div class="organic-field">
                    <div class="field-nature"></div>
                    <input type="password" id="password_confirm" name="password_confirm" required>
                    <label for="password_confirm">Confirmer le mot de passe</label>
                </div>

                <button type="submit" class="harmony-button">
                    <div class="button-earth"></div>
                    <span class="button-text">Vérifier et continuer</span>
                    <div class="button-growth">
                        <div class="growing-circle circle-1"></div>
                        <div class="growing-circle circle-2"></div>
                        <div class="growing-circle circle-3"></div>
                    </div>
                    <div class="button-aura"></div>
                </button>
            </form>

            <div class="nurture-signup" style="margin-top: 18px;">
                <a href="/login" class="growth-link">Retour au login</a>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const form = document.querySelector('form.harmony-form');
            const errorBox = document.getElementById('clientError');

            if (!form || !errorBox) return;

            function showError(message) {
                errorBox.textContent = message;
                errorBox.style.display = 'block';
            }

            function clearError() {
                errorBox.textContent = '';
                errorBox.style.display = 'none';
            }

            form.addEventListener('submit', function (e) {
                clearError();

                const name = (document.getElementById('name')?.value || '').trim();
                const email = (document.getElementById('email')?.value || '').trim();
                const genre = (document.getElementById('genre')?.value || '').trim();
                const age = (document.getElementById('age')?.value || '').trim();
                const password = document.getElementById('password')?.value || '';
                const passwordConfirm = document.getElementById('password_confirm')?.value || '';

                if (!name || !email || !genre || !age || !password || !passwordConfirm) {
                    e.preventDefault();
                    showError('Veuillez remplir tous les champs');
                    return;
                }

                const emailOk = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                if (!emailOk) {
                    e.preventDefault();
                    showError('Email invalide');
                    return;
                }

                const ageOk = /^\d+$/.test(age) && parseInt(age, 10) > 0;
                if (!ageOk) {
                    e.preventDefault();
                    showError('Âge invalide');
                    return;
                }

                if (password.length < 6) {
                    e.preventDefault();
                    showError('Mot de passe trop court (min 6 caractères)');
                    return;
                }

                if (password !== passwordConfirm) {
                    e.preventDefault();
                    showError('Les mots de passe ne correspondent pas');
                    return;
                }
            });
        })();
    </script>
</body>
</html>
