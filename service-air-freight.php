<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Service Detail — Air Cargo Coordination & Express Dispatch
 */

require_once __DIR__ . '/config/config.php';

$page_title = 'Air Cargo Coordination & Time-Critical Dispatch';
$page_desc = 'Expedited air freight and scheduled cargo flight allocations through Bandaranaike International Airport (CMB) by Spillburg Logistics 1.';

$breadcrumbs = [
    ['title' => 'Services', 'url' => 'services.php'],
    ['title' => 'Air Cargo Coordination', 'url' => 'service-air-freight.php']
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<section class="page-hero">
    <div class="page-hero-overlay" style="background-image: linear-gradient(90deg, rgba(0, 14, 31, 0.95) 0%, rgba(0, 14, 31, 0.85) 100%), url('<?= url('assets/images/services-air-freight.webp') ?>');"></div>
    <div class="container">
        <div class="page-hero-content">
            <span class="technical-label amber" style="margin-bottom: 0.75rem;">
                <span class="material-symbols-outlined" style="font-size: 16px;">flight_takeoff</span>
                AIRWAY FREIGHT &bull; IATA / CMB
            </span>
            <h1>Air Cargo Coordination &amp; Time-Critical Dispatch</h1>
            <p>
                Accelerated international airway solutions coordinating belly-hold and freighter aircraft capacity via Colombo Bandaranaike International Airport (CMB).
            </p>
        </div>
    </div>
</section>

<section class="section-spacing bg-white">
    <div class="container">
        <div class="grid-split">
            <div>
                <span class="technical-label">TIME-DEFINITE CARGO</span>
                <h2 style="margin-top: 0.5rem; margin-bottom: 1.25rem;">
                    When Cargo Deadlines Cannot Wait for Ocean Passage
                </h2>
                <p style="font-size: 1.0625rem; line-height: 1.6; color: var(--color-midnight); font-weight: 500;">
                    Spillburg Logistics 1 provides structured air cargo management designed for high-value consignments, fast-moving apparel trade samples, precision electronics, and urgent replacement machinery parts.
                </p>
                <p>
                    Through our relationships with international airlines serving Colombo (CMB), we secure scheduled main-deck and lower-deck space. Our air freight team manages export packaging compliance, airline airway bills (AWB), airport customs ramp clearances, and direct tarmac delivery coordination.
                </p>

                <h3 style="font-size: 1.25rem; margin-top: 2rem; margin-bottom: 1rem;">Core Air Freight Capabilities</h3>
                <div class="grid-2-col" style="margin-bottom: 2rem;">
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Direct Airline Bookings</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Direct flight bookings with guaranteed space allocation on passenger and freighter aircraft.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Air Consolidation Services</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Economical scheduled consolidations combining multiple shipments to major commercial gateways.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">DGR &amp; Hazardous Goods</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">IATA-compliant packing, labeling, and dangerous goods declarations.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Perishable &amp; Cold-Chain</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Rapid customs inspection and airport cold-storage handovers for perishables.</span>
                    </div>
                </div>

                <h3 style="font-size: 1.25rem; margin-top: 2rem; margin-bottom: 1rem;">Common Air Unit Load Devices (ULD)</h3>
                <div class="table-responsive">
                    <table class="logistics-table">
                        <thead>
                            <tr>
                                <th>ULD Type</th>
                                <th>Internal Volume</th>
                                <th>Max Gross Weight</th>
                                <th>Primary Aircraft</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>LD3 (AKE) Container</strong></td>
                                <td><span class="tabular">4.3 CBM</span></td>
                                <td><span class="tabular">1,588 kg</span></td>
                                <td>A330, A350, B777, B787 lower deck</td>
                            </tr>
                            <tr>
                                <td><strong>LD7 (PAG / P1P) Pallet</strong></td>
                                <td><span class="tabular">10.5 CBM</span></td>
                                <td><span class="tabular">4,626 kg</span></td>
                                <td>Wide-body passenger &amp; freighter lower deck</td>
                            </tr>
                            <tr>
                                <td><strong>PMC Pallet with Net</strong></td>
                                <td><span class="tabular">11.5 CBM</span></td>
                                <td><span class="tabular">6,804 kg</span></td>
                                <td>Main deck and lower deck wide-body</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2rem; position: sticky; top: 100px;">
                <div style="font-size: 0.75rem; color: var(--color-blue-industrial); font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
                    AIR CARGO TARIFFS
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">Request Air Cargo Rates</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.5; margin-bottom: 1.5rem;">
                    Provide shipment weight, carton dimensions, origin airport, and destination city to calculate chargeable volumetric weight.
                </p>

                <a href="<?= url('quote.php') ?>?mode=air" class="btn btn-amber" style="width: 100%; text-align: center; margin-bottom: 1rem;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">flight_takeoff</span>
                    Quote Air Cargo
                </a>

                <div style="border-top: 1px solid var(--color-border-slate); padding-top: 1.25rem;">
                    <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--color-text-muted); margin-bottom: 0.5rem;">
                        AIRWAY OPERATIONS DESK
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
