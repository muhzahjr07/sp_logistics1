<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * HTML Visual Sitemap with Direct Openable Links
 */

require_once __DIR__ . '/config/config.php';

$page_title = 'Site Map — Navigation & Directory';
$page_desc = 'Complete index of all public services, trade corridors, corporate documents, industry solutions, and administrative tools of Spillburg Logistics 1 (Private) Limited.';

$breadcrumbs = [
    ['title' => 'Sitemap', 'url' => 'sitemap.php']
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';

// Structured Sitemap Directories
$sitemap_sections = [
    [
        'title' => 'Core Navigation',
        'badge' => 'Main',
        'desc' => 'Primary corporate entrypoints and operational portals.',
        'links' => [
            ['title' => 'Home / Cargo Terminal', 'url' => url('index.php'), 'desc' => 'Overview of services, maritime metrics, terminal updates, and corridor highlights.'],
            ['title' => 'Corporate Identity & About Us', 'url' => url('about.php'), 'desc' => 'Spillburg corporate group profile, Colombo operational base, and governance.'],
            ['title' => 'Master Freight Services Directory', 'url' => url('services.php'), 'desc' => 'Complete catalog of multimodal capabilities and equipment matrices.'],
            ['title' => 'Industry Sectors & Solutions', 'url' => url('industries.php'), 'desc' => 'Specialized logistics for Apparel, FMCG, Cold Chain, Machinery, and Energy.'],
            ['title' => 'Request a Quote (RFQ Wizard)', 'url' => url('quote.php'), 'desc' => '4-step instant cargo rate inquiry wizard with automated tracking dockets.'],
            ['title' => 'Contact Headquarters & Regional Desks', 'url' => url('contact.php'), 'desc' => 'Colombo port operational office, customer support hotlines, and inquiry form.'],
            ['title' => 'Port Bulletins & Operational Advisories', 'url' => url('news.php'), 'desc' => 'Real-time terminal congestion, tariff revisions, and customs circulars.']
        ]
    ],
    [
        'title' => 'Multimodal Freight & Technical Services',
        'badge' => 'Operations',
        'desc' => 'Specialized freight modes, container specifications, and port services.',
        'links' => [
            ['title' => 'Ocean Freight Forwarding (FCL / LCL)', 'url' => url('service-sea-freight.php'), 'desc' => 'Global container liner services, slot booking, consolidated freight, and reefer cargo.'],
            ['title' => 'Air Freight & IATA Expedited Cargo', 'url' => url('service-air-freight.php'), 'desc' => 'Time-critical air cargo handling, scheduled freighter charters, and Bandaranaike Airport transit.'],
            ['title' => 'Road Freight Haulage & Drayage', 'url' => url('service-road-freight.php'), 'desc' => 'Heavy prime movers, multi-axle chassis, island-wide container haulage, and port transfers.'],
            ['title' => 'Project Cargo & Heavy Lift Engineering', 'url' => url('service-project-cargo.php'), 'desc' => 'Out-of-gauge (OOG) machinery, route civil surveys, heavy crane rigging, and breakbulk.'],
            ['title' => 'Licensed Sri Lanka Customs Brokerage', 'url' => url('service-customs-clearance.php'), 'desc' => 'ASYCUDA World digital declarations, BOI duty exemptions, and regulatory agency coordination.'],
            ['title' => 'Bonded Warehousing & Buffer Inventory', 'url' => url('service-warehousing.php'), 'desc' => 'Bonded staging, export consolidation buffer hubs, inventory tracking, and devanning.']
        ]
    ],
    [
        'title' => 'Industry Vertical Specializations',
        'badge' => 'Sectors',
        'desc' => 'Tailored supply chain workflows engineered for dedicated industries.',
        'links' => [
            ['title' => 'Apparel & Garment Supply Chains', 'url' => url('industries.php#apparel'), 'desc' => 'GOH (Garments on Hanger), rapid lead-time air-sea transshipment for Sri Lanka fashion export.'],
            ['title' => 'Industrial Machinery & Spare Parts', 'url' => url('industries.php#machinery'), 'desc' => 'Heavy components, industrial assembly lines, and factory modernization logistics.'],
            ['title' => 'Cold Chain & Perishables', 'url' => url('industries.php#coldchain'), 'desc' => 'Temperature-controlled reefer corridors for seafood, produce, and pharmaceutical cargo.'],
            ['title' => 'Fast-Moving Consumer Goods (FMCG)', 'url' => url('industries.php#fmcg'), 'desc' => 'High-velocity retail supply chain fulfillment and bonded distribution.'],
            ['title' => 'Energy & Infrastructure', 'url' => url('industries.php#energy'), 'desc' => 'Power generation hardware, transformers, and national infrastructure project cargo.']
        ]
    ],
    [
        'title' => 'Governance, Compliance & Technical',
        'badge' => 'Legal & System',
        'desc' => 'Statutory compliance, trading terms, privacy charters, and machine-readable feeds.',
        'links' => [
            ['title' => 'Privacy & Data Protection Policy', 'url' => url('privacy.php'), 'desc' => 'Data handling, shipper confidentiality, and ASYCUDA statutory regulatory disclosures.'],
            ['title' => 'Standard Trading Conditions (Terms)', 'url' => url('terms.php'), 'desc' => 'Contractual terms of carriage, carrier liability parameters, and demurrage definitions.'],
            ['title' => 'Machine-Readable XML Sitemap', 'url' => url('sitemap.xml'), 'desc' => 'Raw sitemaps.org protocol XML index for search engine crawlers and web spiders.'],
            ['title' => 'Search Robots Directives (robots.txt)', 'url' => url('robots.txt'), 'desc' => 'Crawler indexing boundaries and sitemap index specifications.'],
            ['title' => 'Admin Operations Console (Restricted)', 'url' => url('admin/login.php'), 'desc' => 'Authorized staff terminal for RFQ docket processing, client communication, and advisories.']
        ]
    ]
];
?>

<section class="section-spacing bg-white">
    <div class="container">
        <div style="max-width: 800px; margin-bottom: 3rem;">
            <span class="technical-label">DIRECTORY &amp; STRUCTURE</span>
            <h1 style="font-size: 2.5rem; margin-top: 0.5rem; margin-bottom: 1rem; color: var(--color-midnight);">
                Sitemap &amp; Navigation Index
            </h1>
            <p style="font-size: 1.0625rem; color: var(--color-text-secondary); line-height: 1.7;">
                Welcome to the complete page index for <strong>Spillburg Logistics 1 (Private) Limited</strong>. Use this directory to quickly access all multimodal service corridors, quotation tools, industry briefs, compliance documentation, and operations desks.
            </p>
        </div>

        <div style="display: flex; flex-direction: column; gap: 3rem;">
            <?php foreach ($sitemap_sections as $sec): ?>
                <div style="background-color: var(--color-surface-blue); border: 1px solid var(--color-border); border-radius: 8px; padding: 2rem; box-shadow: var(--shadow-sm);">
                    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid var(--color-midnight); padding-bottom: 0.75rem; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 0.5rem;">
                        <div>
                            <h2 style="font-size: 1.375rem; color: var(--color-midnight); margin: 0;">
                                <?= e($sec['title']) ?>
                            </h2>
                            <p style="font-size: 0.875rem; color: var(--color-text-secondary); margin: 0.25rem 0 0 0;">
                                <?= e($sec['desc']) ?>
                            </p>
                        </div>
                        <span class="badge" style="background-color: var(--color-primary-navy); color: #fff; font-size: 0.75rem; padding: 0.35rem 0.75rem; text-transform: uppercase; font-family: var(--font-mono); border-radius: 4px;">
                            <?= e($sec['badge']) ?>
                        </span>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.25rem;">
                        <?php foreach ($sec['links'] as $item): ?>
                            <a href="<?= e($item['url']) ?>" class="sitemap-card" style="display: block; background-color: #ffffff; border: 1px solid var(--color-border); border-radius: 6px; padding: 1.25rem; text-decoration: none; transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;">
                                <div style="display: flex; align-items: baseline; justify-content: space-between; margin-bottom: 0.5rem;">
                                    <span style="font-weight: 700; color: var(--color-industrial-blue); font-size: 1rem; display: flex; align-items: center; gap: 0.4rem;">
                                        <?= e($item['title']) ?>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;"><path d="M7 17l9.2-9.2M17 17V8H8"/></svg>
                                    </span>
                                </div>
                                <div style="font-size: 0.8125rem; color: var(--color-text-secondary); line-height: 1.5;">
                                    <?= e($item['desc']) ?>
                                </div>
                                <div style="margin-top: 0.75rem; font-family: var(--font-mono); font-size: 0.75rem; color: var(--color-text-muted); word-break: break-all;">
                                    <?= e($item['url']) ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Quick Assistance Box -->
        <div style="margin-top: 3.5rem; background-color: var(--color-midnight); border-radius: 8px; padding: 2.5rem; color: #ffffff; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <span style="font-family: var(--font-mono); font-size: 0.75rem; color: var(--color-amber-accent); letter-spacing: 0.1em; text-transform: uppercase;">Direct Shipper Support</span>
                <h3 style="font-size: 1.5rem; color: #ffffff; margin-top: 0.25rem; margin-bottom: 0.5rem;">Can't find the freight corridor or service you need?</h3>
                <p style="font-size: 0.9375rem; color: rgba(255, 255, 255, 0.75); margin: 0; max-width: 600px;">
                    Our Colombo port operations desk is on standby to assist with customs queries, special OOG handling, and contract rates.
                </p>
            </div>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="<?= url('quote.php') ?>" class="btn btn-accent" style="white-space: nowrap;">Request a Quote</a>
                <a href="<?= url('contact.php') ?>" class="btn btn-outline-white" style="white-space: nowrap;">Contact Support</a>
            </div>
        </div>
    </div>
</section>

<style>
.sitemap-card:hover {
    transform: translateY(-2px);
    border-color: var(--color-industrial-blue);
    box-shadow: 0 4px 12px rgba(36, 91, 130, 0.12);
}
.sitemap-card:hover span {
    color: var(--color-primary-navy);
}
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

