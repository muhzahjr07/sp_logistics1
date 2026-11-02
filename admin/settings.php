<?php
/**
 * Spillburg Logistics 1 - Admin Operational Settings
 * File: admin/settings.php
 */
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

require_admin();

$db = Database::getInstance();

// Handle Save
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_settings'])) {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('error', 'Invalid security token.');
        redirect('/admin/settings.php');
    }
    
    $editableSettings = [
        'notification_email',
        'contact_phone',
        'contact_hotline',
        'contact_email',
        'office_address',
        'route_ticker_text',
        'site_tagline',
        'colombo_terminal_status'
    ];
    
    foreach ($editableSettings as $key) {
        $val = trim($_POST[$key] ?? '');
        $stmt = $db->prepare("INSERT INTO settings (key_name, value, updated_at) VALUES (:key, :val, CURRENT_TIMESTAMP) ON CONFLICT(key_name) DO UPDATE SET value = :val, updated_at = CURRENT_TIMESTAMP");
        // For MySQL compatibility:
        if ($db->getAttribute(PDO::ATTR_DRIVER_NAME) === 'mysql') {
            $stmt = $db->prepare("INSERT INTO settings (key_name, value, updated_at) VALUES (:key, :val, CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE value = :val, updated_at = CURRENT_TIMESTAMP");
        }
        $stmt->execute([':key' => $key, ':val' => $val]);
    }
    
    set_flash('success', 'Operational settings updated successfully.');
    redirect('/admin/settings.php');
}

// Fetch Current Settings
$stmt = $db->query("SELECT key_name, value FROM settings");
$settingsMap = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $settingsMap[$row['key_name']] = $row['value'];
}

$pageTitle = 'Operational Settings';
$activeNav = 'settings';
require_once __DIR__ . '/includes/header.php';
?>

<div class="admin-header-actions">
    <div>
        <h1 class="admin-title">Operational & Site Settings</h1>
        <p class="admin-subtitle">Configure notification dispatches, company contact channels and operational ticker alerts.</p>
    </div>
</div>

<div class="admin-card" style="max-width:850px;">
    <form method="POST" action="<?= e(url('/admin/settings.php')) ?>">
        <input type="hidden" name="save_settings" value="1">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

        <!-- Section 1: Notifications & Dispatch -->
        <div style="margin-bottom:2rem; padding-bottom:1.5rem; border-bottom:1px solid #E2E8F0;">
            <h3 style="font-size:1.1rem; color:#0F172A; margin-bottom:0.5rem; display:flex; align-items:center; gap:0.5rem;">
                <span class="material-symbols-outlined" style="color:var(--color-blue-industrial); font-size:22px;">mail</span>
                Quotation Routing &amp; Notifications
            </h3>
            <p style="font-size:0.85rem; color:#64748B; margin-bottom:1.25rem;">Specify the recipient mailbox for newly submitted rate quotations and inquiries.</p>

            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">RFQ Notification Recipient Email *</label>
                <input type="email" name="notification_email" required class="form-control" value="<?= e($settingsMap['notification_email'] ?? 'quotes@spillburglogistics1.com') ?>" placeholder="e.g. quotes@spillburglogistics1.com">
                <small style="color:#64748B; font-size:0.75rem; display:block; margin-top:0.35rem;">All completed RFQ dockets trigger an immediate operational notification to this address.</small>
            </div>
        </div>

        <!-- Section 2: Verified Contact Details -->
        <div style="margin-bottom:2rem; padding-bottom:1.5rem; border-bottom:1px solid #E2E8F0;">
            <h3 style="font-size:1.1rem; color:#0F172A; margin-bottom:0.5rem; display:flex; align-items:center; gap:0.5rem;">
                <span class="material-symbols-outlined" style="color:var(--color-blue-industrial); font-size:22px;">call</span>
                Verified Company Contact Channels
            </h3>
            <p style="font-size:0.85rem; color:#64748B; margin-bottom:1.25rem;">These numbers and emails appear throughout the header, footer, contact page and quotation forms.</p>

            <div class="admin-form-grid">
                <div>
                    <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">HQ Landline Phone</label>
                    <input type="text" name="contact_phone" class="form-control" value="<?= e($settingsMap['contact_phone'] ?? '+94 11 2336116') ?>">
                </div>

                <div>
                    <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">Freight Operations Mobile / 24/7 Hotline</label>
                    <input type="text" name="contact_hotline" class="form-control" value="<?= e($settingsMap['contact_hotline'] ?? '+94 777 487720') ?>">
                </div>
            </div>

            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">General Inquiries Mailbox</label>
                <input type="email" name="contact_email" class="form-control" value="<?= e($settingsMap['contact_email'] ?? 'info@spillburglogistics1.com') ?>">
            </div>

            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">Registered Colombo Operating Office Address</label>
                <textarea name="office_address" rows="2" class="form-control"><?= e($settingsMap['office_address'] ?? 'Office 14, Basement Level, Cinnamon Lakeside Hotel, No 115, Sir Chittampalam A Gardiner Mawatha, Colombo 02, Sri Lanka') ?></textarea>
            </div>
        </div>

        <!-- Section 3: Operational Ticker & Status -->
        <div style="margin-bottom:2rem;">
            <h3 style="font-size:1.1rem; color:#0F172A; margin-bottom:0.5rem; display:flex; align-items:center; gap:0.5rem;">
                <span class="material-symbols-outlined" style="color:var(--color-blue-industrial); font-size:22px;">schedule</span>
                Maritime Operational Ticker
            </h3>
            <p style="font-size:0.85rem; color:#64748B; margin-bottom:1.25rem;">Dynamic updates displayed across the website header and operational status boards.</p>

            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">Colombo Maritime Corridor Status</label>
                <input type="text" name="colombo_terminal_status" class="form-control" value="<?= e($settingsMap['colombo_terminal_status'] ?? 'Port of Colombo Berthing Windows: Clear & Active') ?>">
            </div>

            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">Top Bar Live Ticker Notice</label>
                <input type="text" name="route_ticker_text" class="form-control" value="<?= e($settingsMap['route_ticker_text'] ?? 'Direct Feeder & Trunk Vessel Bookings Open Across Indian Ocean & Global Corridors') ?>">
            </div>

            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">Primary Brand Tagline</label>
                <input type="text" name="site_tagline" class="form-control" value="<?= e($settingsMap['site_tagline'] ?? 'Moving Cargo. Connecting Businesses.') ?>">
            </div>
        </div>

        <div style="display:flex; justify-content:flex-end;">
            <button type="submit" class="btn btn-primary btn-lg">
                <span class="material-symbols-outlined" style="font-size: 18px;">save</span>
                Save Configuration
            </button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
