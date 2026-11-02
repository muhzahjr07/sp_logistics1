<?php
/**
 * Spillburg Logistics 1 - Admin Port Advisories & News
 * File: admin/news.php
 */
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

require_admin();

$db = Database::getInstance();

$action = $_GET['action'] ?? 'list';
$editId = (int)($_GET['id'] ?? 0);

// Handle Save (Create / Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_article'])) {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('error', 'Invalid security token.');
        redirect('/admin/news.php');
    }
    
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? 'Port Advisory');
    $summary = trim($_POST['summary'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $isPublished = isset($_POST['is_published']) ? 1 : 0;
    
    if (empty($title) || empty($summary) || empty($content)) {
        set_flash('error', 'Title, Summary and Body Content are required fields.');
    } else {
        // Generate slug
        $baseSlug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        $slug = $baseSlug;
        
        if ($editId > 0) {
            $stmt = $db->prepare("UPDATE news SET title = :title, category = :category, summary = :summary, content = :content, is_published = :is_published WHERE id = :id");
            $stmt->execute([
                ':title' => $title,
                ':category' => $category,
                ':summary' => $summary,
                ':content' => $content,
                ':is_published' => $isPublished,
                ':id' => $editId
            ]);
            set_flash('success', 'Port Advisory updated successfully.');
        } else {
            // Check slug uniqueness
            $checkStmt = $db->prepare("SELECT COUNT(*) FROM news WHERE slug = :slug");
            $checkStmt->execute([':slug' => $slug]);
            if ($checkStmt->fetchColumn() > 0) {
                $slug = $baseSlug . '-' . time();
            }
            
            $stmt = $db->prepare("INSERT INTO news (title, slug, category, summary, content, is_published, published_date) VALUES (:title, :slug, :category, :summary, :content, :is_published, :published_date)");
            $stmt->execute([
                ':title' => $title,
                ':slug' => $slug,
                ':category' => $category,
                ':summary' => $summary,
                ':content' => $content,
                ':is_published' => $isPublished,
                ':published_date' => date('Y-m-d')
            ]);
            set_flash('success', 'New Port Advisory created successfully.');
        }
        redirect('/admin/news.php');
    }
}

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_article'])) {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('error', 'Invalid security token.');
        redirect('/admin/news.php');
    }
    
    $delId = (int)($_POST['article_id'] ?? 0);
    if ($delId > 0) {
        $stmt = $db->prepare("DELETE FROM news WHERE id = :id");
        $stmt->execute([':id' => $delId]);
        set_flash('success', 'Advisory deleted permanently.');
    }
    redirect('/admin/news.php');
}

// Handle Toggle Published
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_published'])) {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('error', 'Invalid security token.');
        redirect('/admin/news.php');
    }
    
    $togId = (int)($_POST['article_id'] ?? 0);
    if ($togId > 0) {
        $stmt = $db->prepare("UPDATE news SET is_published = 1 - is_published, updated_at = CURRENT_TIMESTAMP WHERE id = :id");
        $stmt->execute([':id' => $togId]);
        set_flash('success', 'Publication status toggled.');
    }
    redirect('/admin/news.php');
}

// Fetch Article if Editing
$article = null;
if ($action === 'edit' && $editId > 0) {
    $stmt = $db->prepare("SELECT * FROM news WHERE id = :id");
    $stmt->execute([':id' => $editId]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$article) {
        set_flash('error', 'Advisory not found.');
        redirect('/admin/news.php');
    }
}

// Fetch All Articles for Listing
$articles = [];
if ($action === 'list') {
    $stmt = $db->query("SELECT * FROM news ORDER BY published_date DESC, id DESC");
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$pageTitle = 'Port Advisories & Bulletins';
$activeNav = 'news';
require_once __DIR__ . '/includes/header.php';
?>

<?php if ($action === 'create' || $action === 'edit'): ?>
    <div class="admin-header-actions">
        <div>
            <h1 class="admin-title"><?= $action === 'edit' ? 'Edit Port Advisory' : 'Draft New Port Advisory' ?></h1>
            <p class="admin-subtitle">Publish operational advisories, regulatory notices and shipping lane bulletins.</p>
        </div>
        <div>
            <a href="<?= e(url('/admin/news.php')) ?>" class="btn btn-secondary btn-sm">
                <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
                Cancel &amp; Return
            </a>
        </div>
    </div>

    <div class="admin-card" style="max-width:900px;">
        <form method="POST" action="<?= e(url('/admin/news.php?action=' . $action . ($editId ? '&id=' . $editId : ''))) ?>">
            <input type="hidden" name="save_article" value="1">
            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">

            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">Advisory Headline / Title *</label>
                <input type="text" name="title" required class="form-control" value="<?= e($article['title'] ?? '') ?>" placeholder="e.g., Port of Colombo Deep-Water Berthing Window Protocol">
            </div>

            <div class="admin-form-grid">
                <div>
                    <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">Category Classification</label>
                    <select name="category" class="form-control">
                        <option value="Port Advisory" <?= ($article['category'] ?? '') === 'Port Advisory' ? 'selected' : '' ?>>Port Advisory</option>
                        <option value="Regulatory Update" <?= ($article['category'] ?? '') === 'Regulatory Update' ? 'selected' : '' ?>>Regulatory Update</option>
                        <option value="Infrastructure" <?= ($article['category'] ?? '') === 'Infrastructure' ? 'selected' : '' ?>>Infrastructure</option>
                        <option value="Carrier Bulletin" <?= ($article['category'] ?? '') === 'Carrier Bulletin' ? 'selected' : '' ?>>Carrier Bulletin</option>
                        <option value="Trade Lane" <?= ($article['category'] ?? '') === 'Trade Lane' ? 'selected' : '' ?>>Trade Lane Alert</option>
                    </select>
                </div>

                <div>
                    <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">Publication Status</label>
                    <div style="padding-top:0.6rem;">
                        <label style="display:inline-flex; align-items:center; gap:0.5rem; cursor:pointer; font-size:0.9rem; font-weight:600; color:#0F172A;">
                            <input type="checkbox" name="is_published" value="1" <?= (!isset($article) || $article['is_published']) ? 'checked' : '' ?> style="width:18px; height:18px;">
                            Published on Public Website
                        </label>
                    </div>
                </div>
            </div>

            <div style="margin-bottom:1.25rem;">
                <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">Executive Summary (Card Excerpt) *</label>
                <textarea name="summary" required rows="3" class="form-control" placeholder="A concise 2-sentence summary visible on listing pages and search cards..."><?= e($article['summary'] ?? '') ?></textarea>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label style="display:block; font-size:0.8rem; font-weight:700; text-transform:uppercase; color:#475569; margin-bottom:0.5rem;">Advisory Full Content *</label>
                <textarea name="content" required rows="10" class="form-control" placeholder="Detailed bulletin content, vessel guidance, customs schedules, operational directives..." style="line-height:1.6; font-size:0.9rem;"><?= e($article['content'] ?? '') ?></textarea>
                <small style="color:#64748B; font-size:0.75rem; display:block; margin-top:0.35rem;">Line breaks are automatically preserved on the public site reader.</small>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:0.75rem;">
                <a href="<?= e(url('/admin/news.php')) ?>" class="btn btn-secondary btn-sm">Cancel</a>
                <button type="submit" class="btn btn-primary btn-sm">
                    <span class="material-symbols-outlined" style="font-size: 18px;">publish</span>
                    <?= $action === 'edit' ? 'Update Advisory' : 'Publish Advisory' ?>
                </button>
            </div>
        </form>
    </div>

<?php else: ?>
    <!-- List View -->
    <div class="admin-header-actions">
        <div>
            <h1 class="admin-title">Port Advisories & Bulletins</h1>
            <p class="admin-subtitle">Operational intelligence, berthing schedules, customs advisories and maritime updates.</p>
        </div>
        <div>
            <a href="<?= e(url('/admin/news.php?action=create')) ?>" class="btn btn-primary btn-sm">
                <span class="material-symbols-outlined" style="font-size:18px;">add_circle</span>
                Draft New Advisory
            </a>
        </div>
    </div>

    <div class="admin-card" style="padding:0; overflow:hidden;">
        <?php if (empty($articles)): ?>
            <div style="text-align:center; padding:4rem 2rem;">
                <span class="material-symbols-outlined" style="font-size: 48px; color:#94A3B8; margin-bottom:1rem; display:block;">campaign</span>
                <h3 style="font-size:1.15rem; color:#0F172A; margin-bottom:0.35rem;">No Advisories on Record</h3>
                <p style="color:#64748B; font-size:0.875rem;">Create your first port bulletin to notify shippers and clients.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive" style="border:none; box-shadow:none;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Title & Category</th>
                            <th>Summary</th>
                            <th>Status</th>
                            <th>Published Date</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $a): ?>
                            <tr>
                                <td style="max-width:300px;">
                                    <div style="font-weight:700; color:#0F172A; font-size:0.95rem;">
                                        <?= e($a['title']) ?>
                                    </div>
                                    <div style="font-size:0.75rem; color:#245B82; font-weight:600; text-transform:uppercase; margin-top:0.25rem;">
                                        <?= e($a['category']) ?>
                                    </div>
                                </td>
                                <td style="font-size:0.85rem; color:#475569; max-width:350px;">
                                    <?= e(mb_strimwidth($a['summary'], 0, 100, '...')) ?>
                                </td>
                                <td>
                                    <form method="POST" action="<?= e(url('/admin/news.php')) ?>" style="margin:0;">
                                        <input type="hidden" name="toggle_published" value="1">
                                        <input type="hidden" name="article_id" value="<?= $a['id'] ?>">
                                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                        <button type="submit" style="background:none; border:none; cursor:pointer; padding:0;">
                                            <span class="badge" style="background:<?= $a['is_published'] ? '#D1FAE5; color:#065F46;' : '#FEE2E2; color:#991B1B;' ?>">
                                                <?= $a['is_published'] ? 'PUBLISHED' : 'DRAFT' ?>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                                <td style="font-size:0.8rem; color:#64748B; white-space:nowrap;">
                                    <?= date('M d, Y', strtotime($a['published_date'])) ?>
                                </td>
                                <td style="text-align:right; white-space:nowrap;">
                                    <div style="display:inline-flex; gap:0.5rem; align-items:center;">
                                        <?php if ($a['is_published']): ?>
                                            <a href="<?= e(url('/news-detail.php?slug=' . urlencode($a['slug']))) ?>" target="_blank" style="color:#245B82; display:inline-flex; align-items:center;" title="View Live">
                                                <span class="material-symbols-outlined" style="font-size: 18px;">open_in_new</span>
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?= e(url('/admin/news.php?action=edit&id=' . $a['id'])) ?>" class="btn btn-primary btn-sm" style="font-size:0.75rem; padding:0.35rem 0.65rem;">
                                            Edit
                                        </a>
                                        <form method="POST" action="<?= e(url('/admin/news.php')) ?>" style="margin:0;" onsubmit="return confirm('Delete this advisory permanently?');">
                                            <input type="hidden" name="delete_article" value="1">
                                            <input type="hidden" name="article_id" value="<?= $a['id'] ?>">
                                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                            <button type="submit" style="background:none; border:none; cursor:pointer; color:#EF4444; padding:0.25rem; display:inline-flex; align-items:center;" title="Delete Advisory">
                                                <span class="material-symbols-outlined" style="font-size: 18px;">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
