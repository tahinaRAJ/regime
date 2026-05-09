<?= $this->extend('auth/layoutForm') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="success-banner" style="display:block;margin-bottom:20px;background:rgba(34,197,94,.15);border:2px solid rgba(34,197,94,.4);border-radius:8px;padding:16px;color:#166534;">
        <div style="display:flex;align-items:center;gap:12px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            <div>
                <strong style="font-size:16px;display:block;margin-bottom:4px;">Rechargement réussi!</strong>
                <span><?= esc((string)session()->getFlashdata('success')) ?></span>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('erreur')) : ?>
    <div class="error-banner" style="display:block;margin-bottom:20px;background:rgba(239,68,68,.15);border:2px solid rgba(239,68,68,.4);border-radius:8px;padding:16px;color:#991b1b;">
        <div style="display:flex;align-items:center;gap:12px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            <span><?= esc((string)session()->getFlashdata('erreur')) ?></span>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty($erreur)) : ?>
    <div class="error-banner" style="display:block;margin-bottom:20px;background:rgba(239,68,68,.15);border:2px solid rgba(239,68,68,.4);border-radius:8px;padding:16px;color:#991b1b;">
        <div style="display:flex;align-items:center;gap:12px;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            <span><?= esc((string)$erreur) ?></span>
        </div>
    </div>
<?php endif; ?>

<form class="harmony-form" id="rechargeForm" method="post" action="<?= base_url('portemonaie/recharge') ?>" novalidate>
    <?= csrf_field() ?>
    
    <h2 style="text-align:center;margin-bottom:24px;color:#4b5563;font-size:24px;font-weight:600;">
        Recharger votre Portefeuille
    </h2>

    <div class="organic-field">
        <div class="field-nature"></div>
        <input type="text" id="code" name="code" required autocomplete="off" placeholder="Entrez votre code">
        <label for="code">Code de Rechargement</label>
        <div class="growth-indicator">
            <div class="leaf-sprout"></div>
        </div>
        <span class="gentle-error" id="codeError"></span>
    </div>

    <button type="submit" class="harmony-button">
        <div class="button-earth"></div>
        <span class="button-text">Recharger</span>
        <div class="button-growth">
            <div class="growing-circle circle-1"></div>
            <div class="growing-circle circle-2"></div>
            <div class="growing-circle circle-3"></div>
        </div>
    </button>
</form>

<script>
class RechargeForm {
    constructor() {
        this.form = document.getElementById('rechargeForm');
        this.codeInput = document.getElementById('code');
        this.codeError = document.getElementById('codeError');
        
        if (this.form) {
            this.form.addEventListener('submit', (e) => this.handleSubmit(e));
        }
    }

    handleSubmit(e) {
        this.clearErrors();
        
        if (!this.validateCode()) {
            e.preventDefault();
        }
    }

    validateCode() {
        const code = this.codeInput.value.trim();
        
        if (!code) {
            this.showError(this.codeError, 'Veuillez entrer un code');
            return false;
        }
        
        if (code.length < 3) {
            this.showError(this.codeError, 'Le code doit contenir au moins 3 caractères');
            return false;
        }
        
        return true;
    }

    showError(element, message) {
        element.textContent = message;
        element.style.display = 'block';
    }

    clearErrors() {
        this.codeError.textContent = '';
        this.codeError.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new RechargeForm();
});
</script>

<?= $this->endSection() ?>
