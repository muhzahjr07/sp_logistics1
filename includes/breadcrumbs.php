<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Semantic Breadcrumb Navigation Component
 *
 * @var array $breadcrumbs Array of ['title' => '...', 'url' => '...']
 */
if (!empty($breadcrumbs)):
?>
<nav class="breadcrumbs-bar" aria-label="Breadcrumb">
    <div class="container">
        <ol class="breadcrumbs-list">
            <li>
                <a href="<?= url() ?>">Home</a>
            </li>
            <?php foreach ($breadcrumbs as $i => $crumb): ?>
                <li class="breadcrumbs-sep" aria-hidden="true">/</li>
                <?php if ($i === array_key_last($breadcrumbs) || empty($crumb['url'])): ?>
                    <li aria-current="page" style="color: var(--color-midnight); font-weight: 600;">
                        <?= e($crumb['title']) ?>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?= url($crumb['url']) ?>"><?= e($crumb['title']) ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </div>
</nav>
<?php endif; ?>
