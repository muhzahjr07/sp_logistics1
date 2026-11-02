<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Administrative Console Login
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/auth.php';

// Redirect if already logged in
if (Auth::check()) {
    header('Location: ' . url('admin/index.php'));
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Brute-force mitigation
    usleep(250000); // 250ms delay

    $csrf = $_POST['csrf_token'] ?? '';
    if (!verify_csrf_token($csrf)) {
        $error = 'Security token expired. Please try again.';
    } else {
        $email = trim((string)($_POST['email'] ?? ''));
        $password = (string)($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $error = 'Please enter both corporate email and operational password.';
        } elseif (Auth::attempt($email, $password)) {
            $redirect = $_SESSION['redirect_after_login'] ?? url('admin/index.php');
            unset($_SESSION['redirect_after_login']);
            set_flash('success', 'Authenticated successfully. Welcome to Spillburg Logistics 1 operations console.');
            header("Location: {$redirect}");
            exit;
        } else {
            $error = 'Invalid credentials or inactive administrative account.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operations Login | Spillburg Logistics 1</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>?v=<?= time() ?>">
    <link rel="icon" type="image/png" href="<?= url('assets/images/logo-spillburg-logistics.png') ?>">
</head>
<body style="background-color: var(--color-midnight); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 1.5rem;">

<div style="width: 100%; max-width: 440px; background-color: var(--color-surface-white); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-modal);">
    <div style="background-color: var(--color-navy-container); color: #FFFFFF; padding: 2rem; text-align: center; border-bottom: 2px solid var(--color-amber-accent);">
        <img src="<?= url('assets/images/logo-spillburg-logistics.png') ?>" alt="Spillburg Logistics 1" style="height: 44px; margin: 0 auto 0.75rem; filter: brightness(0) invert(1);" onerror="this.src='<?= url('assets/images/stitch-logo.webp') ?>'">
        <div style="font-weight: 800; font-size: 1.125rem; letter-spacing: -0.01em;">SPILLBURG <span style="color: var(--color-amber-accent);">LOGISTICS 1</span></div>
        <div style="font-size: 0.75rem; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.08em; margin-top: 0.25rem;">Operations Console</div>
    </div>

    <div style="padding: 2.25rem;">
        <?php if (!empty($error)): ?>
        <div class="alert alert-error" style="margin-bottom: 1.5rem; font-size: 0.875rem;">
            <span class="material-symbols-outlined">error</span>
            <div><?= e($error) ?></div>
        </div>
        <?php endif; ?>

        <form action="<?= url('admin/login.php') ?>" method="POST" novalidate>
            <?= csrf_field() ?>

            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label" for="email">Administrative Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="name@spillburglogistics1.com" value="<?= e($_POST['email'] ?? '') ?>" required autofocus>
            </div>

            <div class="form-group" style="margin-bottom: 1.75rem;">
                <label class="form-label" for="password">Operations Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                <span class="material-symbols-outlined">lock_open</span>
                Authenticate Console
            </button>
        </form>

        <div style="margin-top: 2rem; padding-top: 1.25rem; border-top: 1px solid var(--color-border-slate); font-size: 0.8125rem; text-align: center;">
            <a href="<?= url() ?>" style="color: var(--color-blue-industrial); text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 0.35rem;">
                <span class="material-symbols-outlined" style="font-size: 1rem;">arrow_back</span> Return to Public Website
            </a>
        </div>
    </div>
</div>

</body>
</html>
