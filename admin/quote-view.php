<?php
/**
 * Spillburg Logistics 1 - Admin Single RFQ Docket Inspector
 * File: admin/quote-view.php
 */
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

require_admin();

$db = Database::getInstance();
$id = (int)($_GET['id'] ?? 0);
$docket = trim($_GET['docket'] ?? '');

if ($id > 0) {
    $stmt = $db->prepare("SELECT * FROM quotes WHERE id = :id");
    $stmt->execute([':id' => $id]);
} elseif ($docket !== '') {
    $stmt = $db->prepare("SELECT * FROM quotes WHERE docket_number = :doc");
    $stmt->execute([':doc' => $docket]);
} else {
    set_flash('error', 'Invalid Quotation Docket identifier.');
    redirect('/admin/quotes.php');
}

$quote = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$quote) {
    set_flash('error', 'The requested Quotation Docket does not exist.');
    redirect('/admin/quotes.php');
}

$id = (int)$quote['id'];

// Handle Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_docket') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('error', 'Security token expired. Please retry.');
        redirect('/admin/quote-view.php?id=' . $id);
    }
    
    $newStatus = trim($_POST['status'] ?? $quote['status']);
    $notes = trim($_POST['operations_notes'] ?? '');
    
    $updateStmt = $db->prepare("UPDATE quotes SET status = :status, operations_notes = :notes WHERE id = :id");
    $updateStmt->execute([
        ':status' => $newStatus,
        ':notes' => $notes,
        ':id' => $id
    ]);
    
    set_flash('success', 'Quotation Docket #' . $quote['docket_number'] . ' successfully updated.');
    redirect('/admin/quote-view.php?id=' . $id);
}

$pageTitle = 'Docket ' . $quote['docket_number'] . ' - Inspection';
$activeNav = 'quotes';
require_once __DIR__ . '/includes/header.php';
?>

<div class="admin-header-actions">
    <div>
        <div style="font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#245B82; letter-spacing:0.05em; margin-bottom:0.25rem;">
            Commercial Rate Docket &bull; Reference #<?= e($quote['docket_number']) ?>
        </div>
        <h1 class="admin-title">RFQ Docket Inspection</h1>
        <p class="admin-subtitle">Submitted on <?= date('F j, Y \a\t H:i T', strtotime($quote['created_at'])) ?></p>
    </div>
    <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
        <a href="<?= e(url('/admin/quotes.php')) ?>" class="btn btn-secondary btn-sm">
            <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
            Back to RFQ List
        </a>
        <a href="mailto:<?= e($quote['email']) ?>?subject=<?= urlencode('Spillburg Logistics 1 - Rate Quotation ' . $quote['docket_number']) ?>" class="btn btn-primary btn-sm">
            <span class="material-symbols-outlined" style="font-size:18px;">mail</span>
            Email Shipper
        </a>
    </div>
</div>

<div class="admin-split">
    <!-- Left Column: Full Specifications -->
    <div style="display:flex; flex-direction:column; gap:1.5rem;">
        
        <!-- Shipper & Organization Details -->
        <div class="admin-card">
            <h2 style="font-size:1.1rem; color:#0F172A; margin-bottom:1rem; padding-bottom:0.75rem; border-bottom:1px solid #E2E8F0; display:flex; align-items:center; gap:0.5rem;">
                <span class="material-symbols-outlined" style="color:var(--color-blue-industrial); font-size:22px;">person</span>
                Shipper Identification &amp; Contact
            </h2>
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:1.25rem;">
                <div>
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B;">Contact Person</div>
                    <div style="font-size:1rem; font-weight:600; color:#0F172A; margin-top:0.25rem;"><?= e($quote['full_name']) ?></div>
                </div>
                <div>
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B;">Registered Enterprise</div>
                    <div style="font-size:1rem; font-weight:600; color:#0F172A; margin-top:0.25rem;"><?= e($quote['company_name'] ?: 'Private Individual Shipper') ?></div>
                </div>
                <div>
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B;">Commercial Email</div>
                    <div style="font-size:0.95rem; font-weight:500; color:#245B82; margin-top:0.25rem;">
                        <a href="mailto:<?= e($quote['email']) ?>" style="color:inherit; text-decoration:none;"><?= e($quote['email']) ?></a>
                    </div>
                </div>
                <div>
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B;">Telephone / WhatsApp</div>
                    <div style="font-size:0.95rem; font-weight:500; color:#0F172A; margin-top:0.25rem;">
                        <a href="tel:<?= e($quote['phone']) ?>" style="color:inherit; text-decoration:none;"><?= e($quote['phone']) ?></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transit Routing & Service Mode -->
        <div class="admin-card">
            <h2 style="font-size:1.1rem; color:#0F172A; margin-bottom:1rem; padding-bottom:0.75rem; border-bottom:1px solid #E2E8F0; display:flex; align-items:center; gap:0.5rem;">
                <span class="material-symbols-outlined" style="color:var(--color-blue-industrial); font-size:22px;">explore</span>
                Corridor &amp; Service Mode
            </h2>
            <div class="admin-form-grid" style="margin-bottom:1.5rem;">
                <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:6px; padding:1.25rem;">
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B;">Port of Loading (POL) / Origin</div>
                    <div style="font-size:1.25rem; font-weight:700; color:#0F172A; margin-top:0.35rem;"><?= e($quote['origin_pol']) ?></div>
                </div>
                <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:6px; padding:1.25rem;">
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B;">Port of Discharge (POD) / Destination</div>
                    <div style="font-size:1.25rem; font-weight:700; color:#0F172A; margin-top:0.35rem;"><?= e($quote['destination_pod']) ?></div>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:1rem;">
                <div>
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B;">Primary Transport Mode</div>
                    <div style="font-size:0.95rem; font-weight:600; color:#0F172A; text-transform:uppercase; margin-top:0.25rem;"><?= e($quote['freight_mode']) ?></div>
                </div>
                <div>
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B;">Incoterm</div>
                    <div style="font-size:0.95rem; font-weight:600; color:#0F172A; margin-top:0.25rem;"><?= e($quote['incoterm']) ?></div>
                </div>
                <div>
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B;">Target ETD</div>
                    <div style="font-size:0.95rem; font-weight:600; color:#0F172A; margin-top:0.25rem;"><?= $quote['target_etd'] ? e($quote['target_etd']) : 'Immediate' ?></div>
                </div>
            </div>
        </div>

        <!-- Cargo Manifest & Physical Parameters -->
        <div class="admin-card">
            <h2 style="font-size:1.1rem; color:#0F172A; margin-bottom:1rem; padding-bottom:0.75rem; border-bottom:1px solid #E2E8F0; display:flex; align-items:center; gap:0.5rem;">
                <span class="material-symbols-outlined" style="color:var(--color-blue-industrial); font-size:22px;">inventory_2</span>
                Cargo Manifest &amp; Dimensional Specs
            </h2>
            
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%, 180px), 1fr)); gap:1.25rem; margin-bottom:1.5rem;">
                <div>
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B;">Commodity Description</div>
                    <div style="font-size:1rem; font-weight:600; color:#0F172A; margin-top:0.25rem;"><?= e($quote['commodity']) ?></div>
                </div>
                <div>
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B;">Container / Equipment</div>
                    <div style="font-size:1rem; font-weight:600; color:#0F172A; margin-top:0.25rem;"><?= e($quote['container_type'] ?: 'LCL / General') ?></div>
                </div>
                <div>
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B;">Gross Weight</div>
                    <div style="font-size:1rem; font-weight:600; color:#0F172A; margin-top:0.25rem;"><?= e($quote['gross_weight'] ?: 'Not Specified') ?></div>
                </div>
                <div>
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B;">Total Volume / Package Count</div>
                    <div style="font-size:1rem; font-weight:600; color:#0F172A; margin-top:0.25rem;"><?= e($quote['total_volume'] ?: 'N/A') ?> &bull; <?= e($quote['package_count'] ?: 'N/A') ?></div>
                </div>
            </div>

            <!-- Value-added Protocols -->
            <div style="background:#EDF4FF; border:1px solid #D6E4FF; border-radius:6px; padding:1.25rem; margin-bottom:1.25rem;">
                <div style="font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#10243A; margin-bottom:0.75rem;">Special Cargo Protocols & Scope</div>
                <div style="display:flex; flex-wrap:wrap; gap:0.75rem;">
                    <span style="display:inline-flex; align-items:center; gap:0.35rem; padding:0.35rem 0.65rem; border-radius:4px; font-size:0.8rem; font-weight:600; background:<?= $quote['req_customs'] ? '#D1FAE5; color:#065F46;' : '#FFFFFF; color:#64748B; border:1px solid #CBD5E1;' ?>">
                        <?= $quote['req_customs'] ? '&#10003; Customs Brokerage Included' : '&cross; Customs Cleared by Shipper' ?>
                    </span>
                    <span style="display:inline-flex; align-items:center; gap:0.35rem; padding:0.35rem 0.65rem; border-radius:4px; font-size:0.8rem; font-weight:600; background:<?= $quote['req_warehousing'] ? '#EDE9FE; color:#5B21B6;' : '#FFFFFF; color:#64748B; border:1px solid #CBD5E1;' ?>">
                        <?= $quote['req_warehousing'] ? '&#10003; Bonded Staging / Warehousing Requested' : '&cross; Direct Drayage' ?>
                    </span>
                    <span style="display:inline-flex; align-items:center; gap:0.35rem; padding:0.35rem 0.65rem; border-radius:4px; font-size:0.8rem; font-weight:600; background:<?= $quote['req_insurance'] ? '#DBEAFE; color:#1E40AF;' : '#FFFFFF; color:#64748B; border:1px solid #CBD5E1;' ?>">
                        <?= $quote['req_insurance'] ? '&#10003; Marine Cargo Insurance Included' : '&cross; Insurance by Shipper' ?>
                    </span>
                    <span style="display:inline-flex; align-items:center; gap:0.35rem; padding:0.35rem 0.65rem; border-radius:4px; font-size:0.8rem; font-weight:600; background:<?= $quote['req_delivery'] ? '#FEF3C7; color:#92400E;' : '#FFFFFF; color:#64748B; border:1px solid #CBD5E1;' ?>">
                        <?= $quote['req_delivery'] ? '&#10003; Door Delivery / Drayage Requested' : '&cross; Port-to-Port Only' ?>
                    </span>
                </div>
            </div>

            <!-- Additional Instructions -->
            <div>
                <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; color:#64748B; margin-bottom:0.5rem;">Shipper Scope & Operational Notes</div>
                <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:6px; padding:1rem; font-size:0.9rem; color:#334155; line-height:1.6; white-space:pre-wrap;"><?= $quote['special_instructions'] ? e($quote['special_instructions']) : '<em style="color:#94A3B8;">No special packaging instructions or dimensions provided.</em>' ?></div>
            </div>
        </div>
    </div>

    <!-- Right Column: Status & Operational Management -->
    <div style="display:flex; flex-direction:column; gap:1.5rem;">
        
        <!-- Status & Operations Form -->
        <div class="admin-card">
            <h2 style="font-size:1.1rem; color:#0F172A; margin-bottom:1rem; padding-bottom:0.75rem; border-bottom:1px solid #E2E8F0;">
                Docket Workflow Status
            </h2>
            
            <form method="POST" action="<?= e(url('/admin/quote-view.php?id=' . $id)) ?>">
                <input type="hidden" name="action" value="update_docket">
                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                
                <div style="margin-bottom:1.25rem;">
                    <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">Current Operational Status</label>
                    <select name="status" class="form-control" style="font-weight:600;">
                        <option value="pending" <?= $quote['status'] === 'pending' ? 'selected' : '' ?>>PENDING (Awaiting Review)</option>
                        <option value="reviewing" <?= $quote['status'] === 'reviewing' ? 'selected' : '' ?>>REVIEWING (Carrier Rate Prep)</option>
                        <option value="quoted" <?= $quote['status'] === 'quoted' ? 'selected' : '' ?>>QUOTED (Proforma Dispatched)</option>
                        <option value="booked" <?= $quote['status'] === 'booked' ? 'selected' : '' ?>>BOOKED (Confirmed Shipment)</option>
                        <option value="archived" <?= $quote['status'] === 'archived' ? 'selected' : '' ?>>ARCHIVED (Closed / Cancelled)</option>
                    </select>
                </div>

                <div style="margin-bottom:1.25rem;">
                    <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">Internal Operations Notes</label>
                    <textarea name="operations_notes" class="form-control" rows="6" placeholder="Carrier slot, demurrage terms, allocated TEUs, booking reference, rate calculations..." style="font-size:0.85rem; line-height:1.5;"><?= e($quote['operations_notes'] ?? '') ?></textarea>
                    <small style="color:#64748B; font-size:0.75rem; display:block; margin-top:0.35rem;">Internal notes are confidential and visible only to authorized logistics personnel.</small>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">
                    <span class="material-symbols-outlined" style="font-size:18px;">save</span>
                    Update RFQ Docket
                </button>
            </form>
        </div>

        <!-- Quick Summary Box -->
        <div class="admin-card" style="background:#10243A; color:#FFFFFF;">
            <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:#93C5FD; margin-bottom:0.5rem;">Summary Manifest</div>
            <div style="font-size:1.25rem; font-weight:700; margin-bottom:0.5rem;"><?= e($quote['docket_number']) ?></div>
            <div style="font-size:0.85rem; color:#E2E8F0; line-height:1.5;">
                Routing: <?= e($quote['origin_pol']) ?> &rarr; <?= e($quote['destination_pod']) ?><br>
                Service: <?= strtoupper(e($quote['freight_mode'])) ?><br>
                Commodity: <?= e($quote['commodity']) ?>
            </div>
            <div style="margin-top:1rem; padding-top:0.75rem; border-top:1px solid rgba(255,255,255,0.15); font-size:0.75rem; color:#94A3B8;">
                Spillburg Logistics 1 (Pvt) Ltd<br>Commercial Operations Division
            </div>
        </div>

    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
