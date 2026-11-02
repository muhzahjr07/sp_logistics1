<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Privacy Policy & Data Protection Notice
 */

require_once __DIR__ . '/config/config.php';

$page_title = 'Privacy Policy & Data Protection';
$page_desc = 'Data handling and privacy practices for commercial shippers, consignees, and website visitors of Spillburg Logistics 1 (Private) Limited.';

$breadcrumbs = [
    ['title' => 'Privacy Policy', 'url' => 'privacy.php']
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<section class="section-spacing bg-white">
    <div class="container container-narrow">
        <span class="technical-label">DATA GOVERNANCE</span>
        <h1 style="font-size: 2.25rem; margin-top: 0.5rem; margin-bottom: 1.5rem; color: var(--color-midnight);">
            Privacy &amp; Data Protection Policy
        </h1>
        <div style="font-size: 0.8125rem; color: var(--color-text-muted); font-family: var(--font-mono); margin-bottom: 2rem;">
            LAST REVISED: OCTOBER 2026 &bull; APPLICABLE TO COMMERCIAL FREIGHT OPERATIONS
        </div>

        <div style="font-size: 0.9375rem; line-height: 1.7; color: var(--color-text-secondary); display: flex; flex-direction: column; gap: 1.5rem;">
            <p>
                <strong>Spillburg Logistics 1 (Private) Limited</strong> ("we", "us", or "our") is dedicated to protecting the commercial confidentiality and personal data of our clients, shippers, consignees, and digital visitors. This policy outlines our operational data collection, usage, and storage protocols.
            </p>

            <h3 style="color: var(--color-midnight); font-size: 1.25rem;">1. Commercial &amp; Shipment Data Collected</h3>
            <p>
                When you request a quotation or engage our freight services, we collect necessary commercial identifiers including company name, registration number, business address, contact person name, corporate email address, telephone numbers, and cargo parameters (dimensions, commodity classification, invoices, packing lists, and bills of lading).
            </p>

            <h3 style="color: var(--color-midnight); font-size: 1.25rem;">2. Regulatory Disclosures to Customs &amp; Port Authorities</h3>
            <p>
                Under Sri Lanka law and international maritime conventions, freight forwarders and customs brokers are legally required to submit manifest declarations, Harmonized System (HS) classifications, and consignee data into statutory systems including <strong>Sri Lanka Customs Automated System for Customs Data (ASYCUDA World)</strong> and the <strong>Sri Lanka Ports Authority (SLPA)</strong> terminal gate systems.
            </p>

            <h3 style="color: var(--color-midnight); font-size: 1.25rem;">3. Data Security &amp; Confidentiality</h3>
            <p>
                We implement technical safeguards, access control lists, encrypted protocols, and secure database parameters to prevent unauthorized disclosure of proprietary commercial pricing and shipper supply chain data. We never sell, rent, or trade client information to commercial third parties.
            </p>

            <h3 style="color: var(--color-midnight); font-size: 1.25rem;">4. Contact Regarding Privacy Queries</h3>
            <p>
                If you have questions regarding data processing or wish to inspect your registered business records, please contact our compliance desk at <a href="mailto:<?= COMPANY_EMAIL ?>"><?= COMPANY_EMAIL ?></a> or write to our Colombo registered office at <?= COMPANY_FULL_ADDRESS ?>.
            </p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
