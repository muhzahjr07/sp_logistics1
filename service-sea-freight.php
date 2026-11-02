<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Service Detail — Ocean Freight Forwarding & Transshipment
 */

require_once __DIR__ . '/config/config.php';

$page_title = 'Sea Freight Forwarding & Transshipment';
$page_desc = 'Full Container Load (FCL) and Less than Container Load (LCL) ocean freight forwarding through the Port of Colombo transshipment hub by Spillburg Logistics 1.';

$breadcrumbs = [
    ['title' => 'Services', 'url' => 'services.php'],
    ['title' => 'Sea Freight Forwarding', 'url' => 'service-sea-freight.php']
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<section class="page-hero">
    <div class="page-hero-overlay" style="background-image: linear-gradient(90deg, rgba(0, 14, 31, 0.95) 0%, rgba(0, 14, 31, 0.85) 100%), url('<?= url('assets/images/services-ocean-freight.webp') ?>');"></div>
    <div class="container">
        <div class="page-hero-content">
            <span class="technical-label amber" style="margin-bottom: 0.75rem;">
                <span class="material-symbols-outlined" style="font-size: 16px;">directions_boat</span>
                OCEAN FREIGHT &bull; FCL / LCL
            </span>
            <h1>Sea Freight Forwarding &amp; Transshipment</h1>
            <p>
                Structured ocean container transport leveraging Colombo’s deep-draft container terminals (CICT, JCT, SAGT) to connect Sri Lankan and regional trade to global liner networks.
            </p>
        </div>
    </div>
</section>

<section class="section-spacing bg-white">
    <div class="container">
        <div class="grid-split">
            <div>
                <span class="technical-label">SERVICE OVERVIEW</span>
                <h2 style="margin-top: 0.5rem; margin-bottom: 1.25rem;">
                    Dependable Ocean Transit Across Major Maritime Lanes
                </h2>
                <p style="font-size: 1.0625rem; line-height: 1.6; color: var(--color-midnight); font-weight: 500;">
                    As a dedicated logistics provider headquartered in Colombo, Spillburg Logistics 1 coordinates ocean freight consignments with leading global ocean carriers.
                </p>
                <p>
                    We manage container equipment bookings, sea waybills, original ocean bills of lading, and port terminal gate moves. Whether your cargo requires a standard 20ft general container, high-cube 40ft units for garment exports, or refrigerated containers (reefers) for perishable goods, our team ensures space protection during peak liner cycles.
                </p>

                <h3 style="font-size: 1.25rem; margin-top: 2rem; margin-bottom: 1rem;">Core Sea Freight Capabilities</h3>
                <div class="grid-2-col" style="margin-bottom: 2rem;">
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Full Container Load (FCL)</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Direct container allocations (20' GP, 40' GP, 40' HC) from Colombo to worldwide destination ports.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Less than Container Load (LCL)</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Consolidation services for smaller consignments via Colombo CFS staging depots.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Reefer Container Services</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Continuous temperature and humidity data monitoring for cold-chain commodities.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Transshipment Hub Handling</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Fast feeder transfers between Indian sub-continent ports and mother vessels at Colombo.</span>
                    </div>
                </div>

                <h3 style="font-size: 1.25rem; margin-top: 2rem; margin-bottom: 1rem;">Typical Container Specifications</h3>
                <div class="table-responsive">
                    <table class="logistics-table">
                        <thead>
                            <tr>
                                <th>Container Type</th>
                                <th>Internal Volume</th>
                                <th>Max Payload</th>
                                <th>Primary Application</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>20' Standard GP</strong></td>
                                <td><span class="tabular">33.2 CBM</span></td>
                                <td><span class="tabular">25,000 kg</span></td>
                                <td>Dense commodities, machinery, minerals</td>
                            </tr>
                            <tr>
                                <td><strong>40' Standard GP</strong></td>
                                <td><span class="tabular">67.7 CBM</span></td>
                                <td><span class="tabular">26,500 kg</span></td>
                                <td>General cargo, consumer goods</td>
                            </tr>
                            <tr>
                                <td><strong>40' High Cube (HC)</strong></td>
                                <td><span class="tabular">76.4 CBM</span></td>
                                <td><span class="tabular">26,300 kg</span></td>
                                <td>Apparel, bulky light cargo, furniture</td>
                            </tr>
                            <tr>
                                <td><strong>40' Reefer</strong></td>
                                <td><span class="tabular">67.5 CBM</span></td>
                                <td><span class="tabular">29,400 kg</span></td>
                                <td>Seafood, fruits, pharmaceuticals (-30°C to +30°C)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Sidebar Quick Inquiry -->
            <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2rem; position: sticky; top: 100px;">
                <div style="font-size: 0.75rem; color: var(--color-blue-industrial); font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
                    OCEAN FREIGHT PRICING
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">Request Ocean Freight Rate</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.5; margin-bottom: 1.5rem;">
                    Submit your port pairs (POL / POD), container count, and target sailing date to our sea freight desk.
                </p>

                <a href="<?= url('quote.php') ?>?mode=sea" class="btn btn-amber" style="width: 100%; text-align: center; margin-bottom: 1rem;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">request_quote</span>
                    Quote Ocean Freight
                </a>

                <div style="border-top: 1px solid var(--color-border-slate); padding-top: 1.25rem;">
                    <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--color-text-muted); margin-bottom: 0.5rem;">
                        COLOMBO PORT DESK
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
