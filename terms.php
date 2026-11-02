<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Standard Trading Conditions & Terms of Carriage
 */

require_once __DIR__ . '/config/config.php';

$page_title = 'Standard Trading Conditions & Terms of Carriage';
$page_desc = 'Commercial trading conditions and carriage terms governing freight operations managed by Spillburg Logistics 1 (Private) Limited.';

$breadcrumbs = [
    ['title' => 'Terms of Carriage', 'url' => 'terms.php']
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<section class="section-spacing bg-white">
    <div class="container container-narrow">
        <span class="technical-label">CONTRACTUAL CONDITIONS</span>
        <h1 style="font-size: 2.25rem; margin-top: 0.5rem; margin-bottom: 1.5rem; color: var(--color-midnight);">
            Standard Trading Conditions
        </h1>
        <div style="font-size: 0.8125rem; color: var(--color-text-muted); font-family: var(--font-mono); margin-bottom: 2rem;">
            GOVERNING MARITIME &amp; MULTI-MODAL LOGISTICS AGREEMENTS &bull; COLOMBO JURISDICTION
        </div>

        <div style="font-size: 0.9375rem; line-height: 1.7; color: var(--color-text-secondary); display: flex; flex-direction: column; gap: 1.5rem;">
            <p>
                All freight forwarding, customs clearance, cargo handling, and warehousing services provided by <strong>Spillburg Logistics 1 (Private) Limited</strong> are conducted strictly subject to these Standard Trading Conditions, unless otherwise expressly agreed in a formal executed contract.
            </p>

            <h3 style="color: var(--color-midnight); font-size: 1.25rem;">1. Role of the Company</h3>
            <p>
                The Company acts as an authorized freight forwarder, cargo coordinator, and licensed customs clearing agent. The Company reserves the right to engage ocean liner carriers, airline operators, port terminal operators, stevedores, and road haulage sub-contractors on terms standard to their respective trades.
            </p>

            <h3 style="color: var(--color-midnight); font-size: 1.25rem;">2. Shippers' Warranties &amp; Declarations</h3>
            <p>
                The customer warrants that all descriptions, values, weights, container gross mass certificates (VGM), and customs declarations provided are truthful and accurate. The customer indemnifies the Company against all penalties, fines, port demurrage, or legal actions arising from incorrect documentation or undeclared dangerous goods.
            </p>

            <h3 style="color: var(--color-midnight); font-size: 1.25rem;">3. Quotations &amp; Surcharges</h3>
            <p>
                All freight quotations are subject to space availability, carrier booking confirmation, exchange rate variations, Bunker Adjustment Factors (BAF), Terminal Handling Charges (THC), and peak season surcharges (PSS) prevailing at the actual time of vessel loading. Quotations do not constitute an unconditional guarantee of vessel departure or arrival dates.
            </p>

            <h3 style="color: var(--color-midnight); font-size: 1.25rem;">4. Limitation of Liability &amp; Marine Insurance</h3>
            <p>
                The Company’s liability for loss, damage, or delay to cargo is limited in accordance with applicable international maritime conventions (Hague-Visby Rules) or air conventions (Montreal Convention). Shippers are strongly advised to secure comprehensive Marine Cargo Insurance under Institute Cargo Clauses (A) prior to dispatch.
            </p>

            <h3 style="color: var(--color-midnight); font-size: 1.25rem;">5. Governing Law &amp; Jurisdiction</h3>
            <p>
                These conditions and any dispute or claim arising out of or in connection with them shall be governed by and construed in accordance with the laws of the Democratic Socialist Republic of Sri Lanka, and the parties submit to the exclusive jurisdiction of the Commercial High Court of Colombo.
            </p>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
