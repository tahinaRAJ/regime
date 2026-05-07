<?= $this->extend('auth/layoutForm') ?>

<?= $this->section('content') ?>

<?php $data = $data ?? []; ?>

<?php if (!empty($erreur)) : ?>
    <div class="gentle-error" style="display:block;margin-bottom:12px;">
        <?= esc($erreur) ?>
    </div>
<?php endif; ?>

<form action="<?= base_url('register') ?>" method="post" class="harmony-form" id="signupStep1Form" novalidate>
    <?= csrf_field() ?>

    <div class="organic-field">
        <div class="field-nature"></div>
        <input type="text" id="name" name="name" required autocomplete="name" value="<?= esc($data['name'] ?? '') ?>">
        <label for="name">Nom</label>
        <div class="growth-indicator">
            <div class="leaf-sprout"></div>
        </div>
        <span class="gentle-error" id="nameError"></span>
    </div>

    <div class="organic-field">
        <div class="field-nature"></div>
        <input type="email" id="email" name="email" required autocomplete="email" value="<?= esc($data['email'] ?? '') ?>">
        <label for="email">Adresse Email</label>
        <div class="growth-indicator">
            <div class="leaf-sprout"></div>
        </div>
        <span class="gentle-error" id="emailError"></span>
    </div>

    <div class="organic-field">
        <div class="field-nature"></div>
        <select id="genre" name="genre" required style="width:100%;padding:16px 20px;border-radius:20px;border:2px solid var(--sage-200);background:rgba(255,255,255,.85);">
            <option value="" <?= empty($data['genre']) ? 'selected' : '' ?>>Genre...</option>
            <option value="Homme" <?= ($data['genre'] ?? '') === 'Homme' ? 'selected' : '' ?>>Homme</option>
            <option value="Femme" <?= ($data['genre'] ?? '') === 'Femme' ? 'selected' : '' ?>>Femme</option>
        </select>
        <span class="gentle-error" id="genreError"></span>
    </div>

    <div class="organic-field">
        <div class="field-nature"></div>
        <input type="number" id="age" name="age" required autocomplete="age" value="<?= esc($data['age'] ?? '') ?>">
        <label for="age">Âge</label>
        <span class="gentle-error" id="ageError"></span>
    </div>

    <div class="organic-field">
        <div class="field-nature"></div>
        <input type="password" id="password" name="password" required autocomplete="new-password">
        <label for="password">Mot de passe</label>
        <button type="button" class="nature-toggle" id="passwordToggle" aria-label="Toggle password visibility">
            <svg class="eye-visible" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M10 4c-4 0-7 3-8 6 1 3 4 6 8 6s7-3 8-6c-1-3-4-6-8-6zm0 10a4 4 0 110-8 4 4 0 010 8zm0-6a2 2 0 100 4 2 2 0 000-4z" fill="currentColor" />
            </svg>
            <svg class="eye-hidden" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M3 3l14 14M8.5 8.5a2 2 0 002.83 2.83m-.83-4.83a4 4 0 014 4M10 6C6 6 3 9 2 12c.5 1.5 2 3.5 4 4.5M10 14c4 0 7-3 8-6-.5-1.5-2-3.5-4-4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
        <span class="gentle-error" id="passwordError"></span>
    </div>

    <div class="organic-field">
        <div class="field-nature"></div>
        <input type="password" id="password_confirm" name="password_confirm" required autocomplete="new-password">
        <label for="password_confirm">Confirmer le mot de passe</label>
        <span class="gentle-error" id="password_confirmError"></span>
    </div>

    <button type="submit" class="harmony-button">
        <div class="button-earth"></div>
        <span class="button-text">Suivant</span>
        <div class="button-growth">
            <div class="growing-circle circle-1"></div>
            <div class="growing-circle circle-2"></div>
            <div class="growing-circle circle-3"></div>
        </div>
        <div class="button-aura"></div>
    </button>
</form>

<div class="balance-divider">
    <div class="divider-branch"></div>
    <div class="divider-center">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M12 2L8 8h8l-4-6zM12 22l4-6H8l4 6zM2 12l6-4v8l-6-4zM22 12l-6 4V8l6 4z" fill="currentColor" opacity="0.6" />
        </svg>
    </div>
    <div class="divider-branch"></div>
</div>

<div class="nurture-signup">
    <span>Déjà un compte ? </span>
    <a href="<?= base_url('login') ?>" class="growth-link">Se connecter</a>
</div>

<div class="harmony-success" id="successMessage">
    <div class="success-mandala">
        <div class="mandala-ring ring-1"></div>
        <div class="mandala-ring ring-2"></div>
        <div class="mandala-ring ring-3"></div>
        <div class="mandala-center">
            <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
                <path d="M8 14l6 6 12-12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
    </div>
</div>

<?= $this->endSection() ?>