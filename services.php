<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Services Overview — Comprehensive Freight & Logistics Portfolio
 */

require_once __DIR__ . '/config/config.php';

$page_title = 'Comprehensive Freight & Cargo Logistics Services';
$page_desc = 'Explore Spillburg Logistics 1 services: ocean freight forwarding, air cargo coordination, inland drayage, project cargo, customs brokerage, and bonded warehousing.';

$breadcrumbs = [
    ['title' => 'Services', 'url' => 'services.php']
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-overlay" style="background-image: linear-gradient(90deg, rgba(0, 14, 31, 0.95) 0%, rgba(0, 14, 31, 0.85) 100%), url('<?= url('assets/images/services-ocean-freight.webp') ?>');"></div>
    <div class="container">
        <div class="page-hero-content">
            <span class="technical-label amber" style="margin-bottom: 0.75rem;">
                <span class="material-symbols-outlined" style="font-size: 16px;">view_module</span>
                COMPREHENSIVE PORTFOLIO
            </span>
            <h1>Freight &amp; Cargo Logistics Services</h1>
            <p>
                From global container shipping and time-critical air freight to licensed Sri Lanka customs brokerage and island-wide container haulage, our capabilities are built for operational precision.
            </p>
        </div>
    </div>
</section>

<!-- Detailed Service Cards List -->
<section class="section-spacing bg-surface">
    <div class="container">

        <!-- 1. Ocean Freight -->
        <div class="grid-split-card">
            <div style="min-height: 280px; position: relative;">
                <img src="<?= url('assets/images/services-ocean-freight.webp') ?>" alt="Ocean Freight Forwarding" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                <span class="service-badge" style="position: absolute; top: 1.5rem; left: 1.5rem;">FCL &bull; LCL OCEAN</span>
            </div>
            <div style="padding: clamp(1.5rem, 3vw, 3rem); display: flex; flex-direction: column; justify-content: center;">
                <span class="technical-label" style="margin-bottom: 0.5rem;">PRIMARY TRANSIT MODE</span>
                <h2 style="font-size: 1.75rem; margin-bottom: 1rem;">Ocean Freight Forwarding &amp; Transshipment Hub Handling</h2>
                <p style="font-size: 0.9375rem; line-height: 1.6; color: var(--color-text-secondary); margin-bottom: 1.5rem;">
                    Operating from the Port of Colombo—South Asia’s leading transshipment hub—we coordinate Full Container Load (FCL) and Less than Container Load (LCL) consignments across major maritime shipping lines. We handle direct berth allocations at CICT and JCT terminals, container leasing, and transshipment devanning.
                </p>
                <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                    <a href="<?= url('service-sea-freight.php') ?>" class="btn btn-primary">
                        Explore Ocean Freight Details &rarr;
                    </a>
                    <a href="<?= url('quote.php') ?>?mode=sea" class="btn btn-secondary">
                        Quote Ocean Cargo
                    </a>
                </div>
            </div>
        </div>

        <!-- 2. Air Cargo -->
        <div class="grid-split-card">
            <div style="padding: clamp(1.5rem, 3vw, 3rem); display: flex; flex-direction: column; justify-content: center; order: 2;">
                <span class="technical-label" style="margin-bottom: 0.5rem;">EXPEDITED AIRWAY DISPATCH</span>
                <h2 style="font-size: 1.75rem; margin-bottom: 1rem;">Air Cargo Management &amp; Time-Critical Dispatch</h2>
                <p style="font-size: 0.9375rem; line-height: 1.6; color: var(--color-text-secondary); margin-bottom: 1.5rem;">
                    When transit speed is vital, our air freight division coordinates scheduled commercial cargo flights and specialized freighter space via Bandaranaike International Airport (CMB). We handle high-value commercial electronics, urgent apparel samples, pharmaceuticals, and temperature-controlled cargo.
                </p>
                <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                    <a href="<?= url('service-air-freight.php') ?>" class="btn btn-primary">
                        Explore Air Cargo Details &rarr;
                    </a>
                    <a href="<?= url('quote.php') ?>?mode=air" class="btn btn-secondary">
                        Quote Air Shipment
                    </a>
                </div>
            </div>
            <div style="min-height: 280px; position: relative; order: 1;">
                <img src="<?= url('assets/images/services-air-freight.webp') ?>" alt="Air Cargo Coordination" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                <span class="service-badge" style="position: absolute; top: 1.5rem; left: 1.5rem;">IATA &bull; EXPRESS RAMP</span>
            </div>
        </div>

        <!-- 3. Inland Road Transport -->
        <div class="grid-split-card">
            <div style="min-height: 280px; position: relative;">
                <img src="<?= url('assets/images/services-road-freight.webp') ?>" alt="Inland Road Transport" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                <span class="service-badge" style="position: absolute; top: 1.5rem; left: 1.5rem;">INLAND HAULAGE</span>
            </div>
            <div style="padding: clamp(1.5rem, 3vw, 3rem); display: flex; flex-direction: column; justify-content: center;">
                <span class="technical-label" style="margin-bottom: 0.5rem;">TERRESTRIAL DRAYAGE</span>
                <h2 style="font-size: 1.75rem; margin-bottom: 1rem;">Inland Road Transport &amp; Container Drayage</h2>
                <p style="font-size: 0.9375rem; line-height: 1.6; color: var(--color-text-secondary); margin-bottom: 1.5rem;">
                    Our terrestrial fleet includes modern container prime movers, skeletal trailers, and box trucks equipped for intermodal transfers between Colombo harbor terminals, export processing zones (EPZs), and customer manufacturing facilities island-wide.
                </p>
                <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                    <a href="<?= url('service-road-freight.php') ?>" class="btn btn-primary">
                        Explore Road Drayage &rarr;
                    </a>
                    <a href="<?= url('quote.php') ?>?mode=road" class="btn btn-secondary">
                        Quote Road Transport
                    </a>
                </div>
            </div>
        </div>

        <!-- 4. Project Cargo & Heavy Lift -->
        <div class="grid-split-card">
            <div style="padding: clamp(1.5rem, 3vw, 3rem); display: flex; flex-direction: column; justify-content: center; order: 2;">
                <span class="technical-label" style="margin-bottom: 0.5rem;">OUT-OF-GAUGE &bull; OOG</span>
                <h2 style="font-size: 1.75rem; margin-bottom: 1rem;">Project Cargo &amp; Heavy Lift Logistics</h2>
                <p style="font-size: 0.9375rem; line-height: 1.6; color: var(--color-text-secondary); margin-bottom: 1.5rem;">
                    Complex industrial moves require dedicated engineering. We provide route obstacle surveys, bridge structural load assessments, multi-axle hydraulic modular trailers, crane rigging supervision, and police escorts for out-of-gauge heavy machinery and industrial infrastructure components.
                </p>
                <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                    <a href="<?= url('service-project-cargo.php') ?>" class="btn btn-primary">
                        Explore Project Cargo &rarr;
                    </a>
                    <a href="<?= url('quote.php') ?>?mode=project" class="btn btn-secondary">
                        Quote Heavy Lift Project
                    </a>
                </div>
            </div>
            <div style="min-height: 280px; position: relative; order: 1;">
                <img src="<?= url('assets/images/services-project-cargo.webp') ?>" alt="Project Cargo and Heavy Lift" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                <span class="service-badge" style="position: absolute; top: 1.5rem; left: 1.5rem;">HEAVY ENGINEERING</span>
            </div>
        </div>

        <!-- 5 & 6. Customs Clearance & Warehousing Side-by-Side -->
        <div class="cards-grid-2">
            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); overflow: hidden; display: flex; flex-direction: column;">
                <div style="height: 240px; overflow: hidden; position: relative;">
                    <img src="<?= url('assets/images/services-customs.jpg') ?>" alt="Customs Brokerage" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    <span class="service-badge" style="position: absolute; top: 1rem; left: 1rem;">ASYCUDA WORLD</span>
                </div>
                <div style="padding: 2.25rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <span class="technical-label" style="margin-bottom: 0.5rem;">REGULATORY CLEARING</span>
                    <h3 style="font-size: 1.35rem; margin-bottom: 0.75rem;">Customs Brokerage &amp; Compliance</h3>
                    <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1;">
                        Licensed Sri Lanka customs broker handling HS code tariff classification, Board of Investment (BOI) duty exemptions, electronic manifest declarations, and port terminal gate release documentation.
                    </p>
                    <a href="<?= url('service-customs-clearance.php') ?>" class="btn btn-secondary" style="width: 100%; text-align: center;">
                        Brokerage Details &rarr;
                    </a>
                </div>
            </div>

            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); overflow: hidden; display: flex; flex-direction: column;">
                <div style="height: 240px; overflow: hidden; position: relative;">
                    <img src="<?= url('assets/images/services-warehousing.jpg') ?>" alt="Warehousing and Staging" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    <span class="service-badge" style="position: absolute; top: 1rem; left: 1rem;">BONDED &bull; DRY BUFFER</span>
                </div>
                <div style="padding: 2.25rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <span class="technical-label" style="margin-bottom: 0.5rem;">STORAGE &amp; CONSOLIDATION</span>
                    <h3 style="font-size: 1.35rem; margin-bottom: 0.75rem;">Warehousing &amp; Cargo Staging</h3>
                    <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1;">
                        Secure bonded and dry staging facilities located in the Colombo maritime corridor. Services include container devanning, palletizing, shrink wrapping, barcode labeling, and export consolidation.
                    </p>
                    <a href="<?= url('service-warehousing.php') ?>" class="btn btn-secondary" style="width: 100%; text-align: center;">
                        Warehousing Details &rarr;
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Section: Freight Capabilities & Parameter Matrix -->
<section class="section-spacing bg-white">
    <div class="container">
        <div style="text-align: center; max-width: 760px; margin-left: auto; margin-right: auto; margin-bottom: 3rem;">
            <span class="technical-label">
                <span class="material-symbols-outlined" style="font-size: 16px;">table_chart</span>
                TECHNICAL METRICS
            </span>
            <h2 style="margin-top: 0.5rem;">Freight Capabilities &amp; Parameter Matrix</h2>
            <p>
                Reference matrix outlining transport modes, container equipment specifications, transit hubs, and governing commercial frameworks.
            </p>
        </div>

        <div class="table-responsive">
            <table class="logistics-table">
                <thead>
                    <tr>
                        <th>Transport Mode</th>
                        <th>Equipment / Container Types</th>
                        <th>Payload / Volume Capacity</th>
                        <th>Primary Sri Lankan Hub</th>
                        <th>Governing Incoterms &bull; Framework</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Ocean Freight (FCL)</strong></td>
                        <td>20' GP, 40' GP, 40' HC, 45' HC, Open Top, Flat Rack, Reefer</td>
                        <td><span class="tabular">Up to 28,000 kg</span> / <span class="tabular">76.4 CBM</span></td>
                        <td>Port of Colombo (CICT, JCT, SAGT)</td>
                        <td>FOB, CIF, CFR, EXW (Incoterms 2020)</td>
                    </tr>
                    <tr>
                        <td><strong>Ocean Freight (LCL)</strong></td>
                        <td>Consolidation boxes, palletized loose cargo, wooden crates</td>
                        <td><span class="tabular">1 CBM to 15 CBM</span></td>
                        <td>Colombo CFS Staging Warehouses</td>
                        <td>FOB, CIF, CFR, DDP</td>
                    </tr>
                    <tr>
                        <td><strong>Air Cargo Scheduled</strong></td>
                        <td>Unit Load Devices (ULD), LD3, PMC Pallets, Lower Deck</td>
                        <td><span class="tabular">Express: 50 kg - 5,000 kg</span></td>
                        <td>Bandaranaike Int'l Airport (CMB)</td>
                        <td>FCA, CPT, CIP, DAP</td>
                    </tr>
                    <tr>
                        <td><strong>Inland Road Transport</strong></td>
                        <td>Container prime movers, 20'/40' skeletal trailers, box trucks</td>
                        <td><span class="tabular">Up to 32,000 kg gross</span></td>
                        <td>Colombo Seaport to Island-wide EPZs</td>
                        <td>Door Delivery, Ex-Works, Port Drayage</td>
                    </tr>
                    <tr>
                        <td><strong>Project Cargo / Heavy Lift</strong></td>
                        <td>Hydraulic multi-axle modular trailers, low-bed transporters</td>
                        <td><span class="tabular">Individual pieces &gt; 50 MT</span></td>
                        <td>Port of Colombo / Hambantota Port</td>
                        <td>Engineered Turnkey Logistics Contract</td>
                    </tr>
                    <tr>
                        <td><strong>Customs Brokerage</strong></td>
                        <td>Electronic EDI ASYCUDA World declarations</td>
                        <td>Per-container or per-consignment docket</td>
                        <td>Sri Lanka Customs Longroom, Colombo</td>
                        <td>Licensed In-House Clearing Broker</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Frequently Asked Operations Questions -->
<section class="section-spacing bg-surface">
    <div class="container container-narrow">
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <span class="technical-label">
                <span class="material-symbols-outlined" style="font-size: 16px;">help</span>
                OPERATIONS FAQS
            </span>
            <h2 style="margin-top: 0.5rem;">Frequently Asked Operations Questions</h2>
            <p>
                Essential information on quotation processing, bill of lading documentation, and customs clearance procedures.
            </p>
        </div>

        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-md); padding: 1.75rem;">
                <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">What information is required to receive an accurate freight quotation?</h3>
                <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6;">
                    To provide a verified quotation, our operations desk requires: Port of Loading (POL), Port of Discharge (POD), preferred mode (Sea, Air, Road), commodity description and HS code if known, container type or piece dimensions, total gross weight (kg/MT), volume (CBM), and governing Incoterms (2020).
                </p>
            </div>

            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-md); padding: 1.75rem;">
                <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">How does customs pre-clearance work at the Port of Colombo?</h3>
                <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6;">
                    Through the Sri Lanka Customs ASYCUDA World system, Spillburg Logistics 1 initiates electronic manifest and CusDec entries 24-48 hours prior to vessel berthing. This pre-arrival processing enables rapid container release upon terminal discharge, minimizing port dwell time and storage charges.
                </p>
            </div>

            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-md); padding: 1.75rem;">
                <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">Can you manage Out-of-Gauge (OOG) and heavy industrial project cargo?</h3>
                <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6;">
                    Yes. Our project logistics desk conducts engineering route surveys across Sri Lanka's road infrastructure to determine overhead cable heights, bridge capacities, and turning radii before dispatching multi-axle modular trailers with specialized police escorts.
                </p>
            </div>

            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-md); padding: 1.75rem;">
                <h3 style="font-size: 1.125rem; margin-bottom: 0.5rem;">What happens once an RFQ (Request for Quote) is submitted?</h3>
                <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6;">
                    Upon submitting our structured RFQ form, a unique tracking reference docket (e.g., <code>RFQ-SL1-2026-XXXX</code>) is generated and stored in our operations database. Our freight pricing specialists review shipping line schedules and transmit an itemized quotation to your corporate email within 1 business day.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Section: Have Specialized Cargo Requirements? CTA -->
<section style="background-color: var(--color-navy-container); color: #FFFFFF; padding: 4rem 0;">
    <div class="container" style="text-align: center; max-width: 720px;">
        <span class="technical-label amber" style="margin-bottom: 0.5rem;">DIRECT RFQ TRANSMISSION</span>
        <h2 style="color: #FFFFFF; font-size: 2rem; margin-bottom: 1rem;">Have Specialized Cargo Requirements?</h2>
        <p style="color: #CBD5E1; font-size: 1.0625rem; margin-bottom: 2rem;">
            Whether you require flat-rack ocean containers, hazardous cargo documentation, or chartered air freight, our operations desk is equipped to assist.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="<?= url('quote.php') ?>" class="btn btn-amber btn-lg">
                <span class="material-symbols-outlined">request_quote</span>
                Request a Freight Quote
            </a>
            <a href="<?= url('contact.php') ?>" class="btn btn-outline-white btn-lg">
                Contact Operations Desk
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
