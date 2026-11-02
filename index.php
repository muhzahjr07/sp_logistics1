<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Homepage — Primary Commercial & Operational Landing
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

$page_title = 'Moving Cargo. Connecting Businesses.';
$page_desc = 'Spillburg Logistics 1 (Private) Limited provides international ocean freight forwarding, air cargo coordination, inland drayage, customs clearance, and warehousing from the Port of Colombo transshipment hub.';

// Fetch latest active port advisories
try {
    $db = Database::getConnection();
    $stmt = $db->query("SELECT * FROM news WHERE is_published = 1 ORDER BY published_date DESC LIMIT 3");
    $advisories = $stmt->fetchAll();
} catch (Exception $e) {
    $advisories = [];
}

require_once __DIR__ . '/includes/header.php';
?>

<!-- Section 1: Hero Viewport -->
<section class="hero-section">
    <div class="hero-bg-overlay"></div>
    <div class="container">
        <div class="hero-grid">
            <div class="hero-text-col">
                <div class="hero-badge">
                    <span class="material-symbols-outlined" style="font-size: 16px;">anchor</span>
                    South Asia Transshipment Gateway &bull; Colombo
                </div>
                <h1 class="hero-title">
                    Moving Cargo.<br>Connecting Businesses.
                </h1>
                <p class="hero-lead">
                    Spillburg Logistics 1 delivers disciplined multi-modal transportation, licensed Sri Lanka customs clearing, and containerized supply chain coordination for global commerce.
                </p>
                <div class="hero-actions">
                    <a href="<?= url('quote.php') ?>" class="btn btn-amber btn-lg">
                        <span class="material-symbols-outlined">request_quote</span>
                        Request a Freight Quote
                    </a>
                    <a href="<?= url('services.php') ?>" class="btn btn-outline-white btn-lg">
                        <span class="material-symbols-outlined">explore</span>
                        Explore Logistics Services
                    </a>
                </div>

                <!-- Strategic Hub Metrics Strip -->
                <div class="hero-metrics-strip">
                    <div class="hero-metric-card">
                        <span class="hero-metric-val tabular">100%</span>
                        <span class="hero-metric-label">Customs Pre-Clearance</span>
                    </div>
                    <div class="hero-metric-card">
                        <span class="hero-metric-val tabular">24 / 7</span>
                        <span class="hero-metric-label">Port Gate Turnaround</span>
                    </div>
                    <div class="hero-metric-card">
                        <span class="hero-metric-val tabular">FCL &bull; LCL</span>
                        <span class="hero-metric-label">Intermodal Coverage</span>
                    </div>
                </div>
            </div>

            <!-- Hero Operations Quick Card -->
            <div class="hero-quick-card">
                <div class="hero-card-header">
                    <div>
                        <div class="hero-card-title">Intermodal Transit Corridor</div>
                        <div style="font-size: 0.75rem; color: #94A3B8; font-family: var(--font-mono);">TRANS-INDIAN OCEAN SEA LANES</div>
                    </div>
                    <span class="badge badge-cleared">ACTIVE ROUTE</span>
                </div>

                <div class="hero-route-steps">
                    <div class="route-step-item">
                        <div class="step-node">01</div>
                        <div class="step-details">
                            <h4>Origin Port / CFS Dispatch</h4>
                            <p>Cargo pickup, consolidation, and export customs clearance documentation at source terminal.</p>
                        </div>
                    </div>
                    <div class="route-step-item">
                        <div class="step-node">02</div>
                        <div class="step-details">
                            <h4>Port of Colombo Transshipment Hub</h4>
                            <p>Direct deep-water berth operations at CICT / JCT terminals with minimal dwell intervals.</p>
                        </div>
                    </div>
                    <div class="route-step-item">
                        <div class="step-node">03</div>
                        <div class="step-details">
                            <h4>Inland Drayage &amp; Door Delivery</h4>
                            <p>Dedicated prime mover road transport to factory floor or bonded staging facility.</p>
                        </div>
                    </div>
                </div>

                <div style="background-color: rgba(0, 14, 31, 0.4); border: 1px solid rgba(255, 255, 255, 0.08); padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 1.25rem;">
                    <div style="font-size: 0.75rem; color: var(--color-amber-accent); font-weight: 700; text-transform: uppercase; margin-bottom: 0.25rem;">
                        Need Immediate Cargo Booking?
                    </div>
                    <div style="font-size: 0.8125rem; color: #E2E8F0;">
                        Direct operations dispatch desk available for container availability &amp; ocean schedules:
                    </div>
                    <div style="margin-top: 0.5rem; font-family: var(--font-mono); font-weight: 700; color: #FFFFFF;">
                        <?= COMPANY_PHONE_PRIMARY ?>
                    </div>
                </div>

                <a href="<?= url('quote.php') ?>" class="btn btn-primary" style="width: 100%;">
                    Submit Cargo Specifications &rarr;
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Section 2: Structured Freight Services Overview -->
<section class="section-spacing bg-surface">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 3rem;">
            <div>
                <span class="technical-label">
                    <span class="material-symbols-outlined" style="font-size: 16px;">hub</span>
                    Operational Capabilities
                </span>
                <h2 style="margin-top: 0.5rem;">Structured Freight Services</h2>
                <p style="max-width: 600px; margin-top: 0.5rem;">
                    Engineered for precision freight movement across maritime, aerial, and land transport networks with total regulatory compliance.
                </p>
            </div>
            <a href="<?= url('services.php') ?>" class="btn btn-secondary">
                View Capabilities Matrix &rarr;
            </a>
        </div>

        <div class="cards-grid-3">
            <!-- 1. Sea Freight -->
            <article class="service-card">
                <div class="service-card-media">
                    <img src="<?= url('assets/images/services-ocean-freight.webp') ?>" alt="Ocean Freight Forwarding" class="service-card-img" loading="lazy">
                    <span class="service-badge">FCL &bull; LCL OCEAN</span>
                </div>
                <div class="service-card-body">
                    <h3 class="service-card-title">Sea Freight Forwarding</h3>
                    <p class="service-card-text">
                        Full Container Load (FCL) and Less than Container Load (LCL) consolidation connecting Sri Lanka to major global maritime trade lanes via Colombo deep-water berths.
                    </p>
                    <ul class="service-specs-list">
                        <li><span class="spec-bullet">&bull;</span> Liner booking &amp; container allocation</li>
                        <li><span class="spec-bullet">&bull;</span> Transshipment handling at CICT / JCT</li>
                        <li><span class="spec-bullet">&bull;</span> Reefer &amp; temperature-controlled stowage</li>
                    </ul>
                    <div class="service-card-footer">
                        <a href="<?= url('service-sea-freight.php') ?>" class="card-link">
                            Service Details <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
                        </a>
                        <span class="technical-label">ROUTE SPEC</span>
                    </div>
                </div>
            </article>

            <!-- 2. Air Cargo -->
            <article class="service-card">
                <div class="service-card-media">
                    <img src="<?= url('assets/images/services-air-freight.webp') ?>" alt="Air Cargo Coordination" class="service-card-img" loading="lazy">
                    <span class="service-badge">IATA &bull; EXPRESS</span>
                </div>
                <div class="service-card-body">
                    <h3 class="service-card-title">Air Cargo Coordination</h3>
                    <p class="service-card-text">
                        High-priority scheduled air freight coordination through Bandaranaike International Airport (CMB) for time-critical, high-value, and perishable consignments.
                    </p>
                    <ul class="service-specs-list">
                        <li><span class="spec-bullet">&bull;</span> Direct airline charter &amp; consolidation</li>
                        <li><span class="spec-bullet">&bull;</span> Dangerous goods (DGR) compliance handling</li>
                        <li><span class="spec-bullet">&bull;</span> Airport ramp &amp; tarmac expedited transfer</li>
                    </ul>
                    <div class="service-card-footer">
                        <a href="<?= url('service-air-freight.php') ?>" class="card-link">
                            Service Details <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
                        </a>
                        <span class="technical-label">TIME-CRITICAL</span>
                    </div>
                </div>
            </article>

            <!-- 3. Road Haulage -->
            <article class="service-card">
                <div class="service-card-media">
                    <img src="<?= url('assets/images/services-road-freight.webp') ?>" alt="Inland Road Transport" class="service-card-img" loading="lazy">
                    <span class="service-badge">INLAND DRAYAGE</span>
                </div>
                <div class="service-card-body">
                    <h3 class="service-card-title">Inland Road Transport</h3>
                    <p class="service-card-text">
                        Modern container prime movers and multi-axle trailers providing reliable port-to-factory container drayage and island-wide distribution across Sri Lanka.
                    </p>
                    <ul class="service-specs-list">
                        <li><span class="spec-bullet">&bull;</span> 20ft &amp; 40ft high-cube chassis fleet</li>
                        <li><span class="spec-bullet">&bull;</span> Real-time GPS journey tracking</li>
                        <li><span class="spec-bullet">&bull;</span> BOI export zone direct factory dispatch</li>
                    </ul>
                    <div class="service-card-footer">
                        <a href="<?= url('service-road-freight.php') ?>" class="card-link">
                            Service Details <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
                        </a>
                        <span class="technical-label">NATIONWIDE</span>
                    </div>
                </div>
            </article>

            <!-- 4. Project Cargo -->
            <article class="service-card">
                <div class="service-card-media">
                    <img src="<?= url('assets/images/services-project-cargo.webp') ?>" alt="Project Cargo and Heavy Lift" class="service-card-img" loading="lazy">
                    <span class="service-badge">OOG &bull; HEAVY LIFT</span>
                </div>
                <div class="service-card-body">
                    <h3 class="service-card-title">Project Cargo &amp; Heavy Lift</h3>
                    <p class="service-card-text">
                        Engineered transport solutions for out-of-gauge (OOG) industrial equipment, electrical transformers, construction plant, and oversized project shipments.
                    </p>
                    <ul class="service-specs-list">
                        <li><span class="spec-bullet">&bull;</span> Route survey &amp; bridge load clearance</li>
                        <li><span class="spec-bullet">&bull;</span> Hydraulic multi-axle modular trailers</li>
                        <li><span class="spec-bullet">&bull;</span> Specialized rigging &amp; crane operations</li>
                    </ul>
                    <div class="service-card-footer">
                        <a href="<?= url('service-project-cargo.php') ?>" class="card-link">
                            Service Details <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
                        </a>
                        <span class="technical-label">ENGINEERED</span>
                    </div>
                </div>
            </article>

            <!-- 5. Customs Clearance -->
            <article class="service-card">
                <div class="service-card-media">
                    <img src="<?= url('assets/images/services-customs.jpg') ?>" alt="Customs Brokerage and Compliance" class="service-card-img" loading="lazy">
                    <span class="service-badge">LICENSED BROKER</span>
                </div>
                <div class="service-card-body">
                    <h3 class="service-card-title">Customs Brokerage &amp; Clearance</h3>
                    <p class="service-card-text">
                        Licensed in-house customs brokerage executing electronic ASYCUDA declarations, tariff code classification, and Board of Investment (BOI) duty documentation.
                    </p>
                    <ul class="service-specs-list">
                        <li><span class="spec-bullet">&bull;</span> Pre-arrival document verification</li>
                        <li><span class="spec-bullet">&bull;</span> HS code tariff determination &amp; audit</li>
                        <li><span class="spec-bullet">&bull;</span> SLPA port gate pass release handling</li>
                    </ul>
                    <div class="service-card-footer">
                        <a href="<?= url('service-customs-clearance.php') ?>" class="card-link">
                            Service Details <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
                        </a>
                        <span class="technical-label">COMPLIANT</span>
                    </div>
                </div>
            </article>

            <!-- 6. Warehousing & Staging -->
            <article class="service-card">
                <div class="service-card-media">
                    <img src="<?= url('assets/images/services-warehousing.jpg') ?>" alt="Warehousing and Inventory Staging" class="service-card-img" loading="lazy">
                    <span class="service-badge">BONDED STAGING</span>
                </div>
                <div class="service-card-body">
                    <h3 class="service-card-title">Warehousing &amp; Cargo Staging</h3>
                    <p class="service-card-text">
                        Secure bonded and dry storage spaces in strategic Colombo proximity for export consolidation, palletizing, cargo inspection, and buffer inventory management.
                    </p>
                    <ul class="service-specs-list">
                        <li><span class="spec-bullet">&bull;</span> Container devanning &amp; palletization</li>
                        <li><span class="spec-bullet">&bull;</span> CCTV-monitored, access-controlled security</li>
                        <li><span class="spec-bullet">&bull;</span> Cross-docking for fast intermodal transfer</li>
                    </ul>
                    <div class="service-card-footer">
                        <a href="<?= url('service-warehousing.php') ?>" class="card-link">
                            Service Details <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
                        </a>
                        <span class="technical-label">SECURE</span>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Section 3: Built on Execution Precision (Value Propositions) -->
<section class="section-spacing bg-white">
    <div class="container">
        <div style="text-align: center; max-width: 760px; margin-left: auto; margin-right: auto; margin-bottom: 3.5rem;">
            <span class="technical-label">
                <span class="material-symbols-outlined" style="font-size: 16px;">verified</span>
                Institutional Integrity
            </span>
            <h2 style="margin-top: 0.5rem;">Built on Execution Precision</h2>
            <p>
                In international logistics, reliability is not a marketing phrase—it is measured in verified bills of lading, customs clearance speed, container turnaround, and cargo security.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 2rem;">
            <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2rem;">
                <div style="width: 44px; height: 44px; background-color: var(--color-blue-light); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;">
                    <span class="material-symbols-outlined" style="color: var(--color-blue-industrial);">schedule</span>
                </div>
                <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">On-Time Port Execution</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.55;">
                    Rigorous transit scheduling aligned with ocean liner cut-off times and airline loading schedules to eliminate rolled cargo and detention charges.
                </p>
            </div>

            <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2rem;">
                <div style="width: 44px; height: 44px; background-color: var(--color-blue-light); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;">
                    <span class="material-symbols-outlined" style="color: var(--color-blue-industrial);">visibility</span>
                </div>
                <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Transparent Multi-Leg Info</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.55;">
                    Clear milestone notifications across origin collection, port gate entry, customs assessment, ocean passage, and final destination handover.
                </p>
            </div>

            <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2rem;">
                <div style="width: 44px; height: 44px; background-color: var(--color-blue-light); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;">
                    <span class="material-symbols-outlined" style="color: var(--color-blue-industrial);">anchor</span>
                </div>
                <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Colombo Port Leverage</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.55;">
                    Direct physical presence at Colombo port terminals allowing immediate resolution of inspection calls, terminal holds, and documentation releases.
                </p>
            </div>

            <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2rem;">
                <div style="width: 44px; height: 44px; background-color: var(--color-blue-light); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem;">
                    <span class="material-symbols-outlined" style="color: var(--color-blue-industrial);">gavel</span>
                </div>
                <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Customs &amp; Tariffs Integrity</h3>
                <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.55;">
                    Accurate classification under the Harmonized System (HS) preventing costly fiscal penalties, customs delays, or clearance rejections.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Section 4: Multimodal 5-Step Process Section -->
<section class="section-spacing bg-surface">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <span class="technical-label">
                    <span class="material-symbols-outlined" style="font-size: 16px;">conversion_path</span>
                    Standard Operating Procedure
                </span>
                <h2 style="margin-top: 0.5rem;">Our Structured Five-Step Process</h2>
                <p style="max-width: 620px; margin-top: 0.5rem;">
                    Every consignment handled by Spillburg Logistics 1 follows a defined, traceable protocol from initial specification to final delivery docket.
                </p>
            </div>
            <a href="<?= url('quote.php') ?>" class="btn btn-amber">
                Initiate New Shipment &rarr;
            </a>
        </div>

        <div class="process-stepper">
            <div class="process-step-card">
                <div class="process-step-num">
                    <span>STEP</span>
                    <div class="step-num-badge">01</div>
                </div>
                <h3 class="process-step-title">Requirement Assessment</h3>
                <p class="process-step-desc">
                    Evaluation of cargo volume, weight, Incoterms (2020), hazardous classifications, and destination deadline requirements.
                </p>
            </div>

            <div class="process-step-card">
                <div class="process-step-num">
                    <span>STEP</span>
                    <div class="step-num-badge">02</div>
                </div>
                <h3 class="process-step-title">Multi-Modal Planning</h3>
                <p class="process-step-desc">
                    Selection of optimal ocean carrier or air cargo routing, container sizing, transshipment hubs, and inland drayage scheduling.
                </p>
            </div>

            <div class="process-step-card">
                <div class="process-step-num">
                    <span>STEP</span>
                    <div class="step-num-badge">03</div>
                </div>
                <h3 class="process-step-title">Customs Pre-Clearance</h3>
                <p class="process-step-desc">
                    Electronic manifest verification in ASYCUDA World, tariff audit, and pre-arrival document lodging with Sri Lanka Customs.
                </p>
            </div>

            <div class="process-step-card">
                <div class="process-step-num">
                    <span>STEP</span>
                    <div class="step-num-badge">04</div>
                </div>
                <h3 class="process-step-title">Dispatch &amp; Transit</h3>
                <p class="process-step-desc">
                    Vessel loading, bill of lading issuance, and continuous milestone tracking through maritime or airway passage.
                </p>
            </div>

            <div class="process-step-card">
                <div class="process-step-num">
                    <span>STEP</span>
                    <div class="step-num-badge">05</div>
                </div>
                <h3 class="process-step-title">Destination Handover</h3>
                <p class="process-step-desc">
                    Port discharge, terminal gate release, last-mile container prime mover haulage, and verified delivery receipt sign-off.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Section 5: Strategic Hub Spotlight (Sri Lanka Maritime Crossroads) -->
<section class="section-spacing bg-white">
    <div class="container">
        <div class="port-feature-box">
            <div class="port-feature-grid">
                <div>
                    <span class="technical-label amber" style="margin-bottom: 0.75rem;">
                        <span class="material-symbols-outlined" style="font-size: 16px;">explore</span>
                        GEO-STRATEGIC MARITIME ADVANTAGE
                    </span>
                    <h2 style="color: #FFFFFF; margin-bottom: 1.25rem;">
                        Sri Lanka: The Maritime Crossroads of South Asia
                    </h2>
                    <p style="color: #CBD5E1; font-size: 1.0625rem; line-height: 1.6; margin-bottom: 1.75rem;">
                        Positioned just 10 nautical miles off the main East-West international shipping lane connecting Asia, the Middle East, and Europe, the Port of Colombo serves as the premier deep-water transshipment hub for the Indian subcontinent.
                    </p>
                    <p style="color: #94A3B8; font-size: 0.9375rem; line-height: 1.6; margin-bottom: 2rem;">
                        Spillburg Logistics 1 operates directly within this maritime nexus, leveraging deep-draft terminal berths at CICT (Colombo International Container Terminals) and JCT (Jaya Container Terminal) to facilitate seamless transshipment and rapid clearance.
                    </p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <a href="<?= url('quote.php') ?>" class="btn btn-amber">
                            Route Via Colombo Port
                        </a>
                        <a href="<?= url('about.php') ?>" class="btn btn-outline-white">
                            About Our Operations
                        </a>
                    </div>
                </div>

                <div class="port-stats-list">
                    <div class="port-stat-item">
                        <span class="port-stat-value tabular">#1</span>
                        <span class="port-stat-desc">South Asia Transshipment Port</span>
                    </div>
                    <div class="port-stat-item">
                        <span class="port-stat-value tabular">18m+</span>
                        <span class="port-stat-desc">Deep-Draft Water Depth (CICT)</span>
                    </div>
                    <div class="port-stat-item">
                        <span class="port-stat-value tabular">7.2M+</span>
                        <span class="port-stat-desc">Annual TEU Handling Capacity</span>
                    </div>
                    <div class="port-stat-item">
                        <span class="port-stat-value tabular">24 / 7</span>
                        <span class="port-stat-desc">Electronic ASYCUDA Customs Entry</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 6: Tailored Industry Logistics -->
<section class="section-spacing bg-surface">
    <div class="container">
        <div style="text-align: center; max-width: 760px; margin-left: auto; margin-right: auto; margin-bottom: 3.5rem;">
            <span class="technical-label">
                <span class="material-symbols-outlined" style="font-size: 16px;">domain</span>
                Sector Expertise
            </span>
            <h2 style="margin-top: 0.5rem;">Tailored Logistics for Core Industries</h2>
            <p>
                Different commercial commodities demand specialized equipment, temperature protocols, and documentation standards.
            </p>
        </div>

        <div class="cards-grid-3">
            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); overflow: hidden; display: flex; flex-direction: column;">
                <div style="height: 180px; overflow: hidden;">
                    <img src="<?= url('assets/images/industry-apparel.jpg') ?>" alt="Apparel and Textiles Logistics" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                </div>
                <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <span class="technical-label" style="margin-bottom: 0.4rem;">FLAGSHIP SECTOR</span>
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Apparel &amp; Textiles</h3>
                    <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.5; margin-bottom: 1rem; flex-grow: 1;">
                        Time-definite GOH (Garments on Hanger) and flat-pack shipping container allocations connecting Sri Lanka's apparel exporters with US and European retail networks.
                    </p>
                    <a href="<?= url('industries.php') ?>" class="card-link">Sector details &rarr;</a>
                </div>
            </div>

            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); overflow: hidden; display: flex; flex-direction: column;">
                <div style="height: 180px; overflow: hidden;">
                    <img src="<?= url('assets/images/industry-machinery.jpg') ?>" alt="Industrial Machinery Logistics" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                </div>
                <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <span class="technical-label" style="margin-bottom: 0.4rem;">HEAVY COMMERCIAL</span>
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Industrial Machinery</h3>
                    <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.5; margin-bottom: 1rem; flex-grow: 1;">
                        Engineered open-top and flat-rack container stowage for manufacturing plants, automotive components, and heavy engineering hardware.
                    </p>
                    <a href="<?= url('industries.php') ?>" class="card-link">Sector details &rarr;</a>
                </div>
            </div>

            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); overflow: hidden; display: flex; flex-direction: column;">
                <div style="height: 180px; overflow: hidden;">
                    <img src="<?= url('assets/images/services-warehousing.jpg') ?>" alt="Retail and FMCG Warehousing" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                </div>
                <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <span class="technical-label" style="margin-bottom: 0.4rem;">CONSUMER DISTRIBUTION</span>
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Retail &amp; FMCG</h3>
                    <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.5; margin-bottom: 1rem; flex-grow: 1;">
                        High-turnover cargo de-consolidation, cross-docking, and palletized inland delivery ensuring continuous stock replenishment for commercial distributors.
                    </p>
                    <a href="<?= url('industries.php') ?>" class="card-link">Sector details &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 7: Action Callout Banner -->
<section style="background-color: var(--color-navy-container); color: #FFFFFF; padding: 4.5rem 0; border-top: 1px solid rgba(255, 255, 255, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 2rem;">
        <div style="max-width: 680px;">
            <span class="technical-label amber" style="margin-bottom: 0.5rem;">READY TO DISPATCH?</span>
            <h2 style="color: #FFFFFF; font-size: 2rem; margin-bottom: 0.75rem;">
                Ready to optimize transit times &amp; ocean shipping rates?
            </h2>
            <p style="color: #CBD5E1; font-size: 1.0625rem; margin-bottom: 0;">
                Transmit your cargo specifications to our Colombo operations desk for a verified multi-modal quotation.
            </p>
        </div>
        <div>
            <a href="<?= url('quote.php') ?>" class="btn btn-amber btn-lg">
                <span class="material-symbols-outlined">request_quote</span>
                Request a Freight Quote
            </a>
        </div>
    </div>
</section>

<!-- Section 8: Port & Trade Advisories (News from Database) -->
<?php if (!empty($advisories)): ?>
<section class="section-spacing bg-white">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 3rem;">
            <div>
                <span class="technical-label">
                    <span class="material-symbols-outlined" style="font-size: 16px;">newspaper</span>
                    Operational Intelligence
                </span>
                <h2 style="margin-top: 0.5rem;">Port &amp; Trade Advisories</h2>
                <p style="max-width: 600px; margin-top: 0.5rem;">
                    Critical updates regarding Colombo terminal conditions, customs regulations, and international shipping corridors.
                </p>
            </div>
            <a href="<?= url('news.php') ?>" class="btn btn-secondary">
                View All Advisories &rarr;
            </a>
        </div>

        <div class="cards-grid-3">
            <?php foreach ($advisories as $item): ?>
            <article style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2rem; display: flex; flex-direction: column;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <span class="badge badge-info"><?= e($item['category']) ?></span>
                    <span style="font-size: 0.75rem; color: var(--color-text-muted); font-family: var(--font-mono);">
                        <?= date('M d, Y', strtotime($item['published_date'])) ?>
                    </span>
                </div>
                <h3 style="font-size: 1.1875rem; line-height: 1.35; margin-bottom: 0.75rem;">
                    <a href="<?= url('news-detail.php?slug=' . urlencode($item['slug'])) ?>" style="color: var(--color-midnight);">
                        <?= e($item['title']) ?>
                    </a>
                </h3>
                <p style="font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.55; margin-bottom: 1.5rem; flex-grow: 1;">
                    <?= e($item['summary']) ?>
                </p>
                <div style="border-top: 1px solid var(--color-border-slate); padding-top: 1rem; margin-top: auto;">
                    <a href="<?= url('news-detail.php?slug=' . urlencode($item['slug'])) ?>" class="card-link">
                        Read full advisory &rarr;
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
