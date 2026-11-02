<?php
/**
 * Spillburg Logistics 1 - Admin Contact Inquiries
 * File: admin/contacts.php
 */
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

require_admin();

$db = Database::getInstance();

// Handle Actions (status toggle, delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('error', 'Invalid security token.');
        redirect('/admin/contacts.php');
    }
    
    $contactId = (int)($_POST['contact_id'] ?? 0);
    
    if ($_POST['action'] === 'toggle_status') {
        $newStatus = trim($_POST['status'] ?? '');
        if (in_array($newStatus, ['unread', 'read', 'replied', 'archived'], true)) {
            $stmt = $db->prepare("UPDATE contacts SET status = :status WHERE id = :id");
            $stmt->execute([':status' => $newStatus, ':id' => $contactId]);
            set_flash('success', 'Inquiry status updated to ' . strtoupper($newStatus));
        }
    } elseif ($_POST['action'] === 'delete') {
        $stmt = $db->prepare("DELETE FROM contacts WHERE id = :id");
        $stmt->execute([':id' => $contactId]);
        set_flash('success', 'Inquiry deleted successfully.');
    }
    
    redirect('/admin/contacts.php');
}

// Fetch Inquiries
$statusFilter = trim($_GET['status'] ?? '');
$params = [];
$whereClause = "";

if ($statusFilter !== '' && in_array($statusFilter, ['unread', 'read', 'replied', 'archived'], true)) {
    $whereClause = "WHERE status = :status";
    $params[':status'] = $statusFilter;
}

$stmt = $db->prepare("SELECT * FROM contacts $whereClause ORDER BY id DESC");
$stmt->execute($params);
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = 'General Inquiries';
$activeNav = 'contacts';
require_once __DIR__ . '/includes/header.php';
?>

<div class="admin-header-actions">
    <div>
        <h1 class="admin-title">General Inquiries & Messages</h1>
        <p class="admin-subtitle">Manage direct communications sent via the website contact form.</p>
    </div>
    <div>
        <div style="font-size:0.875rem; color:#64748B;">
            Total Messages: <strong><?= count($contacts) ?></strong>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div style="display:flex; gap:0.5rem; margin-bottom:1.5rem; border-bottom:1px solid #E2E8F0; padding-bottom:0.75rem;">
    <a href="<?= e(url('/admin/contacts.php')) ?>" style="padding:0.4rem 0.85rem; border-radius:4px; font-size:0.85rem; font-weight:600; text-decoration:none; <?= empty($statusFilter) ? 'background:#10243A; color:#FFF;' : 'color:#64748B;' ?>">
        All Inquiries
    </a>
    <a href="<?= e(url('/admin/contacts.php?status=unread')) ?>" style="padding:0.4rem 0.85rem; border-radius:4px; font-size:0.85rem; font-weight:600; text-decoration:none; <?= $statusFilter === 'unread' ? 'background:#10243A; color:#FFF;' : 'color:#64748B;' ?>">
        Unread
    </a>
    <a href="<?= e(url('/admin/contacts.php?status=replied')) ?>" style="padding:0.4rem 0.85rem; border-radius:4px; font-size:0.85rem; font-weight:600; text-decoration:none; <?= $statusFilter === 'replied' ? 'background:#10243A; color:#FFF;' : 'color:#64748B;' ?>">
        Replied
    </a>
    <a href="<?= e(url('/admin/contacts.php?status=archived')) ?>" style="padding:0.4rem 0.85rem; border-radius:4px; font-size:0.85rem; font-weight:600; text-decoration:none; <?= $statusFilter === 'archived' ? 'background:#10243A; color:#FFF;' : 'color:#64748B;' ?>">
        Archived
    </a>
</div>

<?php if (empty($contacts)): ?>
    <div class="admin-card" style="text-align:center; padding:4rem 2rem;">
        <span class="material-symbols-outlined" style="font-size: 48px; color:#94A3B8; margin-bottom:1rem; display:block;">mail</span>
        <h3 style="font-size:1.15rem; color:#0F172A; margin-bottom:0.35rem;">No Inquiries Found</h3>
        <p style="color:#64748B; font-size:0.875rem;">There are no contact messages matching the active filter.</p>
    </div>
<?php else: ?>
    <div style="display:flex; flex-direction:column; gap:1.25rem;">
        <?php foreach ($contacts as $c): ?>
            <div class="admin-card" style="border-left: 4px solid <?= $c['status'] === 'unread' ? '#245B82' : ($c['status'] === 'replied' ? '#10B981' : '#94A3B8') ?>;">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:0.75rem; flex-wrap:wrap; gap:0.5rem;">
                    <div>
                        <div style="display:flex; align-items:center; gap:0.5rem;">
                            <h3 style="font-size:1.05rem; color:#0F172A; font-weight:700; margin:0;"><?= e($c['name']) ?></h3>
                            <span class="badge" style="background:<?= $c['status'] === 'unread' ? '#DBEAFE; color:#1E40AF;' : ($c['status'] === 'replied' ? '#D1FAE5; color:#065F46;' : '#F1F5F9; color:#475569;') ?>">
                                <?= strtoupper(e($c['status'])) ?>
                            </span>
                        </div>
                        <div style="font-size:0.8rem; color:#64748B; margin-top:0.25rem;">
                            <?= e($c['company'] ?: 'Individual / Private') ?> &bull; 
                            <a href="mailto:<?= e($c['email']) ?>" style="color:#245B82; text-decoration:none;"><?= e($c['email']) ?></a>
                            <?php if ($c['phone']): ?>
                                &bull; <a href="tel:<?= e($c['phone']) ?>" style="color:#475569; text-decoration:none;"><?= e($c['phone']) ?></a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div style="display:flex; align-items:center; gap:0.5rem;">
                        <span style="font-size:0.8rem; color:#64748B;"><?= date('M d, Y H:i', strtotime($c['created_at'])) ?></span>
                        
                        <!-- Status Form -->
                        <form method="POST" action="<?= e(url('/admin/contacts.php')) ?>" style="margin:0;">
                            <input type="hidden" name="action" value="toggle_status">
                            <input type="hidden" name="contact_id" value="<?= $c['id'] ?>">
                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                            <select name="status" onchange="this.form.submit()" style="font-size:0.75rem; border-radius:4px; padding:0.25rem 0.5rem; border:1px solid #CBD5E1;">
                                <option value="unread" <?= $c['status'] === 'unread' ? 'selected' : '' ?>>Unread</option>
                                <option value="read" <?= $c['status'] === 'read' ? 'selected' : '' ?>>Read</option>
                                <option value="replied" <?= $c['status'] === 'replied' ? 'selected' : '' ?>>Replied</option>
                                <option value="archived" <?= $c['status'] === 'archived' ? 'selected' : '' ?>>Archived</option>
                            </select>
                        </form>

                        <!-- Delete Form -->
                        <form method="POST" action="<?= e(url('/admin/contacts.php')) ?>" style="margin:0;" onsubmit="return confirm('Delete this inquiry permanently?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="contact_id" value="<?= $c['id'] ?>">
                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                            <button type="submit" style="background:none; border:none; cursor:pointer; color:#EF4444; padding:0.25rem; display:inline-flex; align-items:center;" title="Delete Message">
                                <span class="material-symbols-outlined" style="font-size: 20px;">delete</span>
                            </button>
                        </form>
                    </div>
                </div>

                <div style="font-size:0.85rem; font-weight:600; color:#1E293B; margin-bottom:0.5rem;">
                    Subject: <?= e($c['subject'] ?: 'General Logistics Inquiry') ?>
                </div>

                <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:6px; padding:1rem; font-size:0.9rem; color:#334155; line-height:1.6; white-space:pre-wrap;"><?= e($c['message']) ?></div>

                <div style="margin-top:0.75rem; display:flex; justify-content:flex-end;">
                    <a href="mailto:<?= e($c['email']) ?>?subject=<?= urlencode('Re: ' . ($c['subject'] ?: 'Spillburg Logistics 1 Inquiry')) ?>" class="btn btn-primary btn-sm">
                        <span class="material-symbols-outlined" style="font-size: 16px;">reply</span>
                        Reply via Email
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
