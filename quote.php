<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Request a Quote — Comprehensive RFQ Processing Engine
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

$page_title = 'Request a Logistics & Freight Quotation';
$page_desc = 'Submit cargo parameters, container specifications, and transit routes to Spillburg Logistics 1 for a verified multi-modal freight quotation.';

$breadcrumbs = [
    ['title' => 'Request a Quote', 'url' => 'quote.php']
];

$errors = [];
$success_docket = null;
$submitted_data = [];

// Pre-fill query parameters if coming from service/industry links
$default_mode = $_GET['mode'] ?? 'sea';
if (!in_array($default_mode, ['sea', 'air', 'road', 'project'])) {
    $default_mode = 'sea';
}
$default_commodity = $_GET['commodity'] ?? '';
$default_customs = isset($_GET['customs']) ? 1 : 0;
$default_warehousing = isset($_GET['warehousing']) ? 1 : 0;

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Verify CSRF Token
    $csrf = $_POST['csrf_token'] ?? '';
    if (!verify_csrf_token($csrf)) {
        $errors[] = 'Security token invalid or expired. Please reload the form and try again.';
    }

    // 2. Anti-Spam Honeypot check
    if (!empty($_POST['website_hp'])) {
        // Silent rejection for bots
        sleep(1);
        header('Location: ' . url('quote.php'));
        exit;
    }

    // 3. Extract & Sanitize Inputs
    $full_name = trim((string)($_POST['full_name'] ?? ''));
    $company_name = trim((string)($_POST['company_name'] ?? ''));
    $email = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
    $phone = trim((string)($_POST['phone'] ?? ''));
    $country = trim((string)($_POST['country'] ?? ''));

    $origin_pol = trim((string)($_POST['origin_pol'] ?? ''));
    $destination_pod = trim((string)($_POST['destination_pod'] ?? ''));
    $incoterm = trim((string)($_POST['incoterm'] ?? 'FOB'));
    $target_etd = trim((string)($_POST['target_etd'] ?? ''));

    $freight_mode = trim((string)($_POST['freight_mode'] ?? 'sea'));
    if (!in_array($freight_mode, ['sea', 'air', 'road', 'project'])) {
        $freight_mode = 'sea';
    }
    $commodity = trim((string)($_POST['commodity'] ?? ''));
    $container_type = trim((string)($_POST['container_type'] ?? ''));
    $gross_weight = trim((string)($_POST['gross_weight'] ?? ''));
    $total_volume = trim((string)($_POST['total_volume'] ?? ''));
    $package_count = trim((string)($_POST['package_count'] ?? ''));

    $req_customs = !empty($_POST['req_customs']) ? 1 : 0;
    $req_insurance = !empty($_POST['req_insurance']) ? 1 : 0;
    $req_warehousing = !empty($_POST['req_warehousing']) ? 1 : 0;
    $req_delivery = !empty($_POST['req_delivery']) ? 1 : 0;
    $special_instructions = trim((string)($_POST['special_instructions'] ?? ''));
    $agree_terms = !empty($_POST['agree_terms']) ? 1 : 0;

    // Preserve submitted values for repopulation
    $submitted_data = [
        'full_name' => $full_name,
        'company_name' => $company_name,
        'email' => $email,
        'phone' => $phone,
        'country' => $country,
        'origin_pol' => $origin_pol,
        'destination_pod' => $destination_pod,
        'incoterm' => $incoterm,
        'target_etd' => $target_etd,
        'freight_mode' => $freight_mode,
        'commodity' => $commodity,
        'container_type' => $container_type,
        'gross_weight' => $gross_weight,
        'total_volume' => $total_volume,
        'package_count' => $package_count,
        'req_customs' => $req_customs,
        'req_insurance' => $req_insurance,
        'req_warehousing' => $req_warehousing,
        'req_delivery' => $req_delivery,
        'special_instructions' => $special_instructions,
    ];

    // 4. Server-Side Validation
    if ($full_name === '' || strlen($full_name) > 120) {
        $errors[] = 'Full name is required (max 120 characters).';
    }
    if ($company_name === '' || strlen($company_name) > 150) {
        $errors[] = 'Company or business name is required (max 150 characters).';
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid corporate email address is required.';
    }
    if ($phone === '' || strlen($phone) > 50) {
        $errors[] = 'A valid telephone / WhatsApp number is required.';
    }
    if ($origin_pol === '') {
        $errors[] = 'Origin Location / Port of Loading (POL) is required.';
    }
    if ($destination_pod === '') {
        $errors[] = 'Destination Location / Port of Discharge (POD) is required.';
    }
    if ($commodity === '') {
        $errors[] = 'Commodity description or category is required.';
    }
    if (!$agree_terms) {
        $errors[] = 'Please acknowledge that cargo is subject to standard maritime terms and inspection.';
    }

    // 5. Store in Database if valid
    if (empty($errors)) {
        try {
            $db = Database::getConnection();

            // Generate Unique Docket: RFQ-SL1-YYYY-XXXX (where XXXX is a unique random code)
            $year = date('Y');
            $randomCode = strtoupper(bin2hex(random_bytes(2)));
            $docket_number = "RFQ-SL1-{$year}-{$randomCode}";

            // Ensure uniqueness
            $check = $db->prepare("SELECT COUNT(*) FROM quotes WHERE docket_number = :doc");
            $check->execute([':doc' => $docket_number]);
            if ((int)$check->fetchColumn() > 0) {
                $docket_number = "RFQ-SL1-{$year}-" . strtoupper(bin2hex(random_bytes(3)));
            }

            $ip_address = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            $user_agent = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 250);

            $stmt = $db->prepare("INSERT INTO quotes (
                docket_number, full_name, company_name, email, phone, country,
                origin_pol, destination_pod, incoterm, target_etd, freight_mode,
                commodity, container_type, gross_weight, total_volume, package_count,
                req_customs, req_insurance, req_warehousing, req_delivery,
                special_instructions, status, ip_address, user_agent
            ) VALUES (
                :docket_number, :full_name, :company_name, :email, :phone, :country,
                :origin_pol, :destination_pod, :incoterm, :target_etd, :freight_mode,
                :commodity, :container_type, :gross_weight, :total_volume, :package_count,
                :req_customs, :req_insurance, :req_warehousing, :req_delivery,
                :special_instructions, 'pending', :ip_address, :user_agent
            )");

            $stmt->execute([
                ':docket_number' => $docket_number,
                ':full_name' => $full_name,
                ':company_name' => $company_name,
                ':email' => $email,
                ':phone' => $phone,
                ':country' => $country,
                ':origin_pol' => $origin_pol,
                ':destination_pod' => $destination_pod,
                ':incoterm' => $incoterm,
                ':target_etd' => $target_etd,
                ':freight_mode' => $freight_mode,
                ':commodity' => $commodity,
                ':container_type' => $container_type,
                ':gross_weight' => $gross_weight,
                ':total_volume' => $total_volume,
                ':package_count' => $package_count,
                ':req_customs' => $req_customs,
                ':req_insurance' => $req_insurance,
                ':req_warehousing' => $req_warehousing,
                ':req_delivery' => $req_delivery,
                ':special_instructions' => $special_instructions,
                ':ip_address' => $ip_address,
                ':user_agent' => $user_agent,
            ]);

            // 6. Configurable Notification Dispatch
            $to = COMPANY_NOTIFICATION_EMAIL;
            $subject = "New RFQ Registered: {$docket_number} [{$company_name} - {$freight_mode}]";
            $messageBody = "A new Request for Freight Quote has been logged in the Spillburg Logistics 1 operational system.\n\n"
                . "Docket Number: {$docket_number}\n"
                . "Company: {$company_name}\n"
                . "Contact: {$full_name} ({$email} / {$phone})\n"
                . "Route: {$origin_pol} -> {$destination_pod}\n"
                . "Mode: {$freight_mode}\n"
                . "Commodity: {$commodity}\n"
                . "Incoterm: {$incoterm}\n"
                . "Container: {$container_type}\n"
                . "Weight/Volume: {$gross_weight} / {$total_volume}\n"
                . "Customs: " . ($req_customs ? 'YES' : 'NO') . "\n"
                . "Special Notes: {$special_instructions}\n\n"
                . "View this docket in the operations console: " . url('admin/quote-view.php?docket=' . urlencode($docket_number));

            $headers = "From: noreply@spillburglogistics1.com\r\n"
                     . "Reply-To: {$email}\r\n"
                     . "X-Mailer: Spillburg Logistics 1 RFQ Engine\r\n";

            // Attempt mail delivery, log if unconfigured
            @mail($to, $subject, $messageBody, $headers);

            // Log operational record
            $logDir = __DIR__ . '/logs';
            if (!is_dir($logDir)) {
                @mkdir($logDir, 0755, true);
            }
            @file_put_contents(
                $logDir . '/rfq_activity.log',
                "[" . date('Y-m-d H:i:s') . "] RFQ Docket {$docket_number} logged for {$company_name} ({$email})\n",
                FILE_APPEND
            );

            // Set confirmation state
            $success_docket = [
                'docket_number' => $docket_number,
                'data' => $submitted_data
            ];

        } catch (Exception $e) {
            error_log("Database error storing quote: " . $e->getMessage());
            $errors[] = 'A system error occurred while registering your RFQ docket. Please contact our Colombo operations desk directly at ' . COMPANY_PHONE_PRIMARY . '.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-overlay" style="background-image: linear-gradient(90deg, rgba(0, 14, 31, 0.95) 0%, rgba(0, 14, 31, 0.85) 100%), url('<?= url('assets/images/hero-colombo-port.webp') ?>');"></div>
    <div class="container">
        <div class="page-hero-content">
            <span class="technical-label amber" style="margin-bottom: 0.75rem;">
                <span class="material-symbols-outlined" style="font-size: 16px;">receipt_long</span>
                TRANSACTIONAL QUOTATION DOCKET
            </span>
            <h1>Request a Logistics &amp; Freight Quotation</h1>
            <p>
                Submit your comprehensive cargo parameters, container requirements, and transit route specifications for a verified, multi-modal commercial quotation.
            </p>
        </div>
    </div>
</section>

<section class="section-spacing bg-surface">
    <div class="container container-narrow">

        <?php if (!empty($errors)): ?>
        <div class="alert alert-error" role="alert" style="margin-bottom: 2rem;">
            <span class="material-symbols-outlined" style="font-size: 24px;">error</span>
            <div>
                <strong>Please correct the following errors before transmitting your RFQ:</strong>
                <ul style="margin-top: 0.5rem; padding-left: 1.25rem;">
                    <?php foreach ($errors as $err): ?>
                        <li><?= e($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($success_docket): ?>
        <!-- Success Confirmation State Matching Stitch Specification -->
        <div class="docket-receipt-box">
            <div class="docket-header">
                <div>
                    <span class="technical-label" style="color: var(--color-success); margin-bottom: 0.25rem;">
                        <span class="material-symbols-outlined" style="font-size: 18px;">check_circle</span>
                        TRANSMISSION VERIFIED
                    </span>
                    <h2 style="font-size: 1.75rem; margin-top: 0.25rem;">RFQ Docket Registered Successfully</h2>
                </div>
                <div class="docket-number-pill">
                    <?= e($success_docket['docket_number']) ?>
                </div>
            </div>

            <p style="font-size: 1rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 2rem;">
                Your Request for Quotation docket has been registered with the Spillburg Logistics 1 operations desk. Our freight managers are calculating liner carrier allocations, port terminal fees, and customs brokerage schedules.
            </p>

            <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-md); padding: 1.75rem; margin-bottom: 2rem;">
                <h3 style="font-size: 1.125rem; margin-bottom: 1rem; color: var(--color-midnight);">
                    Registered Consignment Summary
                </h3>
                <div class="grid-2-col" style="gap: 1rem; font-size: 0.875rem;">
                    <div>
                        <strong style="color: var(--color-text-muted);">Shipper / Entity:</strong><br>
                        <?= e($success_docket['data']['company_name']) ?> (Attn: <?= e($success_docket['data']['full_name']) ?>)
                    </div>
                    <div>
                        <strong style="color: var(--color-text-muted);">Notification Email:</strong><br>
                        <?= e($success_docket['data']['email']) ?>
                    </div>
                    <div>
                        <strong style="color: var(--color-text-muted);">Transit Route:</strong><br>
                        <?= e($success_docket['data']['origin_pol']) ?> &rarr; <?= e($success_docket['data']['destination_pod']) ?>
                    </div>
                    <div>
                        <strong style="color: var(--color-text-muted);">Freight Mode &bull; Incoterm:</strong><br>
                        <?= strtoupper(e($success_docket['data']['freight_mode'])) ?> FREIGHT &bull; <?= e($success_docket['data']['incoterm']) ?>
                    </div>
                    <div>
                        <strong style="color: var(--color-text-muted);">Commodity Category:</strong><br>
                        <?= e($success_docket['data']['commodity']) ?>
                    </div>
                    <div>
                        <strong style="color: var(--color-text-muted);">Cargo Specs:</strong><br>
                        <?= !empty($success_docket['data']['gross_weight']) ? e($success_docket['data']['gross_weight']) : 'TBD' ?> &bull; 
                        <?= !empty($success_docket['data']['total_volume']) ? e($success_docket['data']['total_volume']) : 'TBD' ?>
                    </div>
                </div>
            </div>

            <!-- What Happens After Submitting Section -->
            <div style="border-top: 1px solid var(--color-border-slate); padding-top: 1.75rem; margin-bottom: 2rem;">
                <h4 style="font-size: 1.0625rem; margin-bottom: 1rem; color: var(--color-midnight);">
                    What Happens After Submitting?
                </h4>
                <div class="grid-3-col" style="gap: 1.5rem;">
                    <div>
                        <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-blue-industrial); font-family: var(--font-mono);">PHASE 01</div>
                        <strong style="display: block; font-size: 0.9375rem; margin-top: 0.2rem;">Route Verification</strong>
                        <p style="font-size: 0.8125rem; color: var(--color-text-secondary); margin-top: 0.25rem;">
                            Operations desk evaluates carrier vessel space cut-offs and transshipment dwell times.
                        </p>
                    </div>
                    <div>
                        <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-blue-industrial); font-family: var(--font-mono);">PHASE 02</div>
                        <strong style="display: block; font-size: 0.9375rem; margin-top: 0.2rem;">Tariff Calculation</strong>
                        <p style="font-size: 0.8125rem; color: var(--color-text-secondary); margin-top: 0.25rem;">
                            Itemized quotation compiled covering ocean freight, bunker adjustment (BAF), terminal handling (THC), and customs.
                        </p>
                    </div>
                    <div>
                        <div style="font-size: 0.75rem; font-weight: 700; color: var(--color-blue-industrial); font-family: var(--font-mono);">PHASE 03</div>
                        <strong style="display: block; font-size: 0.9375rem; margin-top: 0.2rem;">Commercial Transmit</strong>
                        <p style="font-size: 0.8125rem; color: var(--color-text-secondary); margin-top: 0.25rem;">
                            Official quotation transmitted to your corporate email within 1 business day.
                        </p>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 1rem; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <button type="button" onclick="window.print();" class="btn btn-secondary">
                    <span class="material-symbols-outlined" style="font-size: 18px;">print</span>
                    Print Docket Copy
                </button>
                <a href="<?= url('quote.php') ?>" class="btn btn-primary">
                    Submit Another Consignment
                </a>
            </div>
        </div>

        <?php else: ?>

        <!-- Structured 4-Step Interactive RFQ Form -->
        <div class="quote-wizard-container">
            <div class="wizard-header">
                <span class="technical-label amber" style="margin-bottom: 0.5rem;">
                    <span class="material-symbols-outlined" style="font-size: 16px;">tune</span>
                    MULTI-STEP SPECIFICATION WIZARD
                </span>
                <h2 style="color: #FFFFFF; font-size: 1.75rem; margin-top: 0.25rem;">
                    Register Cargo Docket
                </h2>
                <p style="color: #CBD5E1; font-size: 0.9375rem; margin-bottom: 0;">
                    Complete all steps to allow our operations desk to accurately price your route and equipment requirements.
                </p>
            </div>

            <!-- Steps Tabs Indicator -->
            <div class="wizard-steps-indicator" role="tablist">
                <div class="wizard-step-tab active" data-step="1" role="tab">
                    <div class="step-circle">1</div>
                    <span>1. Contact Profile</span>
                </div>
                <div class="wizard-step-tab" data-step="2" role="tab">
                    <div class="step-circle">2</div>
                    <span>2. Transit Route</span>
                </div>
                <div class="wizard-step-tab" data-step="3" role="tab">
                    <div class="step-circle">3</div>
                    <span>3. Cargo Specs</span>
                </div>
                <div class="wizard-step-tab" data-step="4" role="tab">
                    <div class="step-circle">4</div>
                    <span>4. Value-Added</span>
                </div>
            </div>

            <form action="<?= url('quote.php') ?>" method="POST" id="quoteForm" novalidate>
                <?= csrf_field() ?>

                <!-- Anti-Spam Honeypot (hidden from human users) -->
                <div style="display: none;" aria-hidden="true">
                    <label for="website_hp">Leave empty:</label>
                    <input type="text" id="website_hp" name="website_hp" tabindex="-1" autocomplete="off">
                </div>

                <div class="wizard-body">

                    <!-- STEP 1: Contact & Company Profile -->
                    <div class="wizard-step-pane" data-step="1">
                        <div class="form-section-title">
                            <span class="material-symbols-outlined" style="color: var(--color-blue-industrial);">person</span>
                            Contact &amp; Company Profile
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label" for="full_name">Full Name <span class="required">*</span></label>
                                <input type="text" id="full_name" name="full_name" class="form-control" placeholder="e.g. David Wickramasinghe" value="<?= e($submitted_data['full_name'] ?? '') ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="company_name">Company / Business Name <span class="required">*</span></label>
                                <input type="text" id="company_name" name="company_name" class="form-control" placeholder="e.g. Apex Apparel Exports Ltd." value="<?= e($submitted_data['company_name'] ?? '') ?>" required>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label" for="email">Corporate Email Address <span class="required">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="logistics@company.com" value="<?= e($submitted_data['email'] ?? '') ?>" required>
                                <span class="form-hint">Official quotation docket will be dispatched to this email.</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="phone">Telephone / WhatsApp Number <span class="required">*</span></label>
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="+94 77 123 4567" value="<?= e($submitted_data['phone'] ?? '') ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="country">Country of Origin / Issuing Headquarter</label>
                            <input type="text" id="country" name="country" class="form-control" placeholder="e.g. Sri Lanka, United Kingdom, United States" value="<?= e($submitted_data['country'] ?? 'Sri Lanka') ?>">
                        </div>
                    </div>

                    <!-- STEP 2: Route & Transit Details -->
                    <div class="wizard-step-pane" data-step="2" style="display: none;">
                        <div class="form-section-title">
                            <span class="material-symbols-outlined" style="color: var(--color-blue-industrial);">route</span>
                            Route &amp; Transit Details
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label" for="origin_pol">Origin Location / Port of Loading (POL) <span class="required">*</span></label>
                                <input type="text" id="origin_pol" name="origin_pol" class="form-control" placeholder="e.g. Colombo (LKCMB) or Shanghai (CNSHA)" value="<?= e($submitted_data['origin_pol'] ?? '') ?>" required>
                                <span class="form-hint">Specify exact port code or city if inland.</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="destination_pod">Destination Location / Port of Discharge (POD) <span class="required">*</span></label>
                                <input type="text" id="destination_pod" name="destination_pod" class="form-control" placeholder="e.g. Rotterdam (NLRTM) or New York (USNYC)" value="<?= e($submitted_data['destination_pod'] ?? '') ?>" required>
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label" for="incoterm">Governing Incoterms&reg; (2020) <span class="required">*</span></label>
                                <select id="incoterm" name="incoterm" class="form-control" required>
                                    <?php
                                    $incoterms = ['FOB' => 'FOB — Free on Board', 'CIF' => 'CIF — Cost, Insurance & Freight', 'EXW' => 'EXW — Ex Works', 'CFR' => 'CFR — Cost and Freight', 'DDP' => 'DDP — Delivered Duty Paid', 'DAP' => 'DAP — Delivered at Place', 'FCA' => 'FCA — Free Carrier', 'FAS' => 'FAS — Free Alongside Ship'];
                                    $selected_incoterm = $submitted_data['incoterm'] ?? 'FOB';
                                    foreach ($incoterms as $k => $v) {
                                        $sel = ($selected_incoterm === $k) ? ' selected' : '';
                                        echo "<option value=\"{$k}\"{$sel}>{$v}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="target_etd">Target Cargo Readiness / Estimated ETD</label>
                                <input type="date" id="target_etd" name="target_etd" class="form-control" value="<?= e($submitted_data['target_etd'] ?? date('Y-m-d', strtotime('+7 days'))) ?>">
                            </div>
                        </div>
                    </div>

                    <!-- STEP 3: Cargo & Shipment Specifications -->
                    <div class="wizard-step-pane" data-step="3" style="display: none;">
                        <div class="form-section-title">
                            <span class="material-symbols-outlined" style="color: var(--color-blue-industrial);">inventory_2</span>
                            Cargo &amp; Shipment Specifications
                        </div>

                        <label class="form-label" style="margin-bottom: 0.75rem; display: block;">Select Primary Transport Mode <span class="required">*</span></label>
                        <div class="mode-cards-grid">
                            <?php
                            $selected_mode = $submitted_data['freight_mode'] ?? $default_mode;
                            $modes = [
                                'sea' => ['icon' => 'directions_boat', 'title' => 'Sea Freight', 'sub' => 'FCL / LCL Ocean'],
                                'air' => ['icon' => 'flight_takeoff', 'title' => 'Air Cargo', 'sub' => 'Scheduled / Express'],
                                'road' => ['icon' => 'local_shipping', 'title' => 'Inland Haulage', 'sub' => 'Port / Island Drayage'],
                                'project' => ['icon' => 'precision_manufacturing', 'title' => 'Project Cargo', 'sub' => 'Heavy Lift / OOG']
                            ];
                            foreach ($modes as $key => $m):
                                $checked = ($selected_mode === $key) ? ' checked' : '';
                            ?>
                            <label class="mode-radio-label">
                                <input type="radio" name="freight_mode" value="<?= $key ?>" class="mode-radio-input" <?= $checked ?>>
                                <div class="mode-card">
                                    <span class="material-symbols-outlined mode-icon"><?= $m['icon'] ?></span>
                                    <div class="mode-card-title"><?= $m['title'] ?></div>
                                    <div class="mode-card-sub"><?= $m['sub'] ?></div>
                                </div>
                            </label>
                            <?php endforeach; ?>
                        </div>

                        <div class="form-grid-2">
                            <div class="form-group">
                                <label class="form-label" for="commodity">Commodity Category &amp; Description <span class="required">*</span></label>
                                <input type="text" id="commodity" name="commodity" class="form-control" placeholder="e.g. Knitted Garments, Industrial Pumps, Tea" value="<?= e($submitted_data['commodity'] ?? $default_commodity) ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="container_type">Container Type / Packaging Method</label>
                                <select id="container_type" name="container_type" class="form-control">
                                    <option value="40_HC">40' High Cube (HC) Container</option>
                                    <option value="20_GP">20' Standard General Purpose (GP)</option>
                                    <option value="40_GP">40' Standard General Purpose (GP)</option>
                                    <option value="40_REEFER">40' Refrigerated Container (Reefer)</option>
                                    <option value="FLAT_RACK">Flat Rack / Open Top (OOG)</option>
                                    <option value="LCL_PALLET">Palletized LCL / Wooden Crates</option>
                                    <option value="LOOSE_CARTON">Loose Cartons / Breakbulk</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-grid-3">
                            <div class="form-group">
                                <label class="form-label" for="gross_weight">Total Gross Weight</label>
                                <input type="text" id="gross_weight" name="gross_weight" class="form-control" placeholder="e.g. 18,500 kg" value="<?= e($submitted_data['gross_weight'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="total_volume">Total Volume (CBM)</label>
                                <input type="text" id="total_volume" name="total_volume" class="form-control" placeholder="e.g. 65 CBM" value="<?= e($submitted_data['total_volume'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="package_count">Package / Unit Count</label>
                                <input type="text" id="package_count" name="package_count" class="form-control" placeholder="e.g. 540 Cartons" value="<?= e($submitted_data['package_count'] ?? '') ?>">
                            </div>
                        </div>
                    </div>

                    <!-- STEP 4: Value-Added Requirements & Instructions -->
                    <div class="wizard-step-pane" data-step="4" style="display: none;">
                        <div class="form-section-title">
                            <span class="material-symbols-outlined" style="color: var(--color-blue-industrial);">add_task</span>
                            Value-Added Requirements &amp; Instructions
                        </div>

                        <label class="form-label" style="margin-bottom: 0.75rem; display: block;">Select Ancillary Services Required</label>
                        <div class="checkbox-grid">
                            <label class="checkbox-card">
                                <input type="checkbox" name="req_customs" value="1" <?= (!empty($submitted_data['req_customs']) || $default_customs) ? 'checked' : '' ?>>
                                <div class="checkbox-card-info">
                                    <h5>Sri Lanka Customs Brokerage</h5>
                                    <p>Electronic ASYCUDA World declaration, tariff review, and port gate pass endorsement.</p>
                                </div>
                            </label>

                            <label class="checkbox-card">
                                <input type="checkbox" name="req_insurance" value="1" <?= !empty($submitted_data['req_insurance']) ? 'checked' : '' ?>>
                                <div class="checkbox-card-info">
                                    <h5>Marine Cargo Insurance</h5>
                                    <p>Institute Cargo Clauses (A) all-risk protection throughout maritime and inland passage.</p>
                                </div>
                            </label>

                            <label class="checkbox-card">
                                <input type="checkbox" name="req_warehousing" value="1" <?= (!empty($submitted_data['req_warehousing']) || $default_warehousing) ? 'checked' : '' ?>>
                                <div class="checkbox-card-info">
                                    <h5>Warehousing &amp; Buffer Storage</h5>
                                    <p>Bonded warehouse devanning, export palletization, and buffer inventory holding in Colombo.</p>
                                </div>
                            </label>

                            <label class="checkbox-card">
                                <input type="checkbox" name="req_delivery" value="1" <?= !empty($submitted_data['req_delivery']) ? 'checked' : '' ?>>
                                <div class="checkbox-card-info">
                                    <h5>Last-Mile Factory Delivery</h5>
                                    <p>Dedicated prime mover or multi-axle trailer delivery direct to manufacturing facility.</p>
                                </div>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="special_instructions">Special Instructions &amp; Cargo Handling Notes</label>
                            <textarea id="special_instructions" name="special_instructions" class="form-control" placeholder="Specify temperature set-points, stacking limits, hazardous classes, or required discharge deadlines..."><?= e($submitted_data['special_instructions'] ?? '') ?></textarea>
                        </div>

                        <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-sm); padding: 1.25rem; margin-top: 1.5rem;">
                            <label style="display: flex; align-items: flex-start; gap: 0.75rem; cursor: pointer; font-size: 0.875rem; color: var(--color-text-secondary); line-height: 1.5;">
                                <input type="checkbox" name="agree_terms" value="1" required style="width: 18px; height: 18px; margin-top: 0.15rem; accent-color: var(--color-blue-industrial);">
                                <span>
                                    I confirm that the submitted cargo specifications are accurate to the best of my knowledge and understand that final quotations are subject to carrier space availability, equipment confirmation, and <a href="<?= url('terms.php') ?>" target="_blank" style="color: var(--color-blue-industrial); font-weight: 600; text-decoration: underline;">Standard Trading Conditions</a>.
                                </span>
                            </label>
                        </div>
                    </div>

                    <!-- Wizard Navigation Buttons -->
                    <div class="wizard-actions">
                        <button type="button" id="prevStepBtn" class="btn btn-secondary" style="visibility: hidden;">
                            &larr; Previous Step
                        </button>
                        <div>
                            <button type="button" id="nextStepBtn" class="btn btn-primary">
                                Next Step &rarr;
                            </button>
                            <button type="submit" id="submitRfqBtn" class="btn btn-amber btn-lg" style="display: none;">
                                <span class="material-symbols-outlined">send</span>
                                Transmit RFQ to Operations
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php
$extra_scripts = '<script src="' . url('assets/js/quote.js') . '?v=' . time() . '"></script>';
require_once __DIR__ . '/includes/footer.php';
?>
