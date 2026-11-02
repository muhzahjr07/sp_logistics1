<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Administrative Console Logout
 */

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/auth.php';

Auth::logout();
set_flash('info', 'You have been logged out of the operations console.');
header('Location: ' . url('admin/login.php'));
exit;
