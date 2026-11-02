<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Administrative Console — Dashboard Overview
 */

$page_title = 'Operations Dashboard';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../config/database.php';

$db = Database::getConnection();

// Fetch counts
$totalQuotes = (int)$db->query("SELECT COUNT(*) FROM quotes")->fetchColumn();
$pendingQuotes = (int)$db->query("SELECT COUNT(*) FROM quotes WHERE status = 'pending'")->fetchColumn();
$unreadContacts = (int)$db->query("SELECT COUNT(*) FROM contacts WHERE status = 'unread'")->fetchColumn();
$publishedNews = (int)$db->query("SELECT COUNT(*) FROM news WHERE is_published = 1")->fetchColumn();

// Fetch latest RFQs
$stmt = $db->query("SELECT * FROM quotes ORDER BY created_at DESC LIMIT 6");
$recentQuotes = $stmt->fetchAll();

// Fetch latest inquiries
$stmt2 = $db->query("SELECT * FROM contacts ORDER BY created_at DESC LIMIT 4");
$recentContacts = $stmt2->fetchAll();
?>

<div class="admin-header-strip">
    <div>
        <h1 style="font-size: 1.75rem; color: var(--color-midnight); margin-bottom: 0.25rem;">
            Logistics Operations Console
        </h1>
        <div style="font-size: 0.8125rem; color: var(--color-text-secondary); font-family: var(--font-mono);">
            DATABASE: <?= strtoupper(Database::getDriver()) ?> &bull; ENVIRONMENT: <?= strtoupper(APP_ENV) ?> &bull; SERVER TIME: <?= date('Y-m-d H:i:s T') ?>
        </div>
    </div>
    <div style="display: flex; gap: 0.75rem;">
        <a href="<?= url('admin/quotes.php?export=csv') ?>" class="btn btn-secondary btn-sm">
            <span class="material-symbols-outlined" style="font-size: 16px;">download</span>
            Export RFQ CSV
        </a>
        <a href="<?= url('admin/news.php?action=create') ?>" class="btn btn-primary btn-sm">
            <span class="material-symbols-outlined" style="font-size: 16px;">add_circle</span>
            Post Port Advisory
        </a>
    </div>
</div>

<!-- Metrics Cards -->
<div class="stats-card-grid">
    <div class="stat-metric-card" style="border-left: 4px solid var(--color-blue-industrial);">
        <div class="stat-metric-title">TOTAL RFQ DOCKETS</div>
        <div class="stat-metric-number tabular"><?= $totalQuotes ?></div>
        <div style="font-size: 0.75rem; color: var(--color-text-muted); margin-top: 0.5rem;">
            Cumulative registered quotes
        </div>
    </div>

    <div class="stat-metric-card" style="border-left: 4px solid var(--color-amber-accent);">
        <div class="stat-metric-title">PENDING OPERATIONS REVIEW</div>
        <div class="stat-metric-number tabular" style="color: #B45309;"><?= $pendingQuotes ?></div>
        <div style="font-size: 0.75rem; color: var(--color-text-muted); margin-top: 0.5rem;">
            Awaiting carrier rate computation
        </div>
    </div>

    <div class="stat-metric-card" style="border-left: 4px solid #10B981;">
        <div class="stat-metric-title">UNREAD INQUIRIES</div>
        <div class="stat-metric-number tabular" style="color: #047857;"><?= $unreadContacts ?></div>
        <div style="font-size: 0.75rem; color: var(--color-text-muted); margin-top: 0.5rem;">
            Customer contact messages
        </div>
    </div>

    <div class="stat-metric-card" style="border-left: 4px solid var(--color-navy-container);">
        <div class="stat-metric-title">ACTIVE ADVISORIES</div>
        <div class="stat-metric-number tabular"><?= $publishedNews ?></div>
        <div style="font-size: 0.75rem; color: var(--color-text-muted); margin-top: 0.5rem;">
            Published port notices
        </div>
    </div>
</div>

<!-- Recent RFQs Section -->
<div class="admin-card" style="margin-bottom: 2.5rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
        <div>
            <h2 class="admin-title" style="font-size: 1.25rem;">Recent RFQ Cargo Dockets</h2>
            <div class="admin-subtitle">Incoming multi-modal freight quotation submissions</div>
        </div>
        <a href="<?= url('admin/quotes.php') ?>" class="card-link" style="font-size: 0.8125rem;">
            View All Dockets &rarr;
        </a>
    </div>

    <?php if (!empty($recentQuotes)): ?>
    <div class="table-responsive">
        <table class="logistics-table">
            <thead>
                <tr>
                    <th>Docket Ref</th>
                    <th>Shipper &bull; Company</th>
                    <th>Route (POL &rarr; POD)</th>
                    <th>Mode</th>
                    <th>Commodity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentQuotes as $q): 
                    $badgeClass = match ($q['status']) {
                        'pending' => 'badge-pending',
                        'reviewing' => 'badge-reviewing',
                        'quoted' => 'badge-quoted',
                        'booked', 'completed' => 'badge-booked',
                        'archived' => 'badge-archived',
                        default => 'badge-in-transit'
                    };
                ?>
                <tr>
                    <td>
                        <a href="<?= url('admin/quote-view.php?docket=' . urlencode($q['docket_number'])) ?>" style="font-family: var(--font-mono); font-weight: 700;">
                            <?= e($q['docket_number']) ?>
                        </a>
                    </td>
                    <td>
                        <strong><?= e($q['company_name']) ?></strong><br>
                        <span style="font-size: 0.75rem; color: var(--color-text-muted);"><?= e($q['full_name']) ?></span>
                    </td>
                    <td>
                        <span style="font-family: var(--font-mono); font-size: 0.8125rem;">
                            <?= e($q['origin_pol']) ?> &rarr; <?= e($q['destination_pod']) ?>
                        </span>
                    </td>
                    <td>
                        <span style="text-transform: uppercase; font-weight: 600; font-size: 0.75rem;">
                            <?= e($q['freight_mode']) ?>
                        </span>
                    </td>
                    <td><?= e($q['commodity']) ?></td>
                    <td>
                        <span class="badge <?= $badgeClass ?>">
                            <?= strtoupper(e($q['status'])) ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= url('admin/quote-view.php?docket=' . urlencode($q['docket_number'])) ?>" class="btn btn-secondary btn-sm">
                            Inspect
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div style="padding: 2.5rem; text-align: center; color: var(--color-text-muted);">
        No RFQ dockets recorded yet. Submit a test quote from the public <a href="<?= url('quote.php') ?>" target="_blank">quote form</a>.
    </div>
    <?php endif; ?>
</div>

<!-- Recent Inquiries Section -->
<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
        <div>
            <h2 class="admin-title" style="font-size: 1.25rem;">Recent Inquiries</h2>
            <div class="admin-subtitle">Messages received via website contact form</div>
        </div>
        <a href="<?= url('admin/contacts.php') ?>" class="card-link" style="font-size: 0.8125rem;">
            View All Inquiries &rarr;
        </a>
    </div>

    <?php if (!empty($recentContacts)): ?>
    <div class="table-responsive">
        <table class="logistics-table">
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Email / Phone</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentContacts as $c): ?>
                <tr>
                    <td>
                        <strong><?= e($c['name']) ?></strong>
                        <?php if (!empty($c['company'])): ?>
                            <div style="font-size: 0.75rem; color: var(--color-text-muted);"><?= e($c['company']) ?></div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="mailto:<?= e($c['email']) ?>"><?= e($c['email']) ?></a>
                        <?php if (!empty($c['phone'])): ?>
                            <div style="font-size: 0.75rem; color: var(--color-text-muted);"><?= e($c['phone']) ?></div>
                        <?php endif; ?>
                    </td>
                    <td><?= e($c['subject']) ?></td>
                    <td style="font-family: var(--font-mono); font-size: 0.8125rem;"><?= date('Y-m-d H:i', strtotime($c['created_at'])) ?></td>
                    <td>
                        <span class="badge <?= ($c['status'] === 'unread') ? 'badge-unread' : 'badge-read' ?>">
                            <?= strtoupper(e($c['status'])) ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div style="padding: 2.5rem; text-align: center; color: var(--color-text-muted);">
        No customer inquiries logged yet.
    </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
