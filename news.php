<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Port & Trade Advisories — Industry News & Notices
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

$page_title = 'Port & Trade Advisories';
$page_desc = 'Operational intelligence, port congestion notices, customs regulations, and maritime corridor updates from Spillburg Logistics 1.';

$breadcrumbs = [
    ['title' => 'Port Advisories', 'url' => 'news.php']
];

// Fetch published news from database
try {
    $db = Database::getConnection();
    $stmt = $db->query("SELECT * FROM news WHERE is_published = 1 ORDER BY published_date DESC");
    $articles = $stmt->fetchAll();
} catch (Exception $e) {
    $articles = [];
}

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/breadcrumbs.php';
?>

<section class="page-hero">
    <div class="page-hero-overlay" style="background-image: linear-gradient(90deg, rgba(0, 14, 31, 0.95) 0%, rgba(0, 14, 31, 0.85) 100%), url('<?= url('assets/images/hero-colombo-port.webp') ?>');"></div>
    <div class="container">
        <div class="page-hero-content">
            <span class="technical-label amber" style="margin-bottom: 0.75rem;">
                <span class="material-symbols-outlined" style="font-size: 16px;">campaign</span>
                OPERATIONAL INTELLIGENCE
            </span>
            <h1>Port &amp; Trade Advisories</h1>
            <p>
                Essential notifications covering Port of Colombo terminal operations, customs tariff adjustments, and global maritime shipping corridors.
            </p>
        </div>
    </div>
</section>

<section class="section-spacing bg-surface">
    <div class="container">

        <?php if (!empty($articles)): ?>
        <div class="cards-grid-3">
            <?php foreach ($articles as $art): ?>
            <article style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 2.25rem; display: flex; flex-direction: column; box-shadow: var(--shadow-sm); transition: transform 0.2s, box-shadow 0.2s;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                    <span class="badge badge-info"><?= e($art['category']) ?></span>
                    <span style="font-size: 0.75rem; color: var(--color-text-muted); font-family: var(--font-mono);">
                        <?= date('M d, Y', strtotime($art['published_date'])) ?>
                    </span>
                </div>
                <h2 style="font-size: 1.25rem; line-height: 1.35; margin-bottom: 0.85rem;">
                    <a href="<?= url('news-detail.php?slug=' . urlencode($art['slug'])) ?>" style="color: var(--color-midnight);">
                        <?= e($art['title']) ?>
                    </a>
                </h2>
                <p style="font-size: 0.9375rem; color: var(--color-text-secondary); line-height: 1.6; margin-bottom: 1.75rem; flex-grow: 1;">
                    <?= e($art['summary']) ?>
                </p>
                <div style="border-top: 1px solid var(--color-border-slate); padding-top: 1.25rem; margin-top: auto;">
                    <a href="<?= url('news-detail.php?slug=' . urlencode($art['slug'])) ?>" class="card-link">
                        Read full advisory &rarr;
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <?php else: ?>
        <!-- Polished Empty State -->
        <div style="background-color: var(--color-surface-white); border: 1px solid var(--color-border-slate); border-radius: var(--radius-lg); padding: 4rem 2rem; text-align: center; max-width: 600px; margin: 0 auto;">
            <span class="material-symbols-outlined" style="font-size: 48px; color: var(--color-blue-industrial); margin-bottom: 1rem;">newspaper</span>
            <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">No Current Advisories Published</h3>
            <p style="color: var(--color-text-secondary); font-size: 0.9375rem; margin-bottom: 1.5rem;">
                All Port of Colombo terminal gates and shipping lanes are operating under normal conditions. New circulars will be published here as notices are issued by the Sri Lanka Ports Authority.
            </p>
            <a href="<?= url() ?>" class="btn btn-primary">Return to Homepage</a>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
