<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Service Detail — Customs Brokerage & Port Clearance
 */

require_once __DIR__ . '/config/config.php';

$page_title = 'Customs Brokerage & Port Clearance';
$page_desc = 'Licensed Sri Lanka customs clearing agent handling ASYCUDA World electronic declarations, BOI entry documentation, and tariff classification.';

$breadcrumbs = [
    ['title' => 'Services', 'url' => 'services.php'],
    ['title' => 'Customs Brokerage', 'url' => 'service-customs-clearance.php']
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<section class="page-hero">
    <div class="page-hero-overlay" style="background-image: linear-gradient(90deg, rgba(0, 14, 31, 0.95) 0%, rgba(0, 14, 31, 0.85) 100%), url('<?= url('assets/images/services-customs.jpg') ?>');"></div>
    <div class="container">
        <div class="page-hero-content">
            <span class="technical-label amber" style="margin-bottom: 0.75rem;">
                <span class="material-symbols-outlined" style="font-size: 16px;">verified_user</span>
                LICENSED CLEARING AGENT &bull; SRI LANKA
            </span>
            <h1>Customs Brokerage &amp; Port Clearance</h1>
            <p>
                In-house licensed customs clearing services providing ASYCUDA World electronic declarations, BOI duty exemptions, and cargo gate release at Sri Lankan ports and airports.
            </p>
        </div>
    </div>
</section>

<section class="section-spacing bg-white">
    <div class="container">
        <div class="grid-split">
            <div>
                <span class="technical-label">REGULATORY COMPLIANCE</span>
                <h2 style="margin-top: 0.5rem; margin-bottom: 1.25rem;">
                    Eliminating Port Demurrage Through Pre-Arrival Electronic Clearance
                </h2>
                <p style="font-size: 1.0625rem; line-height: 1.6; color: var(--color-midnight); font-weight: 500;">
                    Spillburg Logistics 1 (Private) Limited is a licensed customs clearing agent in Sri Lanka. Our wharf clerks and licensed brokers maintain direct daily presence at Sri Lanka Customs headquarters, the Colombo port longroom, and airport cargo clearance terminals.
                </p>
                <p>
                    Customs clearance mistakes can result in heavy container demurrage, customs red-channel holds, and administrative penalties. We mitigate these risks through proactive pre-arrival review of commercial invoices, packing lists, and bills of lading. Our electronic connection to the Automated System for Customs Data (ASYCUDA World) allows us to lodge CusDec entries prior to vessel docking.
                </p>

                <h3 style="font-size: 1.25rem; margin-top: 2rem; margin-bottom: 1rem;">Core Customs Services</h3>
                <div class="grid-2-col" style="margin-bottom: 2rem;">
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">ASYCUDA World Declarations</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Direct electronic submission of CusDec documents and manifest verification.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Tariff &amp; HS Code Classification</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Accurate classification according to the Sri Lanka National Tariff schedule.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">BOI Duty Exemption Handling</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Managing customs processing for Board of Investment (BOI) approved enterprises.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">SLPA Gate Pass Release</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Expedited terminal payment processing and gate pass endorsement for container delivery.</span>
                    </div>
                </div>

                <h3 style="font-size: 1.25rem; margin-top: 2rem; margin-bottom: 1rem;">Document Clearance Checklist</h3>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.75rem;">
                    <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9375rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-success); font-size: 20px;">check_circle</span>
                        <span>Original Bill of Lading (OBL) or Express Sea Waybill / Air Waybill (AWB).</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9375rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-success); font-size: 20px;">check_circle</span>
                        <span>Commercial Invoice and Detailed Itemized Packing List.</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9375rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-success); font-size: 20px;">check_circle</span>
                        <span>Certificate of Origin (GSP / ISFTA / PSFTA / APTA) if preferential tariffs apply.</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9375rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-success); font-size: 20px;">check_circle</span>
                        <span>Import / Export Regulatory Permits (NMRA, SLSI, Plant Quarantine) if required.</span>
                    </li>
                </ul>
            </div>

            <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2rem; position: sticky; top: 100px;">
                <div style="font-size: 0.75rem; color: var(--color-blue-industrial); font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
                    CLEARING ASSISTANCE
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">Engage Customs Clearing Agent</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.5; margin-bottom: 1.5rem;">
                    Have an incoming consignment arriving at Colombo Port or Katunayake Airport? Contact our licensed customs brokerage team.
                </p>

                <a href="<?= url('quote.php') ?>?mode=sea&customs=1" class="btn btn-amber" style="width: 100%; text-align: center; margin-bottom: 1rem;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">verified_user</span>
                    Request Clearance Quote
                </a>

                <div style="border-top: 1px solid var(--color-border-slate); padding-top: 1.25rem;">
                    <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--color-text-muted); margin-bottom: 0.5rem;">
                        CUSTOMS WHARF DESK
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
