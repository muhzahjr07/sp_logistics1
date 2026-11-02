<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Service Detail — Inland Road Transport & Container Drayage
 */

require_once __DIR__ . '/config/config.php';

$page_title = 'Inland Road Transport & Container Drayage';
$page_desc = 'Island-wide container prime mover haulage, skeletal trailer transport, and port-to-factory drayage in Sri Lanka by Spillburg Logistics 1.';

$breadcrumbs = [
    ['title' => 'Services', 'url' => 'services.php'],
    ['title' => 'Inland Road Transport', 'url' => 'service-road-freight.php']
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<section class="page-hero">
    <div class="page-hero-overlay" style="background-image: linear-gradient(90deg, rgba(0, 14, 31, 0.95) 0%, rgba(0, 14, 31, 0.85) 100%), url('<?= url('assets/images/services-road-freight.webp') ?>');"></div>
    <div class="container">
        <div class="page-hero-content">
            <span class="technical-label amber" style="margin-bottom: 0.75rem;">
                <span class="material-symbols-outlined" style="font-size: 16px;">local_shipping</span>
                INLAND TRANSPORT &bull; HAULAGE
            </span>
            <h1>Inland Road Transport &amp; Container Drayage</h1>
            <p>
                Connecting Sri Lanka’s commercial ports and manufacturing zones through reliable prime movers, multi-axle skeletal chassis, and secure point-to-point road dispatch.
            </p>
        </div>
    </div>
</section>

<section class="section-spacing bg-white">
    <div class="container">
        <div class="grid-split">
            <div>
                <span class="technical-label">TERRESTRIAL CORRIDOR</span>
                <h2 style="margin-top: 0.5rem; margin-bottom: 1.25rem;">
                    Connecting the Port of Colombo with Every Industrial Zone
                </h2>
                <p style="font-size: 1.0625rem; line-height: 1.6; color: var(--color-midnight); font-weight: 500;">
                    International cargo movement does not end at the quay wall. The terrestrial leg of any shipment is essential to meeting production deadlines and factory loading schedules.
                </p>
                <p>
                    Spillburg Logistics 1 operates dedicated road transport assets covering primary industrial corridors across Sri Lanka, including Biyagama, Katunayake, Mirigama, Koggala, and inland export processing zones. Our container prime movers and skeletal chassis haul 20ft, 40ft, and 45ft shipping containers directly between terminal gates and factory bays with strict driver adherence to road safety and cargo integrity.
                </p>

                <h3 style="font-size: 1.25rem; margin-top: 2rem; margin-bottom: 1rem;">Core Road Transport Capabilities</h3>
                <div class="grid-2-col" style="margin-bottom: 2rem;">
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Port Container Drayage</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Direct container pickup from CICT, JCT, and SAGT terminals upon customs gate pass release.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Factory Door Deliveries</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Timed delivery directly to client factory loading docks across Western and Southern provinces.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Export Box Positioning</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Empty container positioning from ocean carrier depot to factory for stuffing and sealing.</span>
                    </div>
                    <div style="background-color: var(--color-surface-bg); padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border-slate);">
                        <strong style="color: var(--color-midnight); display: block; margin-bottom: 0.25rem;">Multi-Axle Heavy Trailers</strong>
                        <span style="font-size: 0.875rem; color: var(--color-text-secondary);">Heavy-duty skeletal trailers rated for high-density heavy containers up to 32 MT.</span>
                    </div>
                </div>

                <h3 style="font-size: 1.25rem; margin-top: 2rem; margin-bottom: 1rem;">Primary Transit Corridors</h3>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.75rem;">
                    <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9375rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-blue-industrial); font-size: 20px;">route</span>
                        <span><strong>Colombo Port &harr; Katunayake Free Trade Zone (FTZ):</strong> Expressway express corridor via E03.</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9375rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-blue-industrial); font-size: 20px;">route</span>
                        <span><strong>Colombo Port &harr; Biyagama Export Processing Zone (EPZ):</strong> Direct industrial arterial transport.</span>
                    </li>
                    <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9375rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-blue-industrial); font-size: 20px;">route</span>
                        <span><strong>Colombo Port &harr; Southern Industrial Belt (Galle / Koggala):</strong> Southern Expressway transit via E01.</span>
                    </li>
                </ul>
            </div>

            <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2rem; position: sticky; top: 100px;">
                <div style="font-size: 0.75rem; color: var(--color-blue-industrial); font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">
                    TERRESTRIAL RATES
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">Request Inland Haulage</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.5; margin-bottom: 1.5rem;">
                    Specify container size (20ft / 40ft), port terminal, factory drop-off location, and scheduled loading date.
                </p>

                <a href="<?= url('quote.php') ?>?mode=road" class="btn btn-amber" style="width: 100%; text-align: center; margin-bottom: 1rem;">
                    <span class="material-symbols-outlined" style="font-size: 18px;">local_shipping</span>
                    Quote Road Transport
                </a>

                <div style="border-top: 1px solid var(--color-border-slate); padding-top: 1.25rem;">
                    <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--color-text-muted); margin-bottom: 0.5rem;">
                        TRANSPORT DISPATCH DESK
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
