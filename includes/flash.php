<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Flash Message Notification Component
 */

$flash = get_flash();
if ($flash):
    $alertClass = match ($flash['type']) {
        'success' => 'alert-success',
        'error' => 'alert-error',
        default => 'alert-info'
    };
    $icon = match ($flash['type']) {
        'success' => 'check_circle',
        'error' => 'error',
        default => 'info'
    };
?>
<div class="container" style="margin-top: 1.5rem; margin-bottom: 0.5rem;">
    <div class="alert <?= $alertClass ?>" role="alert">
        <span class="material-symbols-outlined"><?= $icon ?></span>
        <div><?= e($flash['message']) ?></div>
    </div>
</div>
<?php endif; ?>
