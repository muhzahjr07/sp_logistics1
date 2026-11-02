<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Contact Us — Operational Dispatch & Office Inquiries
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

$page_title = 'Contact Operations Desk & Colombo Office';
$page_desc = 'Contact Spillburg Logistics 1 (Private) Limited in Colombo, Sri Lanka. Direct phone lines, email dispatch, and operational inquiry handling.';

$breadcrumbs = [
    ['title' => 'Contact Us', 'url' => 'contact.php']
];

$errors = [];
$submitted = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Verify CSRF
    $csrf = $_POST['csrf_token'] ?? '';
    if (!verify_csrf_token($csrf)) {
        $errors[] = 'Security token invalid. Please reload the page.';
    }

    // 2. Anti-spam honeypot
    if (!empty($_POST['website_hp'])) {
        sleep(1);
        header('Location: ' . url('contact.php'));
        exit;
    }

    // 3. Sanitize inputs
    $name = trim((string)($_POST['name'] ?? ''));
    $company = trim((string)($_POST['company'] ?? ''));
    $email = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
    $phone = trim((string)($_POST['phone'] ?? ''));
    $subject = trim((string)($_POST['subject'] ?? ''));
    $message = trim((string)($_POST['message'] ?? ''));

    $submitted = [
        'name' => $name,
        'company' => $company,
        'email' => $email,
        'phone' => $phone,
        'subject' => $subject,
        'message' => $message,
    ];

    // 4. Validate
    if ($name === '' || strlen($name) > 120) {
        $errors[] = 'Your name is required (max 120 characters).';
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email address is required.';
    }
    if ($subject === '' || strlen($subject) > 200) {
        $errors[] = 'Please specify the subject of your inquiry.';
    }
    if ($message === '' || strlen($message) < 10) {
        $errors[] = 'Please provide details in your message (minimum 10 characters).';
    }

    // 5. Store & Notify
    if (empty($errors)) {
        try {
            $db = Database::getConnection();
            $ip_address = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

            $stmt = $db->prepare("INSERT INTO contacts (name, company, email, phone, subject, message, status, ip_address) VALUES (:name, :company, :email, :phone, :subject, :message, 'unread', :ip)");
            $stmt->execute([
                ':name' => $name,
                ':company' => $company,
                ':email' => $email,
                ':phone' => $phone,
                ':subject' => $subject,
                ':message' => $message,
                ':ip' => $ip_address
            ]);

            // Attempt mail notification
            $to = COMPANY_EMAIL;
            $mailSubject = "Website Inquiry: {$subject} [{$name}]";
            $mailBody = "New operational inquiry received from website:\n\n"
                      . "Name: {$name}\n"
                      . "Company: {$company}\n"
                      . "Email: {$email}\n"
                      . "Phone: {$phone}\n"
                      . "Subject: {$subject}\n\n"
                      . "Message:\n{$message}\n";
            $headers = "From: noreply@spillburglogistics1.com\r\nReply-To: {$email}\r\n";
            @mail($to, $mailSubject, $mailBody, $headers);

            set_flash('success', 'Thank you. Your message has been received by our Colombo operations desk. An agent will contact you shortly.');
            header('Location: ' . url('contact.php'));
            exit;
        } catch (Exception $e) {
            error_log("Contact form error: " . $e->getMessage());
            $errors[] = 'A system error occurred. Please contact us directly via telephone at ' . COMPANY_PHONE_PRIMARY . '.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-overlay" style="background-image: linear-gradient(90deg, rgba(0, 14, 31, 0.95) 0%, rgba(0, 14, 31, 0.85) 100%), url('<?= url('assets/images/about-operations.jpg') ?>');"></div>
    <div class="container">
        <div class="page-hero-content">
            <span class="technical-label amber" style="margin-bottom: 0.75rem;">
                <span class="material-symbols-outlined" style="font-size: 16px;">contact_support</span>
                DIRECT COMMUNICATIONS
            </span>
            <h1>Contact Operations Desk &amp; Colombo Office</h1>
            <p>
                Reach our logistics coordinators for urgent sailing schedules, customs clearance advice, or container tracking support.
            </p>
        </div>
    </div>
</section>

<section class="section-spacing bg-surface">
    <div class="container">
        <div class="grid-split-contact">

            <!-- Left Column: Verified Contact Information -->
            <div>
                <span class="technical-label">COLOMBO HEADQUARTERS</span>
                <h2 style="margin-top: 0.5rem; margin-bottom: 1.25rem;">
                    Get in Touch with Our Logistics Specialists
                </h2>
                <p style="font-size: 1rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 2rem;">
                    Our principal office is based in central Colombo within immediate proximity of the Sri Lanka Ports Authority, terminal gates, and the customs house.
                </p>

                <div style="display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 2.5rem;">
                    <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-md); padding: 1.5rem; display: flex; align-items: flex-start; gap: 1rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-blue-industrial); font-size: 28px; margin-top: 0.15rem;">location_on</span>
                        <div>
                            <strong style="color: var(--color-midnight); font-size: 1rem; display: block; margin-bottom: 0.25rem;">Office Location:</strong>
                            <div style="color: var(--color-text-secondary); font-size: 0.9375rem; line-height: 1.5;">
                                <?= COMPANY_ADDRESS_LINE1 ?><br>
                                <?= COMPANY_ADDRESS_LINE2 ?><br>
                                <?= COMPANY_ADDRESS_CITY ?>, <?= COMPANY_ADDRESS_COUNTRY ?>
                            </div>
                        </div>
                    </div>

                    <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-md); padding: 1.5rem; display: flex; align-items: flex-start; gap: 1rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-blue-industrial); font-size: 28px; margin-top: 0.15rem;">call</span>
                        <div>
                            <strong style="color: var(--color-midnight); font-size: 1rem; display: block; margin-bottom: 0.25rem;">Direct Telephone Lines:</strong>
                            <div style="color: var(--color-text-secondary); font-size: 0.9375rem; line-height: 1.6;">
                                <div>Landline: <a href="tel:<?= str_replace(' ', '', COMPANY_PHONE_PRIMARY) ?>" style="color: var(--color-blue-industrial); font-weight: 700;"><?= COMPANY_PHONE_PRIMARY ?></a></div>
                                <div>Logistics Hotlines: <?= COMPANY_PHONE_OPS_1 ?> &bull; <?= COMPANY_PHONE_OPS_2 ?></div>
                            </div>
                        </div>
                    </div>

                    <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-md); padding: 1.5rem; display: flex; align-items: flex-start; gap: 1rem;">
                        <span class="material-symbols-outlined" style="color: var(--color-blue-industrial); font-size: 28px; margin-top: 0.15rem;">mail</span>
                        <div>
                            <strong style="color: var(--color-midnight); font-size: 1rem; display: block; margin-bottom: 0.25rem;">Electronic Mail:</strong>
                            <div style="color: var(--color-text-secondary); font-size: 0.9375rem;">
                                <a href="mailto:<?= COMPANY_EMAIL ?>" style="color: var(--color-blue-industrial); font-weight: 700;"><?= COMPANY_EMAIL ?></a>
                                <div style="font-size: 0.8125rem; color: var(--color-text-muted); margin-top: 0.2rem;">Direct dispatch desk for documentation and shipping notices.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background-color: var(--color-navy-container); color: #FFFFFF; border-radius: var(--radius-md); padding: 1.75rem;">
                    <h3 style="color: #FFFFFF; font-size: 1.125rem; margin-bottom: 0.5rem;">
                        Need an Official Freight Rate Quotation?
                    </h3>
                    <p style="color: #CBD5E1; font-size: 0.875rem; line-height: 1.5; margin-bottom: 1.25rem;">
                        For detailed cargo pricing with container parameters and Incoterms, submit our structured RFQ form for priority pricing.
                    </p>
                    <a href="<?= url('quote.php') ?>" class="btn btn-amber" style="width: 100%; text-align: center;">
                        Open RFQ Specification Form &rarr;
                    </a>
                </div>
            </div>

            <!-- Right Column: Contact Inquiry Form -->
            <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2.5rem; box-shadow: var(--shadow-card);">
                <div style="border-bottom: 1px solid var(--color-border-slate); padding-bottom: 1rem; margin-bottom: 1.75rem;">
                    <h3 style="font-size: 1.5rem; color: var(--color-midnight);">
                        Send an Operational Message
                    </h3>
                    <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 0;">
                        Our Colombo operations coordinators review and respond during standard business hours.
                    </p>
                </div>

                <?php if (!empty($errors)): ?>
                <div class="alert alert-error" role="alert" style="margin-bottom: 1.5rem;">
                    <span class="material-symbols-outlined">error</span>
                    <div>
                        <ul style="margin: 0; padding-left: 1.25rem;">
                            <?php foreach ($errors as $err): ?>
                                <li><?= e($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>

                <form action="<?= url('contact.php') ?>" method="POST" novalidate>
                    <?= csrf_field() ?>

                    <!-- Anti-Spam Honeypot -->
                    <div style="display: none;" aria-hidden="true">
                        <label for="website_hp">Leave blank:</label>
                        <input type="text" id="website_hp" name="website_hp" tabindex="-1">
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label" for="name">Your Name <span class="required">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Ruwan Silva" value="<?= e($submitted['name'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="company">Company / Organization</label>
                            <input type="text" id="company" name="company" class="form-control" placeholder="e.g. Silva Trading Corp" value="<?= e($submitted['company'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label" for="email">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="contact@company.com" value="<?= e($submitted['email'] ?? '') ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone">Telephone Number</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="+94 77 123 4567" value="<?= e($submitted['phone'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="subject">Inquiry Subject <span class="required">*</span></label>
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="e.g. Customs Clearance Query / Port Dwell Inquiry" value="<?= e($submitted['subject'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="message">Message Details <span class="required">*</span></label>
                        <textarea id="message" name="message" class="form-control" rows="5" placeholder="Please describe your cargo inquiry, bill of lading reference, or requested assistance..." required><?= e($submitted['message'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-top: 1rem;">
                        <span class="material-symbols-outlined">send</span>
                        Transmit Message to Operations
                    </button>
                </form>
            </div>

        </div>

        <!-- Embedded Map Location (Colombo Cinnamon Lakeside Coordinates) -->
        <div style="margin-top: 4rem; background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-sm);">
            <div style="padding: 1.5rem 2rem; background-color: var(--color-surface-container); border-bottom: 1px solid var(--color-border-slate); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <strong style="color: var(--color-midnight); font-size: 1.0625rem;">Office Location &bull; Colombo 02</strong>
                    <div style="font-size: 0.8125rem; color: var(--color-text-secondary); font-family: var(--font-mono);">COORDINATES: 06°55′55″N 79°51′18″E</div>
                </div>
                <a href="https://maps.google.com/?q=Cinnamon+Lakeside+Hotel+Colombo" target="_blank" rel="noopener" class="card-link">
                    Open in Google Maps <span class="material-symbols-outlined" style="font-size: 16px;">open_in_new</span>
                </a>
            </div>
            <iframe 
                src="https://www.openstreetmap.org/export/embed.html?bbox=79.8440%2C6.9270%2C79.8580%2C6.9380&amp;layer=mapnik&amp;marker=6.9320%2C79.8510" 
                style="width: 100%; height: 380px; border: none; display: block;" 
                title="Spillburg Logistics 1 Office Location Map"
                loading="lazy">
            </iframe>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
