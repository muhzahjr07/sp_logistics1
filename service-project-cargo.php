<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Service Detail — Project Cargo & Heavy Lift Logistics
 */

require_once __DIR__ . '/config/config.php';

$page_title = 'Project Cargo & Heavy Lift Logistics';
$page_desc = 'Engineered transport for Out-of-Gauge (OOG), heavy industrial machinery, and infrastructure project cargo in Sri Lanka by Spillburg Logistics 1.';

$breadcrumbs = [
    ['title' => 'Services', 'url' => 'services.php'],
    ['title' => 'Project Cargo Logistics', 'url' => 'service-project-cargo.php']
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<section class="page-hero">
    <div class="page-hero-overlay" style="background-image: linear-gradient(90deg, rgba(0, 14, 31, 0.95) 0%, rgba(0, 14, 31, 0.85) 100%), url('<?= url('assets/images/services-project-cargo.webp') ?>');"></div>
    <div class="container">
        <div class="page-hero-content">
            <span class="technical-label amber" style="margin-bottom: 0.75rem;">
                <span class="material-symbols-outlined" style="font-size: 16px;">precision_manufacturing</span>
                ENGINEERED LOGISTICS &bull; OOG
            </span>
            <h1>Project Cargo &amp; Heavy Lift Logistics</h1>
            <p>
                Specialized transportation planning for out-of-gauge (OOG) machinery, transformers, power plant components, and oversized industrial assets.
            </p>
        </div>
    </div>
</section>

<section class="section-spacing bg-white">
    <div class="container">
        <div class="grid-split">
            <div>
                <span class="technical-label">SPECIALIZED HEAVY LIFT</span>
                <h2 style="margin-top: 0.5rem; margin-bottom: 1.25rem;">
                    Precision Engineering for Oversized &amp; High-Tonnage Cargo
                </h2>
                <p style="font-size: 1.0625rem; line-height: 1.6; color: var(--color-midnight); font-weight: 500;">
                    When cargo exceeds standard container dimensions and weight limits, conventional logistics fails. Project cargo requires rigorous pre-planning, route engineering, and heavy mechanical assets.
                </p>
                <p>
                    Spillburg Logistics 1 coordinates complex project moves through the Port of Colombo and Hambantota International Port. We handle flat-rack and open-top ocean bookings, heavy-lift quayside crane discharge, route clearance with municipal authorities, and multi-axle modular hydraulic trailer transport to remote job sites across Sri Lanka.
                </p>

                <h3 style="font-size: 1.25rem; margin-top: 2rem; margin-bottom: 1rem;">Project Cargo Protocols</h3>
                <div class="grid-2-col" style="margin-bottom: 2rem;">
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Engineering Route Surveys</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Physical assessment of bridge tonnage capacities, road gradients, and overhead cable clearances.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Multi-Axle Modular Transporters</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Hydraulic platform trailers capable of distributing loads exceeding 100 metric tons.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Quayside Rigging &amp; Stevedoring</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Experienced rigging supervisors overseeing tandem mobile crane lifts directly from vessel holds.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Authority &amp; Police Clearance</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Securing permits from the Road Development Authority (RDA) and Sri Lanka Police escort details.</span>
                    </div>
                </div>

                <h3 style="font-size: 1.25rem; margin-top: 2rem; margin-bottom: 1rem;">Typical Project Cargo Commodities</h3>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.75rem;">
                    <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9375rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-blue-industrial); font-size: 20px;">bolt</span>
                        <span>Power Generation &amp; Transformers (Substation components, wind turbine blades).</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9375rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-blue-industrial); font-size: 20px;">foundation</span>
                        <span>Heavy Construction &amp; Earthmoving (Tunnel boring machines, crawler cranes, piling rigs).</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9375rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-blue-industrial); font-size: 20px;">factory</span>
                        <span>Industrial Manufacturing Plants (Cement kiln cylinders, brewery fermentation tanks).</span>
                    </li>
                </ul>
            </div>

            <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2rem; position: sticky; top: 100px;">
                <div style="font-size: 0.75rem; color: var(--color-blue-industrial); font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
                    PROJECT ESTIMATION
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">Project Cargo Feasibility</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.5; margin-bottom: 1.5rem;">
                    Submit equipment technical drawings, center of gravity (CoG), dimensions (L x W x H), and total tonnage for an operational feasibility evaluation.
                </p>

                <a href="<?= url('quote.php') ?>?mode=project" class="btn btn-amber" style="width: 100%; text-align: center; margin-bottom: 1rem;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">precision_manufacturing</span>
                    Quote Project Cargo
                </a>

                <div style="border-top: 1px solid var(--color-border-slate); padding-top: 1.25rem;">
                    <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--color-text-muted); margin-bottom: 0.5rem;">
                        HEAVY LIFT DESK
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
