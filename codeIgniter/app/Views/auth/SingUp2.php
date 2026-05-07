<?= $this->extend('auth/layoutForm') ?>

<?= $this->section('content') ?>

<form method="post" class="harmony-form" id="loginForm" novalidate>
    <div class="organic-field">
        <div class="field-nature"></div>
        <input type="number" id="taille" name="taille" required autocomplete="taille">
        <label for="taille">Taille (en cm)</label>
        <div class="growth-indicator">
            <div class="leaf-sprout"></div>
        </div>
        <span class="gentle-error" id="tailleError"></span>
    </div>

    <div class="organic-field">
        <div class="field-nature"></div>
        <input type="number" id="poids" name="poids" required autocomplete="poids">
        <label for="poids">Poids (en kg)</label>
        <div class="growth-indicator">
            <div class="leaf-sprout"></div>
        </div>
        <span class="gentle-error" id="poidsError"></span>
    </div>

    <button type="submit" class="harmony-button">
        <div class="button-earth"></div>
        <span class="button-text">Confirmer</span>
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
    <a href="#" class="growth-link">Se connecter</a>
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