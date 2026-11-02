<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Custom 404 Error Page
 */

require_once __DIR__ . '/config/config.php';

http_response_code(404);

$page_title = 'Page Not Found (404)';
$page_desc = 'The requested logistics resource or cargo route could not be found.';

require_once __DIR__ . '/includes/header.php';
?>

<section class="section-spacing bg-white" style="min-height: 60vh; display: flex; align-items: center;">
    <div class="container container-narrow" style="text-align: center;">
        <span class="technical-label amber" style="margin-bottom: 0.75rem;">
            <span class="material-symbols-outlined" style="font-size: 16px;">warning</span>
            NAVIGATIONAL EXCEPTION
        </span>
        <h1 style="font-size: 4rem; color: var(--color-midnight); line-height: 1; margin-bottom: 1rem; font-family: var(--font-mono);">
            404
        </h1>
        <h2 style="font-size: 1.75rem; margin-bottom: 1rem; color: var(--color-midnight);">
            Logistics Route or Document Not Found
        </h2>
        <p style="font-size: 1rem; color: var(--color-text-secondary); max-width: 540px; margin: 0 auto 2.5rem; line-height: 1.6;">
            The URL or docket identifier you attempted to access is unavailable or has been relocated within our shipping network.
        </p>

        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="<?= url() ?>" class="btn btn-primary">
                Return to Homepage
            </a>
            <a href="<?= url('services.php') ?>" class="btn btn-secondary">
                View Freight Services
            </a>
            <a href="<?= url('quote.php') ?>" class="btn btn-amber">
                Request a Quote
            </a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
