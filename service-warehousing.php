<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Service Detail — Warehousing & Cargo Staging
 */

require_once __DIR__ . '/config/config.php';

$page_title = 'Warehousing & Cargo Staging';
$page_desc = 'Bonded warehouse storage, export consolidation, container devanning, and inventory staging in Colombo by Spillburg Logistics 1.';

$breadcrumbs = [
    ['title' => 'Services', 'url' => 'services.php'],
    ['title' => 'Warehousing & Staging', 'url' => 'service-warehousing.php']
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<section class="page-hero">
    <div class="page-hero-overlay" style="background-image: linear-gradient(90deg, rgba(0, 14, 31, 0.95) 0%, rgba(0, 14, 31, 0.85) 100%), url('<?= url('assets/images/services-warehousing.jpg') ?>');"></div>
    <div class="container">
        <div class="page-hero-content">
            <span class="technical-label amber" style="margin-bottom: 0.75rem;">
                <span class="material-symbols-outlined" style="font-size: 16px;">warehouse</span>
                STORAGE &bull; BUFFER INVENTORY
            </span>
            <h1>Warehousing &amp; Cargo Staging</h1>
            <p>
                Secure bonded and non-bonded warehouse staging facilities located within the Colombo port logistics perimeter for export consolidation and inventory holding.
            </p>
        </div>
    </div>
</section>

<section class="section-spacing bg-white">
    <div class="container">
        <div class="grid-split">
            <div>
                <span class="technical-label">STORAGE INFRASTRUCTURE</span>
                <h2 style="margin-top: 0.5rem; margin-bottom: 1.25rem;">
                    Port-Centric Warehousing &amp; Cross-Docking Facility
                </h2>
                <p style="font-size: 1.0625rem; line-height: 1.6; color: var(--color-midnight); font-weight: 500;">
                    Modern supply chains require flexible staging points between international freight arrivals and domestic distribution. Holding containerized cargo at port quays risks severe terminal demurrage.
                </p>
                <p>
                    Spillburg Logistics 1 provides strategic warehouse storage solutions in Colombo. Our facilities accommodate full container devanning, selective pallet racking, export cargo sorting, shrink-wrapping, and multi-supplier consolidation. Cargo is protected under 24/7 CCTV surveillance, comprehensive fire suppression, and strict electronic inventory entry logs.
                </p>

                <h3 style="font-size: 1.25rem; margin-top: 2rem; margin-bottom: 1rem;">Core Warehousing Capabilities</h3>
                <div class="grid-2-col" style="margin-bottom: 2rem;">
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Container Devanning &amp; Unstuffing</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Safe mechanized and manual unstuffing of 20ft and 40ft ocean shipping containers.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">LCL Export Consolidation</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Receiving cargo from multiple domestic factories and consolidating into dedicated export boxes.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Palletizing &amp; Shrink Wrapping</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Standard Euro and standard industrial palletization with stretch wrapping for sea transit.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Cross-Docking Dispatch</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Immediate cargo transfer from inbound ocean containers directly onto distribution trucks.</span>
                    </div>
                </div>

                <h3 style="font-size: 1.25rem; margin-top: 2rem; margin-bottom: 1rem;">Facility Security &amp; Environmental Standards</h3>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.75rem;">
                    <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9375rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-blue-industrial); font-size: 20px;">security</span>
                        <span>24/7 Security personnel and perimeter infrared CCTV recording.</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9375rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-blue-industrial); font-size: 20px;">detector_smoke</span>
                        <span>Multi-zone smoke detection, automatic sprinkler systems, and certified fire hydrants.</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9375rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-blue-industrial); font-size: 20px;">pest_control</span>
                        <span>Regular pest management and moisture control for export food and apparel safety.</span>
                    </li>
                </ul>
            </div>

            <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2rem; position: sticky; top: 100px;">
                <div style="font-size: 0.75rem; color: var(--color-blue-industrial); font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
                    STORAGE RESERVATIONS
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">Reserve Warehouse Space</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.5; margin-bottom: 1.5rem;">
                    Submit estimated pallet count, CBM volume, storage duration, and value-added requirements.
                </p>

                <a href="<?= url('quote.php') ?>?mode=sea&warehousing=1" class="btn btn-amber" style="width: 100%; text-align: center; margin-bottom: 1rem;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">warehouse</span>
                    Quote Warehousing
                </a>

                <div style="border-top: 1px solid var(--color-border-slate); padding-top: 1.25rem;">
                    <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--color-text-muted); margin-bottom: 0.5rem;">
                        WAREHOUSE DISPATCH DESK
                    </div>
                    <div style="font-size: 0.875rem; color: var(--color-midnight); font-weight: 600;">
                        <?= COMPANY_PHONE_PRIMARY ?><br>
                        <?= COMPANY_EMAIL ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
