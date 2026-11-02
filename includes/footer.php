</main>

<!-- Institutional Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Column 1: Company Profile -->
            <div class="footer-col">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem;">
                    <img src="<?= url('assets/images/logo-spillburg-logistics.png') ?>" alt="<?= APP_LEGAL_NAME ?>" style="height: 40px; width: auto; filter: brightness(0) invert(1);" onerror="this.src='<?= url('assets/images/stitch-logo.webp') ?>'">
                    <div>
                        <div style="color: #FFFFFF; font-weight: 800; font-size: 1.125rem; line-height: 1.1;">SPILLBURG <span style="color: var(--color-amber-accent);">LOGISTICS 1</span></div>
                        <div style="font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.08em; color: #94A3B8;">(Private) Limited</div>
                    </div>
                </div>
                <p style="color: #94A3B8; font-size: 0.875rem; line-height: 1.6; margin-bottom: 1.5rem;">
                    An established freight-forwarding and cargo transportation provider operating out of the Port of Colombo transshipment gateway. We deliver structured ocean freight, air cargo coordination, inland drayage, customs clearance, and secure warehousing.
                </p>
                <div style="background-color: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); padding: 0.75rem 1rem; border-radius: var(--radius-sm); font-size: 0.75rem; font-family: var(--font-mono); color: #CBD5E1;">
                    <span style="color: var(--color-amber-accent); font-weight: 700;">REGULATORY STATUS:</span><br>
                    Licensed Sri Lanka Customs Clearing Agent &bull; ASYCUDA World EDI Integrated &bull; Port of Colombo Operator
                </div>
            </div>

            <!-- Column 2: Freight Services -->
            <div class="footer-col">
                <h4>Freight Services</h4>
                <ul class="footer-links">
                    <li><a href="<?= url('service-sea-freight.php') ?>">Ocean Freight Forwarding</a></li>
                    <li><a href="<?= url('service-air-freight.php') ?>">Air Cargo Coordination</a></li>
                    <li><a href="<?= url('service-road-freight.php') ?>">Inland Road Transport</a></li>
                    <li><a href="<?= url('service-project-cargo.php') ?>">Project Cargo &amp; Heavy Lift</a></li>
                    <li><a href="<?= url('service-customs-clearance.php') ?>">Customs Brokerage</a></li>
                    <li><a href="<?= url('service-warehousing.php') ?>">Warehousing &amp; Staging</a></li>
                    <li><a href="<?= url('services.php') ?>" style="color: var(--color-amber-accent); font-weight: 600;">Capabilities Matrix &rarr;</a></li>
                </ul>
            </div>

            <!-- Column 3: Corporate & Group -->
            <div class="footer-col">
                <h4>Navigation &amp; Group</h4>
                <ul class="footer-links">
                    <li><a href="<?= url('about.php') ?>">About Spillburg Logistics 1</a></li>
                    <li><a href="<?= url('industries.php') ?>">Industries Served</a></li>
                    <li><a href="<?= url('news.php') ?>">Port &amp; Trade Advisories</a></li>
                    <li><a href="<?= url('quote.php') ?>">Request a Freight Quote</a></li>
                    <li><a href="<?= url('contact.php') ?>">Contact Operations Desk</a></li>
                    <li><a href="<?= url('terms.php') ?>">Standard Trading Conditions</a></li>
                    <li><a href="<?= url('privacy.php') ?>">Privacy &amp; Data Protection</a></li>
                </ul>
            </div>

            <!-- Column 4: Verified Logistics Headquarters -->
            <div class="footer-col">
                <h4>Colombo Operations</h4>
                <ul class="footer-contact-list">
                    <li class="footer-contact-item">
                        <span class="material-symbols-outlined contact-icon">location_on</span>
                        <span>
                            <?= COMPANY_ADDRESS_LINE1 ?><br>
                            <?= COMPANY_ADDRESS_LINE2 ?><br>
                            <?= COMPANY_ADDRESS_CITY ?>, <?= COMPANY_ADDRESS_COUNTRY ?>
                        </span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="material-symbols-outlined contact-icon">call</span>
                        <div>
                            <div>Landline: <a href="tel:<?= str_replace(' ', '', COMPANY_PHONE_PRIMARY) ?>" style="color: #FFFFFF; font-weight: 600;"><?= COMPANY_PHONE_PRIMARY ?></a></div>
                            <div>Ops Desk: <a href="tel:<?= str_replace(' ', '', COMPANY_PHONE_OPS_1) ?>" style="color: #FFFFFF;"><?= COMPANY_PHONE_OPS_1 ?></a></div>
                            <div>Freight Desk: <a href="tel:<?= str_replace(' ', '', COMPANY_PHONE_OPS_2) ?>" style="color: #FFFFFF;"><?= COMPANY_PHONE_OPS_2 ?></a></div>
                        </div>
                    </li>
                    <li class="footer-contact-item">
                        <span class="material-symbols-outlined contact-icon">mail</span>
                        <div>
                            <a href="mailto:<?= COMPANY_EMAIL ?>" style="color: #FFFFFF; font-weight: 600;"><?= COMPANY_EMAIL ?></a>
                            <div style="font-size: 0.75rem; color: #94A3B8;">Direct inquiries &amp; Bill of Lading dockets</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <div>
                &copy; <?= date('Y') ?> <?= APP_LEGAL_NAME ?>. All rights reserved. Registered in Sri Lanka.
            </div>
            <ul class="footer-bottom-links">
                <li><a href="<?= url('privacy.php') ?>">Privacy Policy</a></li>
                <li><a href="<?= url('terms.php') ?>">Trading Terms</a></li>
                <li><a href="<?= url('sitemap.xml') ?>">Sitemap</a></li>
                <li><a href="<?= url('admin/login.php') ?>" style="opacity: 0.4;">Operations Console</a></li>
            </ul>
        </div>
    </div>

    <!-- Member of the Spillburg Group Strip - Very Bottom of Footer -->
    <div class="footer-group-strip">
        <div class="container footer-group-inner">
            <div class="group-tag">
                <img src="<?= url('assets/images/spillburg-group-mark.webp') ?>" alt="Spillburg Group" class="group-mark-img" width="16" height="16" onerror="this.style.display='none'">
                <span>A Member of the <strong>Spillburg Group</strong></span>
            </div>
            <ul class="group-links">
                <li><a href="<?= GROUP_HOLDINGS_URL ?>" target="_blank" rel="noopener">Holdings <span class="material-symbols-outlined external-icon">open_in_new</span></a></li>
                <li><a href="<?= GROUP_CORPORATE_URL ?>" target="_blank" rel="noopener">Corporate Services <span class="material-symbols-outlined external-icon">open_in_new</span></a></li>
                <li><a href="<?= GROUP_VACATION_URL ?>" target="_blank" rel="noopener">Vacation <span class="material-symbols-outlined external-icon">open_in_new</span></a></li>
                <li><span class="current-brand">Logistics 1</span></li>
            </ul>
        </div>
    </div>
</footer>

<!-- Mobile Responsive Navigation Drawer -->
<div class="mobile-nav-drawer" role="dialog" aria-modal="true" aria-label="Mobile Navigation">
    <div class="mobile-drawer-content">
        <div class="drawer-header">
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <img src="<?= url('assets/images/logo-spillburg-logistics.png') ?>" alt="<?= APP_LEGAL_NAME ?>" style="height: 32px; width: auto;" onerror="this.src='<?= url('assets/images/stitch-logo.webp') ?>'">
                <div style="font-weight: 800; font-size: 1.05rem; color: var(--color-midnight); line-height: 1.1;">
                    SPILLBURG <span style="color: var(--color-blue-industrial);">LOGISTICS 1</span>
                </div>
            </div>
            <button type="button" class="drawer-close-btn" aria-label="Close menu">
                <span class="material-symbols-outlined" style="font-size: 20px;">close</span>
            </button>
        </div>

        <div class="drawer-group-badge">
            <img src="<?= url('assets/images/spillburg-group-mark.webp') ?>" alt="Spillburg Group" width="14" height="14" onerror="this.style.display='none'">
            <span>Spillburg Group &bull; Logistics &amp; Freight Division</span>
        </div>

        <ul class="drawer-nav-list">
            <li><a href="<?= url() ?>" class="<?= is_active('') ?>"><span>Home</span><span class="material-symbols-outlined" style="font-size: 18px;">chevron_right</span></a></li>
            <li><a href="<?= url('about.php') ?>" class="<?= is_active('about') ?>"><span>About Spillburg</span><span class="material-symbols-outlined" style="font-size: 18px;">chevron_right</span></a></li>
            <li>
                <a href="<?= url('services.php') ?>" class="<?= is_active('service') ?>">
                    <span>Freight Services</span>
                    <span class="material-symbols-outlined" style="font-size: 18px;">expand_more</span>
                </a>
                <ul class="drawer-subnav-list">
                    <li><a href="<?= url('service-sea-freight.php') ?>"><span class="material-symbols-outlined subnav-icon">directions_boat</span> Sea Freight Forwarding</a></li>
                    <li><a href="<?= url('service-air-freight.php') ?>"><span class="material-symbols-outlined subnav-icon">flight_takeoff</span> Air Cargo Coordination</a></li>
                    <li><a href="<?= url('service-road-freight.php') ?>"><span class="material-symbols-outlined subnav-icon">local_shipping</span> Inland Road Transport</a></li>
                    <li><a href="<?= url('service-project-cargo.php') ?>"><span class="material-symbols-outlined subnav-icon">precision_manufacturing</span> Project Cargo &amp; Heavy Lift</a></li>
                    <li><a href="<?= url('service-customs-clearance.php') ?>"><span class="material-symbols-outlined subnav-icon">verified_user</span> Customs Brokerage</a></li>
                    <li><a href="<?= url('service-warehousing.php') ?>"><span class="material-symbols-outlined subnav-icon">warehouse</span> Warehousing &amp; Staging</a></li>
                </ul>
            </li>
            <li><a href="<?= url('industries.php') ?>" class="<?= is_active('industries') ?>"><span>Sectors Served</span><span class="material-symbols-outlined" style="font-size: 18px;">chevron_right</span></a></li>
            <li><a href="<?= url('news.php') ?>" class="<?= is_active('news') ?>"><span>Port Advisories</span><span class="material-symbols-outlined" style="font-size: 18px;">chevron_right</span></a></li>
            <li><a href="<?= url('contact.php') ?>" class="<?= is_active('contact') ?>"><span>Contact Operations</span><span class="material-symbols-outlined" style="font-size: 18px;">chevron_right</span></a></li>
        </ul>

        <div style="margin-top: auto; padding-top: 1.25rem; border-top: 1px solid var(--color-border-slate); display: flex; flex-direction: column; gap: 0.75rem;">
            <a href="<?= url('quote.php') ?>" class="btn btn-amber" style="width: 100%; text-align: center;">
                <span class="material-symbols-outlined" style="font-size: 18px;">request_quote</span>
                Request Freight Quote
            </a>
            <a href="tel:<?= str_replace(' ', '', COMPANY_PHONE_PRIMARY) ?>" class="btn btn-secondary" style="width: 100%; font-size: 0.875rem;">
                <span class="material-symbols-outlined" style="font-size: 18px;">call</span>
                Direct Desk: <?= COMPANY_PHONE_PRIMARY ?>
            </a>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?= url('assets/js/main.js') ?>?v=<?= time() ?>"></script>
<?php if (!empty($extra_scripts)): ?>
    <?= $extra_scripts ?>
<?php endif; ?>

</body>
</html>
