<?php
/**
 * Spillburg Logistics 1 - Admin RFQ Management
 * File: admin/quotes.php
 */
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

require_admin();

$db = Database::getInstance();

// Handle CSV Export
if (isset($_GET['action']) && $_GET['action'] === 'export') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=spillburg_rfqs_' . date('Y-m-d_His') . '.csv');
    
    $output = fopen('php://output', 'w');
    fputcsv($output, [
        'ID', 'Docket Number', 'Status', 'Shipper Name', 'Company', 'Email', 'Phone',
        'Service Mode', 'Origin (POL)', 'Destination (POD)', 'Commodity', 'Gross Weight', 'Volume',
        'Customs Req', 'Warehousing Req', 'Target ETD', 'Created At'
    ]);
    
    $exportStmt = $db->query("SELECT * FROM quotes ORDER BY id DESC");
    while ($row = $exportStmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($output, [
            $row['id'],
            $row['docket_number'],
            $row['status'],
            $row['full_name'],
            $row['company_name'],
            $row['email'],
            $row['phone'],
            $row['freight_mode'],
            $row['origin_pol'],
            $row['destination_pod'],
            $row['commodity'],
            $row['gross_weight'],
            $row['total_volume'],
            $row['req_customs'] ? 'Yes' : 'No',
            $row['req_warehousing'] ? 'Yes' : 'No',
            $row['target_etd'],
            $row['created_at']
        ]);
    }
    fclose($output);
    exit;
}

// Handle Quick Status Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'quick_status') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('error', 'Invalid security token.');
        redirect('/admin/quotes.php');
    }
    
    $quoteId = (int)($_POST['quote_id'] ?? 0);
    $newStatus = trim($_POST['status'] ?? '');
    $validStatuses = ['pending', 'reviewing', 'quoted', 'booked', 'archived'];
    
    if ($quoteId > 0 && in_array($newStatus, $validStatuses, true)) {
        $stmt = $db->prepare("UPDATE quotes SET status = :status WHERE id = :id");
        $stmt->execute([':status' => $newStatus, ':id' => $quoteId]);
        set_flash('success', "Docket status updated to " . strtoupper($newStatus));
    }
    redirect('/admin/quotes.php' . (isset($_GET['status']) ? '?status=' . urlencode($_GET['status']) : ''));
}

// Filter and Pagination
$statusFilter = trim($_GET['status'] ?? '');
$searchQuery = trim($_GET['q'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 15;
$offset = ($page - 1) * $perPage;

$whereClauses = [];
$params = [];

if ($statusFilter !== '' && in_array($statusFilter, ['pending', 'reviewing', 'quoted', 'booked', 'archived'], true)) {
    $whereClauses[] = "status = :status";
    $params[':status'] = $statusFilter;
}

if ($searchQuery !== '') {
    $whereClauses[] = "(docket_number LIKE :q OR full_name LIKE :q OR company_name LIKE :q OR email LIKE :q OR origin_pol LIKE :q OR destination_pod LIKE :q)";
    $params[':q'] = "%$searchQuery%";
}

$whereSql = !empty($whereClauses) ? "WHERE " . implode(" AND ", $whereClauses) : "";

// Count Total
$countStmt = $db->prepare("SELECT COUNT(*) FROM quotes $whereSql");
$countStmt->execute($params);
$totalQuotes = (int)$countStmt->fetchColumn();
$totalPages = ceil($totalQuotes / $perPage);

// Fetch Quotes
$sql = "SELECT * FROM quotes $whereSql ORDER BY id DESC LIMIT $perPage OFFSET $offset";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = 'Freight Quotations (RFQs)';
$activeNav = 'quotes';
require_once __DIR__ . '/includes/header.php';
?>

<div class="admin-header-actions">
    <div>
        <h1 class="admin-title">Freight Quotation Dockets</h1>
        <p class="admin-subtitle">Monitor, inspect, evaluate and update commercial freight inquiries and rate quotations.</p>
    </div>
    <div style="display:flex; gap:0.75rem;">
        <a href="<?= e(url('/admin/quotes.php?action=export')) ?>" class="btn btn-secondary btn-sm">
            <span class="material-symbols-outlined" style="font-size: 18px;">download</span>
            Export CSV
        </a>
    </div>
</div>

<!-- Filters Bar -->
<div class="admin-card" style="padding:1rem 1.25rem; margin-bottom:1.5rem;">
    <form method="GET" action="<?= e(url('/admin/quotes.php')) ?>" style="display:flex; flex-wrap:wrap; gap:1rem; align-items:center; justify-content:space-between;">
        <div style="display:flex; flex-wrap:wrap; gap:0.75rem; align-items:center; flex:1;">
            <input type="text" name="q" value="<?= e($searchQuery) ?>" placeholder="Search Docket, Shipper, Company, Port..." class="form-control" style="max-width:320px; font-size:0.875rem; padding:0.5rem 0.85rem;">
            
            <select name="status" class="form-control" style="max-width:180px; font-size:0.875rem; padding:0.5rem 0.85rem;">
                <option value="">All Statuses</option>
                <option value="pending" <?= $statusFilter === 'pending' ? 'selected' : '' ?>>Pending Review</option>
                <option value="reviewing" <?= $statusFilter === 'reviewing' ? 'selected' : '' ?>>In Review / Rate Prep</option>
                <option value="quoted" <?= $statusFilter === 'quoted' ? 'selected' : '' ?>>Quoted to Shipper</option>
                <option value="booked" <?= $statusFilter === 'booked' ? 'selected' : '' ?>>Booked Cargo</option>
                <option value="archived" <?= $statusFilter === 'archived' ? 'selected' : '' ?>>Archived</option>
            </select>

            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
            <?php if ($statusFilter || $searchQuery): ?>
                <a href="<?= e(url('/admin/quotes.php')) ?>" style="color:#64748B; font-size:0.85rem; text-decoration:none; margin-left:0.5rem;">Clear</a>
            <?php endif; ?>
        </div>

        <div style="font-size:0.85rem; color:#64748B;">
            Showing <strong><?= count($quotes) ?></strong> of <strong><?= $totalQuotes ?></strong> total inquiries
        </div>
    </form>
</div>

<!-- Table Container -->
<div class="admin-card" style="padding:0; overflow:hidden;">
    <?php if (empty($quotes)): ?>
        <div style="padding:4rem 2rem; text-align:center;">
            <span class="material-symbols-outlined" style="font-size: 48px; color:#94A3B8; margin-bottom:1rem; display:block;">receipt_long</span>
            <h3 style="font-size:1.15rem; color:#0F172A; margin-bottom:0.35rem;">No Quotation Dockets Found</h3>
            <p style="color:#64748B; font-size:0.875rem;">No RFQ records match your active search or status criteria.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive" style="border:none; box-shadow:none;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Docket Number</th>
                        <th>Shipper / Organization</th>
                        <th>Routing & Mode</th>
                        <th>Cargo Specifications</th>
                        <th>Target ETD</th>
                        <th>Status</th>
                        <th>Received</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($quotes as $q): ?>
                        <tr>
                            <td>
                                <a href="<?= e(url('/admin/quote-view.php?id=' . $q['id'])) ?>" style="font-family:monospace; font-weight:700; color:#245B82; text-decoration:none;">
                                    <?= e($q['docket_number']) ?>
                                </a>
                            </td>
                            <td>
                                <div style="font-weight:600; color:#0F172A;"><?= e($q['full_name']) ?></div>
                                <div style="font-size:0.75rem; color:#64748B;"><?= e($q['company_name'] ?: 'Private Shipper') ?> &bull; <?= e($q['email']) ?></div>
                            </td>
                            <td>
                                <div style="font-size:0.85rem; font-weight:600; color:#0F172A;">
                                    <?= e($q['origin_pol']) ?> &rarr; <?= e($q['destination_pod']) ?>
                                </div>
                                <div style="font-size:0.75rem; color:#64748B; text-transform:capitalize;">
                                    Mode: <strong><?= e($q['freight_mode']) ?></strong> (<?= e($q['incoterm']) ?>)
                                </div>
                            </td>
                            <td>
                                <div style="font-size:0.85rem; color:#334155;">
                                    <?= e($q['commodity'] ?: 'Standard Freight') ?>
                                </div>
                                <div style="font-size:0.75rem; color:#64748B;">
                                    <?= e($q['gross_weight'] ?: 'Weight N/A') ?> &bull; <?= e($q['total_volume'] ?: 'Vol N/A') ?>
                                </div>
                            </td>
                            <td style="font-size:0.8rem; color:#475569;">
                                <?= $q['target_etd'] ? e($q['target_etd']) : '<span style="color:#94A3B8;">Immediate</span>' ?>
                            </td>
                            <td>
                                <form method="POST" action="<?= e(url('/admin/quotes.php' . ($statusFilter ? '?status=' . urlencode($statusFilter) : ''))) ?>" style="margin:0;">
                                    <input type="hidden" name="action" value="quick_status">
                                    <input type="hidden" name="quote_id" value="<?= $q['id'] ?>">
                                    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                    <select name="status" onchange="this.form.submit()" style="font-size:0.75rem; font-weight:700; text-transform:uppercase; border-radius:4px; padding:0.25rem 0.5rem; border:1px solid #CBD5E1; cursor:pointer; background:<?= 
                                        $q['status'] === 'pending' ? '#FEF3C7; color:#92400E;' : 
                                        ($q['status'] === 'reviewing' ? '#DBEAFE; color:#1E40AF;' : 
                                        ($q['status'] === 'quoted' ? '#D1FAE5; color:#065F46;' : 
                                        ($q['status'] === 'booked' ? '#EDE9FE; color:#5B21B6;' : '#F1F5F9; color:#475569;')))
                                    ?>">
                                        <option value="pending" <?= $q['status'] === 'pending' ? 'selected' : '' ?>>PENDING</option>
                                        <option value="reviewing" <?= $q['status'] === 'reviewing' ? 'selected' : '' ?>>REVIEWING</option>
                                        <option value="quoted" <?= $q['status'] === 'quoted' ? 'selected' : '' ?>>QUOTED</option>
                                        <option value="booked" <?= $q['status'] === 'booked' ? 'selected' : '' ?>>BOOKED</option>
                                        <option value="archived" <?= $q['status'] === 'archived' ? 'selected' : '' ?>>ARCHIVED</option>
                                    </select>
                                </form>
                            </td>
                            <td style="font-size:0.8rem; color:#64748B; white-space:nowrap;">
                                <?= date('M d, Y', strtotime($q['created_at'])) ?>
                            </td>
                            <td style="text-align:right;">
                                <a href="<?= e(url('/admin/quote-view.php?id=' . $q['id'])) ?>" class="btn btn-primary btn-sm" style="font-size:0.75rem; padding:0.35rem 0.65rem;">
                                    Inspect &rarr;
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
            <div style="padding:1rem 1.5rem; display:flex; justify-content:space-between; align-items:center; border-top:1px solid #E2E8F0; font-size:0.85rem;">
                <div style="color:#64748B;">
                    Page <?= $page ?> of <?= $totalPages ?>
                </div>
                <div style="display:flex; gap:0.5rem;">
                    <?php if ($page > 1): ?>
                        <a href="<?= e(url('/admin/quotes.php?page=' . ($page - 1) . ($statusFilter ? '&status=' . urlencode($statusFilter) : '') . ($searchQuery ? '&q=' . urlencode($searchQuery) : ''))) ?>" style="padding:0.35rem 0.75rem; border:1px solid #CBD5E1; border-radius:4px; text-decoration:none; color:#1E293B;">Previous</a>
                    <?php endif; ?>
                    <?php if ($page < $totalPages): ?>
                        <a href="<?= e(url('/admin/quotes.php?page=' . ($page + 1) . ($statusFilter ? '&status=' . urlencode($statusFilter) : '') . ($searchQuery ? '&q=' . urlencode($searchQuery) : ''))) ?>" style="padding:0.35rem 0.75rem; border:1px solid #CBD5E1; border-radius:4px; text-decoration:none; color:#1E293B;">Next</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
