<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Operations Administrative Console — Shared Header
 */

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/auth.php';

Auth::requireAuth();
$currentUser = Auth::user();

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= !empty($page_title) ? e($page_title) . ' | ' : '' ?>Spillburg Operations Console</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>?v=<?= time() ?>">
    <link rel="icon" type="image/png" href="<?= url('assets/images/logo-spillburg-logistics.png') ?>">
</head>
<body style="background-color: #F1F5F9;">

<!-- Admin Mobile Topbar (tablets & mobile <= 1024px) -->
<header class="admin-mobile-header">
    <div style="display: flex; align-items: center; gap: 0.75rem;">
        <button type="button" class="admin-mobile-toggle" id="adminSidebarToggle" aria-label="Toggle Operations Menu">
            <span class="material-symbols-outlined" style="font-size: 24px;">menu</span>
        </button>
        <div style="font-weight: 800; font-size: 1rem; color: #FFFFFF; line-height: 1.1;">
            SPILLBURG <span style="color: var(--color-amber-accent);">LOGISTICS 1</span>
        </div>
    </div>
    <div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.8125rem;">
        <span style="color: #CBD5E1; font-weight: 600; display: inline-flex; align-items: center; gap: 0.25rem;">
            <span class="material-symbols-outlined" style="font-size: 18px;">account_circle</span>
            <span style="max-width: 110px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= e($currentUser['name']) ?></span>
        </span>
        <a href="<?= url('admin/logout.php') ?>" style="color: #F87171; text-decoration: none; font-weight: 700; font-size: 0.75rem; background: rgba(239, 68, 68, 0.12); padding: 0.25rem 0.5rem; border-radius: var(--radius-sm); border: 1px solid rgba(239, 68, 68, 0.2);">
            Exit
        </a>
    </div>
</header>

<!-- Backdrop overlay for mobile sidebar -->
<div class="admin-sidebar-backdrop" id="adminSidebarBackdrop"></div>

<div class="admin-layout">
    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="admin-sidebar-header">
            <div>
                <div style="font-weight: 800; font-size: 1.125rem; color: #FFFFFF; line-height: 1.2;">
                    SPILLBURG <span style="color: var(--color-amber-accent);">LOGISTICS 1</span>
                </div>
                <div style="font-size: 0.7rem; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.08em; margin-top: 0.25rem;">
                    Operations Console
                </div>
            </div>
            <button type="button" class="admin-sidebar-close" id="adminSidebarClose" aria-label="Close navigation">
                <span class="material-symbols-outlined" style="font-size: 20px;">close</span>
            </button>
        </div>

        <nav style="flex-grow: 1;">
            <ul class="admin-nav">
                <li>
                    <a href="<?= url('admin/index.php') ?>" class="admin-nav-link <?= ($current_page === 'index.php') ? 'active' : '' ?>">
                        <span class="material-symbols-outlined" style="font-size: 20px;">dashboard</span>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= url('admin/quotes.php') ?>" class="admin-nav-link <?= (str_contains($current_page, 'quote')) ? 'active' : '' ?>">
                        <span class="material-symbols-outlined" style="font-size: 20px;">receipt_long</span>
                        RFQ Dockets
                    </a>
                </li>
                <li>
                    <a href="<?= url('admin/contacts.php') ?>" class="admin-nav-link <?= ($current_page === 'contacts.php') ? 'active' : '' ?>">
                        <span class="material-symbols-outlined" style="font-size: 20px;">mail</span>
                        Inquiries
                    </a>
                </li>
                <li>
                    <a href="<?= url('admin/news.php') ?>" class="admin-nav-link <?= ($current_page === 'news.php') ? 'active' : '' ?>">
                        <span class="material-symbols-outlined" style="font-size: 20px;">campaign</span>
                        Port Advisories
                    </a>
                </li>
                <li>
                    <a href="<?= url('admin/settings.php') ?>" class="admin-nav-link <?= ($current_page === 'settings.php') ? 'active' : '' ?>">
                        <span class="material-symbols-outlined" style="font-size: 20px;">settings</span>
                        Site Settings
                    </a>
                </li>
            </ul>
        </nav>

        <div style="border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 1.25rem; margin-top: auto;">
            <div style="font-size: 0.8125rem; color: #CBD5E1; margin-bottom: 0.5rem;">
                <span class="material-symbols-outlined" style="font-size: 16px; vertical-align: middle;">account_circle</span>
                <strong><?= e($currentUser['name']) ?></strong>
            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.75rem;">
                <a href="<?= url() ?>" target="_blank" style="color: #94A3B8; display: inline-flex; align-items: center; gap: 0.25rem;">
                    Live Site <span class="material-symbols-outlined" style="font-size: 13px;">open_in_new</span>
                </a>
                <a href="<?= url('admin/logout.php') ?>" style="color: #F87171; font-weight: 600;">
                    Log Out
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="admin-content">
        <?php require_once __DIR__ . '/../../includes/flash.php'; ?>
