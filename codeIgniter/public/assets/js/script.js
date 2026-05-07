// Eco Wellness Login Form
class EcoWellnessLoginForm extends FormUtils.LoginFormBase {
    constructor() {
        super({
            formId: 'loginForm',
            submitButtonSelector: '.harmony-button',
            formGroupSelector: '.organic-field',
            hideOnSuccess: ['.natural-social', '.nurture-signup', '.balance-divider'],
            validators: {
                email: (v) => {
                    if (!v) return { isValid: false, message: 'Vous avez besoin d\'une adresse email' };
                    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)) return { isValid: false, message: 'Veuillez partager une adresse email valide' };
                    return { isValid: true };
                },
                password: (v) => {
                    if (!v) return { isValid: false, message: 'Vous avez besoin d\'un mot de passe' };
                    if (v.length < 6) return { isValid: false, message: 'Please choose a stronger protection (6+ characters)' };
                    return { isValid: true };
                },
            },
        });
    }

    decorate() {
        if (!document.getElementById('wellness-keyframes')) {
            const style = document.createElement('style');
            style.id = 'wellness-keyframes';
            style.textContent = `
                @keyframes gentleBreath { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.01); } }
            `;
            document.head.appendChild(style);
        }

        // Mindful breathing animation on focus
        [this.form.querySelector('#email'), this.form.querySelector('#password')].forEach(input => {
            if (!input) return;
            input.setAttribute('placeholder', ' ');
            input.addEventListener('focus', () => {
                const nature = input.closest('.organic-field')?.querySelector('.field-nature');
                if (nature) nature.style.animation = 'gentleBreath 3s ease-in-out infinite';
            });
            input.addEventListener('blur', () => {
                const nature = input.closest('.organic-field')?.querySelector('.field-nature');
                if (nature) nature.style.animation = '';
            });
        });
    }
}

class EcoWellnessSignupStep1Form extends FormUtils.LoginFormBase {
    constructor() {
        super({
            formId: 'signupStep1Form',
            submitButtonSelector: '.harmony-button',
            formGroupSelector: '.organic-field',
            validators: {
                name: (v) => {
                    if (!v) return { isValid: false, message: 'Veuillez entrer votre nom' };
                    return { isValid: true };
                },
                email: (v) => {
                    if (!v) return { isValid: false, message: 'Vous avez besoin d\'une adresse email' };
                    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)) return { isValid: false, message: 'Veuillez partager une adresse email valide' };
                    return { isValid: true };
                },
                genre: (v) => {
                    if (!v) return { isValid: false, message: 'Veuillez choisir un genre' };
                    return { isValid: true };
                },
                age: (v) => {
                    if (!v) return { isValid: false, message: 'Veuillez entrer votre âge' };
                    if (!/^\d+$/.test(v) || parseInt(v, 10) <= 0) return { isValid: false, message: 'Âge invalide' };
                    return { isValid: true };
                },
                password: (v) => {
                    if (!v) return { isValid: false, message: 'Vous avez besoin d\'un mot de passe' };
                    if (v.length < 6) return { isValid: false, message: 'Mot de passe trop court (min 6 caractères)' };
                    return { isValid: true };
                },
                password_confirm: (v) => {
                    const pwd = document.getElementById('password')?.value || '';
                    if (!v) return { isValid: false, message: 'Veuillez confirmer le mot de passe' };
                    if (v !== pwd) return { isValid: false, message: 'Les mots de passe ne correspondent pas' };
                    return { isValid: true };
                },
            },
        });
    }
}

class EcoWellnessSignupStep2Form extends FormUtils.LoginFormBase {
    constructor() {
        super({
            formId: 'signupStep2Form',
            submitButtonSelector: '.harmony-button',
            formGroupSelector: '.organic-field',
            validators: {
                height: (v) => {
                    if (!v) return { isValid: false, message: 'Veuillez entrer votre taille' };
                    const n = Number(v);
                    if (!Number.isFinite(n) || n <= 0) return { isValid: false, message: 'Taille invalide' };
                    return { isValid: true };
                },
                weight: (v) => {
                    if (!v) return { isValid: false, message: 'Veuillez entrer votre poids' };
                    const n = Number(v);
                    if (!Number.isFinite(n) || n <= 0) return { isValid: false, message: 'Poids invalide' };
                    return { isValid: true };
                },
            },
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('loginForm')) new EcoWellnessLoginForm();
    if (document.getElementById('signupStep1Form')) new EcoWellnessSignupStep1Form();
    if (document.getElementById('signupStep2Form')) new EcoWellnessSignupStep2Form();
});
