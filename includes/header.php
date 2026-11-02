<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Shared Institutional Site Header
 *
 * @var string $page_title
 * @var string $page_desc
 * @var string $page_canonical
 */

require_once __DIR__ . '/../config/config.php';

$meta_title = !empty($page_title) 
    ? e($page_title) . ' | ' . APP_NAME 
    : APP_NAME . ' — International Freight Forwarding & Logistics Solutions';

$meta_desc = !empty($page_desc) 
    ? e($page_desc) 
    : 'Spillburg Logistics 1 (Private) Limited provides ocean freight forwarding, air cargo coordination, inland drayage, project cargo, customs brokerage, and bonded warehousing centered on the Port of Colombo transshipment hub.';

$canonical_url = !empty($page_canonical) ? $page_canonical : (APP_URL . $_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $meta_title ?></title>
    <meta name="description" content="<?= $meta_desc ?>">
    <link rel="canonical" href="<?= e($canonical_url) ?>">

    <!-- Open Graph / Meta -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= $meta_title ?>">
    <meta property="og:description" content="<?= $meta_desc ?>">
    <meta property="og:url" content="<?= e($canonical_url) ?>">
    <meta property="og:site_name" content="<?= APP_LEGAL_NAME ?>">
    <meta property="og:image" content="<?= url('assets/images/services-ocean-freight.webp') ?>">

    <!-- Favicon & Brand Icons -->
    <link rel="icon" type="image/png" href="<?= url('assets/images/logo-spillburg-logistics.png') ?>">
    <link rel="apple-touch-icon" href="<?= url('assets/images/logo-spillburg-logistics.png') ?>">

    <!-- Google Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>?v=<?= time() ?>">
</head>
<body>

<!-- Operational Status Bar / Hub Ticker -->
<div class="operational-ticker">
    <div class="container operational-ticker-inner">
        <div class="status-indicator">
            <span class="status-dot"></span>
            <span>HUB STATUS: <strong>PORT OF COLOMBO TERMINALS (CICT / JCT / SAGT) OPERATIONAL</strong></span>
        </div>
        <div class="ticker-metrics">
            <div class="ticker-metric-item">
                <span>GATEWAY:</span>
                <strong>CMB / LKR</strong>
            </div>
            <div class="ticker-metric-item">
                <span>DIRECT DESK:</span>
                <a href="tel:<?= str_replace(' ', '', COMPANY_PHONE_PRIMARY) ?>" style="color: #FFFFFF; text-decoration: none; font-weight: 700;"><?= COMPANY_PHONE_PRIMARY ?></a>
            </div>
        </div>
    </div>
</div>

<!-- Main Sticky Site Header -->
<header class="site-header">
    <div class="container header-inner">
        <!-- Brand Logo -->
        <a href="<?= url() ?>" class="brand-wrapper" aria-label="Spillburg Logistics 1 Home">
            <img src="<?= url('assets/images/logo-spillburg-logistics.png') ?>" alt="<?= APP_LEGAL_NAME ?>" class="brand-logo-img" width="220" height="48" onerror="this.src='<?= url('assets/images/stitch-logo.webp') ?>'">
        </a>

        <!-- Desktop Navigation -->
        <nav aria-label="Main Navigation">
            <ul class="desktop-nav">
                <li class="nav-item">
                    <a href="<?= url() ?>" class="nav-link<?= is_active('') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('about.php') ?>" class="nav-link<?= is_active('about') ?>">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('services.php') ?>" class="nav-link<?= is_active('service') ?>">
                        Services
                        <span class="material-symbols-outlined nav-dropdown-icon">expand_more</span>
                    </a>
                    <ul class="nav-dropdown">
                        <li>
                            <a href="<?= url('service-sea-freight.php') ?>">
                                <span class="material-symbols-outlined dropdown-icon">directions_boat</span>
                                Sea Freight Forwarding
                            </a>
                        </li>
                        <li>
                            <a href="<?= url('service-air-freight.php') ?>">
                                <span class="material-symbols-outlined dropdown-icon">flight_takeoff</span>
                                Air Cargo Coordination
                            </a>
                        </li>
                        <li>
                            <a href="<?= url('service-road-freight.php') ?>">
                                <span class="material-symbols-outlined dropdown-icon">local_shipping</span>
                                Inland Road Transport
                            </a>
                        </li>
                        <li>
                            <a href="<?= url('service-project-cargo.php') ?>">
                                <span class="material-symbols-outlined dropdown-icon">precision_manufacturing</span>
                                Project Cargo &amp; Heavy Lift
                            </a>
                        </li>
                        <li>
                            <a href="<?= url('service-customs-clearance.php') ?>">
                                <span class="material-symbols-outlined dropdown-icon">verified_user</span>
                                Customs Brokerage &amp; Clearance
                            </a>
                        </li>
                        <li>
                            <a href="<?= url('service-warehousing.php') ?>">
                                <span class="material-symbols-outlined dropdown-icon">warehouse</span>
                                Warehousing &amp; Cargo Staging
                            </a>
                        </li>
                        <li class="nav-dropdown-divider">
                            <a href="<?= url('services.php') ?>" class="nav-dropdown-all">
                                View All Logistics Services &rarr;
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= url('industries.php') ?>" class="nav-link<?= is_active('industries') ?>">Industries</a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('news.php') ?>" class="nav-link<?= is_active('news') ?>">Port Advisories</a>
                </li>
                <li class="nav-item">
                    <a href="<?= url('contact.php') ?>" class="nav-link<?= is_active('contact') ?>">Contact Us</a>
                </li>
            </ul>
        </nav>

        <!-- Header Actions -->
        <div class="header-actions">
            <a href="<?= url('quote.php') ?>" class="btn-header-quote">
                <span class="material-symbols-outlined" style="font-size: 18px;">request_quote</span>
                Request a Quote
            </a>
            <button type="button" class="mobile-menu-toggle" aria-label="Open mobile menu">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
</header>

<!-- Flash Messages -->
<?php require_once __DIR__ . '/flash.php'; ?>

<main id="main-content">
