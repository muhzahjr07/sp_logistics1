<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Industries Served — Sector-Specific Logistics Solutions
 */

require_once __DIR__ . '/config/config.php';

$page_title = 'Industries Served — Tailored Cargo Logistics';
$page_desc = 'Sector-specific freight forwarding and cargo transportation across apparel, retail, automotive, heavy machinery, perishables, and energy infrastructure.';

$breadcrumbs = [
    ['title' => 'Industries', 'url' => 'industries.php']
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-overlay" style="background-image: linear-gradient(90deg, rgba(0, 14, 31, 0.95) 0%, rgba(0, 14, 31, 0.85) 100%), url('<?= url('assets/images/industry-apparel.jpg') ?>');"></div>
    <div class="container">
        <div class="page-hero-content">
            <span class="technical-label amber" style="margin-bottom: 0.75rem;">
                <span class="material-symbols-outlined" style="font-size: 16px;">domain</span>
                COMMERCIAL SECTOR SPECIALIZATION
            </span>
            <h1>Industries Served</h1>
            <p>
                Each commercial sector presents distinct cargo characteristics, shelf-life constraints, customs classifications, and transit urgency. We build tailored logistics workflows for each.
            </p>
        </div>
    </div>
</section>

<!-- Industries Grid -->
<section class="section-spacing bg-surface">
    <div class="container">
        <div class="grid-auto-cards" style="gap: 2.5rem;">

            <!-- 1. Apparel & Textiles -->
            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); overflow: hidden; display: flex; flex-direction: column; box-shadow: var(--shadow-sm);">
                <div style="height: 220px; overflow: hidden; position: relative;">
                    <img src="<?= url('assets/images/industry-apparel.jpg') ?>" alt="Apparel and Textiles Logistics" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    <span class="service-badge" style="position: absolute; top: 1rem; left: 1rem;">SRI LANKA FLAGSHIP</span>
                </div>
                <div style="padding: 2.25rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-blue-industrial); text-transform: uppercase; margin-bottom: 0.35rem;">
                        GLOBAL FASHION RETAIL
                    </div>
                    <h2 style="font-size: 1.4rem; margin-bottom: 0.75rem;">Apparel &amp; Textiles</h2>
                    <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.25rem; flex-grow: 1;">
                        Sri Lanka is renowned globally for premium garment manufacturing. We manage high-cube 40ft container allocations, Garments-on-Hanger (GOH) equipment, buyer consolidation, and expedited air freight for seasonal fashion retail deadlines in North America and Europe.
                    </p>
                    <ul style="list-style: none; font-size: 0.8125rem; color: var(--color-text-secondary); margin-bottom: 1.5rem; display: flex; flex-direction: column; gap: 0.4rem;">
                        <li><strong>&bull; Equipment:</strong> 40' High Cube &amp; GOH conversion kits</li>
                        <li><strong>&bull; Customs:</strong> BOI export entry &amp; preferential duty documentation</li>
                        <li><strong>&bull; Key Hub:</strong> Colombo Port to New York, Rotterdam, Felixstowe</li>
                    </ul>
                    <a href="<?= url('quote.php') ?>?commodity=Apparel%20and%20Textiles" class="btn btn-primary" style="width: 100%; text-align: center;">
                        Quote Apparel Shipment
                    </a>
                </div>
            </div>

            <!-- 2. Industrial Machinery & Engineering -->
            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); overflow: hidden; display: flex; flex-direction: column; box-shadow: var(--shadow-sm);">
                <div style="height: 220px; overflow: hidden; position: relative;">
                    <img src="<?= url('assets/images/industry-machinery.jpg') ?>" alt="Industrial Machinery Logistics" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    <span class="service-badge" style="position: absolute; top: 1rem; left: 1rem;">HEAVY EQUIPMENT</span>
                </div>
                <div style="padding: 2.25rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-blue-industrial); text-transform: uppercase; margin-bottom: 0.35rem;">
                        MANUFACTURING &amp; INFRASTRUCTURE
                    </div>
                    <h2 style="font-size: 1.4rem; margin-bottom: 0.75rem;">Industrial Machinery</h2>
                    <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.25rem; flex-grow: 1;">
                        Heavy industrial equipment, machine tools, and manufacturing assets require high-tensile lashing, timber crating, open-top containers, and flat racks. Our engineers supervise quayside vessel loading and heavy-duty prime mover transport to production sites.
                    </p>
                    <ul style="list-style: none; font-size: 0.8125rem; color: var(--color-text-secondary); margin-bottom: 1.5rem; display: flex; flex-direction: column; gap: 0.4rem;">
                        <li><strong>&bull; Equipment:</strong> Flat Racks, Open Tops, Multi-Axle Trailers</li>
                        <li><strong>&bull; Customs:</strong> Capital goods tariff concession approvals</li>
                        <li><strong>&bull; Key Hub:</strong> Port of Colombo Quay Cranes &amp; Industrial Zones</li>
                    </ul>
                    <a href="<?= url('quote.php') ?>?commodity=Industrial%20Machinery" class="btn btn-primary" style="width: 100%; text-align: center;">
                        Quote Machinery Cargo
                    </a>
                </div>
            </div>

            <!-- 3. Retail & Fast-Moving Consumer Goods (FMCG) -->
            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); overflow: hidden; display: flex; flex-direction: column; box-shadow: var(--shadow-sm);">
                <div style="height: 220px; overflow: hidden; position: relative;">
                    <img src="<?= url('assets/images/services-warehousing.jpg') ?>" alt="Retail and FMCG Logistics" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    <span class="service-badge" style="position: absolute; top: 1rem; left: 1rem;">HIGH VELOCITY</span>
                </div>
                <div style="padding: 2.25rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-blue-industrial); text-transform: uppercase; margin-bottom: 0.35rem;">
                        CONSUMER MERCHANDISE
                    </div>
                    <h2 style="font-size: 1.4rem; margin-bottom: 0.75rem;">Retail &amp; FMCG</h2>
                    <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.25rem; flex-grow: 1;">
                        Consumer goods and retail inventory require rapid container devanning, palletized buffer staging, and synchronized distribution. We offer cross-docking services in Colombo to accelerate transit from container ship to supermarket shelves.
                    </p>
                    <ul style="list-style: none; font-size: 0.8125rem; color: var(--color-text-secondary); margin-bottom: 1.5rem; display: flex; flex-direction: column; gap: 0.4rem;">
                        <li><strong>&bull; Equipment:</strong> Standard 20'/40' GP, Box Trucks</li>
                        <li><strong>&bull; Facility:</strong> Colombo Bonded Buffer Warehouses</li>
                        <li><strong>&bull; Protocol:</strong> FIFO handling &amp; barcode consignment scanning</li>
                    </ul>
                    <a href="<?= url('quote.php') ?>?commodity=Retail%20and%20FMCG" class="btn btn-primary" style="width: 100%; text-align: center;">
                        Quote FMCG Logistics
                    </a>
                </div>
            </div>

            <!-- 4. Automotive & Spare Parts -->
            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); overflow: hidden; display: flex; flex-direction: column; box-shadow: var(--shadow-sm);">
                <div style="height: 220px; overflow: hidden; position: relative;">
                    <img src="<?= url('assets/images/services-road-freight.webp') ?>" alt="Automotive and Spare Parts Logistics" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    <span class="service-badge" style="position: absolute; top: 1rem; left: 1rem;">SPARE PARTS &bull; JIT</span>
                </div>
                <div style="padding: 2.25rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-blue-industrial); text-transform: uppercase; margin-bottom: 0.35rem;">
                        PRECISION ASSEMBLY
                    </div>
                    <h2 style="font-size: 1.4rem; margin-bottom: 0.75rem;">Automotive &amp; Spare Parts</h2>
                    <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.25rem; flex-grow: 1;">
                        Supply chain continuity for automotive assembly and aftermarket spares. We manage completely knocked down (CKD) and semi-knocked down (SKD) container shipments, specialized battery/hazmat transit, and emergency air dispatch for out-of-stock components.
                    </p>
                    <ul style="list-style: none; font-size: 0.8125rem; color: var(--color-text-secondary); margin-bottom: 1.5rem; display: flex; flex-direction: column; gap: 0.4rem;">
                        <li><strong>&bull; Equipment:</strong> 40' HC Containers, Express Air Freight</li>
                        <li><strong>&bull; Handling:</strong> Shock-absorbent packaging &amp; part labeling</li>
                        <li><strong>&bull; Key Hub:</strong> Colombo Port Terminals to Regional Depots</li>
                    </ul>
                    <a href="<?= url('quote.php') ?>?commodity=Automotive%20Parts" class="btn btn-primary" style="width: 100%; text-align: center;">
                        Quote Automotive Parts
                    </a>
                </div>
            </div>

            <!-- 5. Perishables & Temperature Controlled (Cold Chain) -->
            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); overflow: hidden; display: flex; flex-direction: column; box-shadow: var(--shadow-sm);">
                <div style="height: 220px; overflow: hidden; position: relative;">
                    <img src="<?= url('assets/images/services-customs.jpg') ?>" alt="Cold Chain and Perishables Logistics" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    <span class="service-badge" style="position: absolute; top: 1rem; left: 1rem;">COLD CHAIN</span>
                </div>
                <div style="padding: 2.25rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-blue-industrial); text-transform: uppercase; margin-bottom: 0.35rem;">
                        REEFER &bull; CLIMATE MONITORING
                    </div>
                    <h2 style="font-size: 1.4rem; margin-bottom: 0.75rem;">Perishables &amp; Cold Chain</h2>
                    <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.25rem; flex-grow: 1;">
                        Fresh seafood exports, seasonal fruits, Ceylon tea, and pharmaceutical consignments requiring continuous climate integrity. We provide reefer container plug-in management at port quays, genset-equipped prime movers, and expedited plant quarantine clearance.
                    </p>
                    <ul style="list-style: none; font-size: 0.8125rem; color: var(--color-text-secondary); margin-bottom: 1.5rem; display: flex; flex-direction: column; gap: 0.4rem;">
                        <li><strong>&bull; Equipment:</strong> 20' &amp; 40' Reefer with integrated temperature loggers</li>
                        <li><strong>&bull; Customs:</strong> SLSI, Department of Agriculture &amp; Health clearance</li>
                        <li><strong>&bull; Key Hub:</strong> Colombo Port Reefer Stacks &amp; CMB Airport Cold Rooms</li>
                    </ul>
                    <a href="<?= url('quote.php') ?>?commodity=Perishables%20Cold%20Chain" class="btn btn-primary" style="width: 100%; text-align: center;">
                        Quote Cold Chain
                    </a>
                </div>
            </div>

            <!-- 6. Renewable Energy & Infrastructure -->
            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); overflow: hidden; display: flex; flex-direction: column; box-shadow: var(--shadow-sm);">
                <div style="height: 220px; overflow: hidden; position: relative;">
                    <img src="<?= url('assets/images/services-project-cargo.webp') ?>" alt="Renewable Energy Logistics" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                    <span class="service-badge" style="position: absolute; top: 1rem; left: 1rem;">GREEN INFRASTRUCTURE</span>
                </div>
                <div style="padding: 2.25rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-blue-industrial); text-transform: uppercase; margin-bottom: 0.35rem;">
                        CLEAN ENERGY CORRIDORS
                    </div>
                    <h2 style="font-size: 1.4rem; margin-bottom: 0.75rem;">Renewable Energy</h2>
                    <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.25rem; flex-grow: 1;">
                        Logistics support for solar farms, wind power generation, and grid modernization projects. We coordinate high-volume photovoltaic container imports, inverters, and heavy step-up transformers from origin manufacturing plants to remote rural installation sites.
                    </p>
                    <ul style="list-style: none; font-size: 0.8125rem; color: var(--color-text-secondary); margin-bottom: 1.5rem; display: flex; flex-direction: column; gap: 0.4rem;">
                        <li><strong>&bull; Equipment:</strong> High-cube container batches &amp; low-bed trailers</li>
                        <li><strong>&bull; Execution:</strong> Staggered staging to prevent site congestion</li>
                        <li><strong>&bull; Clearance:</strong> Energy ministry import permit processing</li>
                    </ul>
                    <a href="<?= url('quote.php') ?>?commodity=Renewable%20Energy" class="btn btn-primary" style="width: 100%; text-align: center;">
                        Quote Energy Project
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Bottom Conversion CTA -->
<section style="background-color: var(--color-navy-container); color: #FFFFFF; padding: 4rem 0;">
    <div class="container" style="text-align: center; max-width: 720px;">
        <span class="technical-label amber" style="margin-bottom: 0.5rem;">INDUSTRY LOGISTICS CONSULTATION</span>
        <h2 style="color: #FFFFFF; font-size: 2rem; margin-bottom: 1rem;">Have Sector-Specific Compliance Questions?</h2>
        <p style="color: #CBD5E1; font-size: 1.0625rem; margin-bottom: 2rem;">
            Our Colombo freight desk works closely with trade associations, export councils, and factory logistics managers to ensure seamless port clearance.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="<?= url('quote.php') ?>" class="btn btn-amber btn-lg">
                <span class="material-symbols-outlined">request_quote</span>
                Submit RFQ Specification
            </a>
            <a href="<?= url('contact.php') ?>" class="btn btn-outline-white btn-lg">
                Speak to Sector Specialist
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
