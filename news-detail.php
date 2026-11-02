<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Single Port Advisory / Circular View
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

$slug = trim((string)($_GET['slug'] ?? ''));

if ($slug === '') {
    header('Location: ' . url('news.php'));
    exit;
}

try {
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM news WHERE slug = :slug AND is_published = 1 LIMIT 1");
    $stmt->execute([':slug' => $slug]);
    $article = $stmt->fetch();

    if (!$article) {
        http_response_code(404);
        require_once __DIR__ . '/404.php';
        exit;
    }
} catch (Exception $e) {
    header('Location: ' . url('news.php'));
    exit;
}

$page_title = $article['title'];
$page_desc = $article['summary'];

$breadcrumbs = [
    ['title' => 'Port Advisories', 'url' => 'news.php'],
    ['title' => $article['title'], 'url' => 'news-detail.php?slug=' . urlencode($slug)]
];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<section class="section-spacing bg-white">
    <div class="container container-narrow">
        <article>
            <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1.25rem;">
                <span class="badge badge-info"><?= e($article['category']) ?></span>
                <span style="font-size: 0.8125rem; color: var(--color-text-muted); font-family: var(--font-mono);">
                    Published on <?= date('F d, Y', strtotime($article['published_date'])) ?>
                </span>
            </div>

            <h1 style="font-size: 2.25rem; line-height: 1.25; margin-bottom: 1.5rem; color: var(--color-midnight);">
                <?= e($article['title']) ?>
            </h1>

            <div style="background-color: var(--color-surface-bg); border-left: 4px solid var(--color-blue-industrial); padding: 1.25rem 1.5rem; border-radius: var(--radius-sm); margin-bottom: 2.5rem; font-size: 1.0625rem; color: var(--color-text-primary); font-weight: 500; line-height: 1.6;">
                <?= e($article['summary']) ?>
            </div>

            <div style="font-size: 1rem; line-height: 1.8; color: var(--color-text-secondary); margin-bottom: 3.5rem;">
                <?= $article['content'] // Contains formatted HTML ?>
            </div>

            <div style="background-color: var(--color-surface-bg); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
                <div>
                    <h3 style="font-size: 1.125rem; margin-bottom: 0.25rem;">Affected by this Trade Notice?</h3>
                    <p style="font-size: 0.875rem; color: var(--color-text-muted); margin-bottom: 0;">
                        Speak with our freight coordinators to evaluate schedule alternatives or route buffers.
                    </p>
                </div>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <a href="<?= url('quote.php') ?>" class="btn btn-amber">
                        Request a Quote
                    </a>
                    <a href="<?= url('news.php') ?>" class="btn btn-secondary">
                        &larr; Back to Advisories
                    </a>
                </div>
            </div>
        </article>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
