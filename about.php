<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * About Us — Corporate Identity & Operational Stature
 */

require_once __DIR__ . '/config/config.php';

$page_title = 'About Spillburg Logistics 1';
$page_desc = 'Discover Spillburg Logistics 1 (Private) Limited: our corporate focus, maritime logistics philosophy, licensed customs clearing capability, and strategic operations centered in Colombo, Sri Lanka.';

$breadcrumbs = [
    ['title' => 'About Us', 'url' => 'about.php']
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-overlay" style="background-image: linear-gradient(90deg, rgba(0, 14, 31, 0.95) 0%, rgba(0, 14, 31, 0.85) 100%), url('<?= url('assets/images/about-operations.jpg') ?>');"></div>
    <div class="container">
        <div class="page-hero-content">
            <span class="technical-label amber" style="margin-bottom: 0.75rem;">
                <span class="material-symbols-outlined" style="font-size: 16px;">corporate_fare</span>
                CORPORATE PROFILE
            </span>
            <h1>Spillburg Logistics 1 (Private) Limited</h1>
            <p>
                A dedicated freight-forwarding and customs clearing enterprise providing dependable cargo transportation solutions for commercial businesses worldwide.
            </p>
        </div>
    </div>
</section>

<!-- Company Introduction & Distinction -->
<section class="section-spacing bg-white">
    <div class="container">
        <div class="grid-split">
            <div>
                <span class="technical-label">
                    <span class="material-symbols-outlined" style="font-size: 16px;">verified</span>
                    Commercial Focus
                </span>
                <h2 style="margin-top: 0.5rem; margin-bottom: 1.25rem;">
                    Specialized Freight Movement for Global Commerce
                </h2>
                <p style="font-size: 1.0625rem; line-height: 1.6; color: var(--color-midnight); font-weight: 500;">
                    Within the Spillburg group of companies, Spillburg Logistics 1 is the dedicated operating arm responsible for physical cargo movement, freight forwarding, customs brokerage, and supply chain logistics.
                </p>
                <p>
                    While our sister companies focus on corporate consultancy and financial administration, Spillburg Logistics 1 is grounded in the operational reality of commercial sea ports, container terminals, air freight cargo ramps, and intermodal transport corridors.
                </p>
                <p>
                    From our headquarters in Colombo, Sri Lanka—at the heart of South Asia’s busiest maritime trade lanes—our operations desk coordinates import, export, and transshipment consignments with an uncompromising emphasis on schedule precision and regulatory compliance.
                </p>

                <div class="grid-2-col" style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--color-border-slate);">
                    <div>
                        <div style="font-size: 1.5rem; font-weight: 800; font-family: var(--font-mono); color: var(--color-blue-industrial);">
                            LICENSED
                        </div>
                        <div style="font-size: 0.8125rem; color: var(--color-text-secondary); text-transform: uppercase; font-weight: 600;">
                            Sri Lanka Customs Clearing Agent
                        </div>
                    </div>
                    <div>
                        <div style="font-size: 1.5rem; font-weight: 800; font-family: var(--font-mono); color: var(--color-blue-industrial);">
                            COLOMBO
                        </div>
                        <div style="font-size: 0.8125rem; color: var(--color-text-secondary); text-transform: uppercase; font-weight: 600;">
                            Strategic Transshipment Gateway
                        </div>
                    </div>
                </div>
            </div>

            <div style="position: relative;">
                <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--color-border-slate); box-shadow: var(--shadow-card);">
                    <img src="<?= url('assets/images/about-operations.jpg') ?>" alt="Spillburg Logistics Operations Room" style="width: 100%; height: auto;" loading="lazy">
                </div>
                <div style="position: absolute; bottom: -1rem; right: -1rem; background-color: var(--color-navy-container); color: #FFFFFF; padding: 1.25rem; border-radius: var(--radius-sm); border: 1px solid rgba(255, 255, 255, 0.15); max-width: 240px; box-shadow: var(--shadow-elevated);">
                    <div style="font-size: 0.75rem; color: var(--color-amber-accent); font-family: var(--font-mono); font-weight: 700;">
                        OPERATIONS DESK
                    </div>
                    <div style="font-size: 0.875rem; font-weight: 600; line-height: 1.4; margin-top: 0.25rem;">
                        Continuous container and transit coordination across Sri Lankan ports.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Operating Principles -->
<section class="section-spacing bg-surface">
    <div class="container">
        <div style="text-align: center; max-width: 760px; margin-left: auto; margin-right: auto; margin-bottom: 3.5rem;">
            <span class="technical-label">
                <span class="material-symbols-outlined" style="font-size: 16px;">gavel</span>
                OPERATIONAL RIGOR
            </span>
            <h2 style="margin-top: 0.5rem;">Our Service Philosophy</h2>
            <p>
                International freight logistics requires methodical planning, uncompromising compliance, and active communication at every milestone.
            </p>
        </div>

        <div class="grid-3-col">
            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2.25rem;">
                <div style="width: 44px; height: 44px; background-color: var(--color-blue-light); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;">
                    <span class="material-symbols-outlined" style="color: var(--color-blue-industrial);">task_alt</span>
                </div>
                <h3 style="font-size: 1.1875rem; margin-bottom: 0.75rem;">Regulatory &amp; Customs Accuracy</h3>
                <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6;">
                    We operate with full compliance to Sri Lanka Customs standards, Automated ASYCUDA World declarations, and international Incoterms. Documentation accuracy protects shippers from clearance holds and administrative penalties.
                </p>
            </div>

            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2.25rem;">
                <div style="width: 44px; height: 44px; background-color: var(--color-blue-light); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;">
                    <span class="material-symbols-outlined" style="color: var(--color-blue-industrial);">hub</span>
                </div>
                <h3 style="font-size: 1.1875rem; margin-bottom: 0.75rem;">Multi-Modal Flexibility</h3>
                <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6;">
                    Whether optimizing ocean container transit times, booking chartered air freight for critical dispatch, or mobilizing heavy hydraulic prime movers for oversized cargo, we coordinate across transport modes to meet commercial deadlines.
                </p>
            </div>

            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2.25rem;">
                <div style="width: 44px; height: 44px; background-color: var(--color-blue-light); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;">
                    <span class="material-symbols-outlined" style="color: var(--color-blue-industrial);">handshake</span>
                </div>
                <h3 style="font-size: 1.1875rem; margin-bottom: 0.75rem;">Client-Centric Accountability</h3>
                <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6;">
                    We believe in direct relationships without unmonitored ticket queues. Clients receive prompt communication, verified bills of lading, and immediate operational intervention when port or sea transit conditions fluctuate.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Verified Operational Headquarters -->
<section class="section-spacing bg-white">
    <div class="container">
        <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: clamp(1.5rem, 4vw, 3rem);">
            <div class="grid-split">
                <div>
                    <span class="technical-label">
                        <span class="material-symbols-outlined" style="font-size: 16px;">pin_drop</span>
                        Physical Operations Base
                    </span>
                    <h2 style="margin-top: 0.5rem; margin-bottom: 1.25rem;">
                        Strategically Headquartered in Colombo
                    </h2>
                    <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.5rem;">
                        Our principal office is located at the Cinnamon Lakeside Hotel complex in central Colombo 02, placing our dispatch coordinators within minutes of the Sri Lanka Ports Authority, Colombo container terminal gates, and the customs longroom.
                    </p>

                    <div style="display: flex; flex-direction: column; gap: 1rem; border-top: 1px solid var(--color-border-slate); padding-top: 1.5rem;">
                        <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <span class="material-symbols-outlined" style="color: var(--color-blue-industrial);">location_city</span>
                            <div>
                                <strong>Physical Address:</strong><br>
                                <?= COMPANY_FULL_ADDRESS ?>
                            </div>
                        </div>
                        <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <span class="material-symbols-outlined" style="color: var(--color-blue-industrial);">support_agent</span>
                            <div>
                                <strong>Direct Logistics Hotlines:</strong><br>
                                <?= COMPANY_PHONE_PRIMARY ?> &bull; <?= COMPANY_PHONE_OPS_1 ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background-color: var(--color-navy-container); color: #FFFFFF; border-radius: var(--radius-md); padding: 2.25rem;">
                    <div style="font-size: 0.75rem; color: var(--color-amber-accent); font-family: var(--font-mono); font-weight: 700; margin-bottom: 0.5rem;">
                        CORPORATE INTEGRATION
                    </div>
                    <h3 style="color: #FFFFFF; font-size: 1.25rem; margin-bottom: 1rem;">
                        Part of an Approved Corporate Group
                    </h3>
                    <p style="color: #CBD5E1; font-size: 0.875rem; line-height: 1.6; margin-bottom: 1.5rem;">
                        As an operating entity within the Spillburg family of businesses, Spillburg Logistics 1 maintains the high standard of governance, fiscal transparency, and commercial integrity demanded by our parent leadership.
                    </p>
                    <a href="<?= url('contact.php') ?>" class="btn btn-amber" style="width: 100%; text-align: center;">
                        Contact Our Colombo Office &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
