<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <meta name="description" content="Nature-inspired login form with organic shapes and a mindful, gentle interaction language.">
    <meta name="author" content="Aigars Silkalns / Colorlib">
    <link rel="canonical" href="https://puikinsh.github.io/login-forms/forms/eco-wellness/">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><circle cx='50' cy='50' r='48' fill='%236366f1'/><text x='50' y='68' font-size='60' text-anchor='middle' fill='white' font-family='system-ui,sans-serif'>L</text></svg>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Eco Wellness Login Form">
    <meta property="og:description" content="Nature-inspired login form with organic shapes and a mindful, gentle interaction language.">
    <meta property="og:url" content="https://puikinsh.github.io/login-forms/forms/eco-wellness/">
    <meta property="og:image" content="https://puikinsh.github.io/login-forms/assets/screenshots/eco-wellness.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Eco Wellness Login Form">
    <meta name="twitter:description" content="Nature-inspired login form with organic shapes and a mindful, gentle interaction language.">
    <meta name="twitter:image" content="https://puikinsh.github.io/login-forms/assets/screenshots/eco-wellness.png">
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
                        <circle cx="28" cy="28" r="26" stroke="currentColor" stroke-width="2" fill="none" opacity="0.6" />
                        <circle cx="28" cy="28" r="18" stroke="currentColor" stroke-width="1.5" fill="none" opacity="0.8" />
                        <circle cx="28" cy="28" r="10" fill="currentColor" opacity="0.9" />
                        <path d="M28 18v20M18 28h20" stroke="white" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <div class="zen-glow"></div>
                </div>
                <h1>MonNouveauMoi</h1>
                <p> Devenir une meilleure version de soi</p>
            </div>
            <?= $this->renderSection('content') ?>
            <script src="<?= base_url('assets/js/form-utils.js') ?>"></script>
            <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>

</html>