<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Global System Configuration & Security Helpers
 */

declare(strict_types=1);

// Prevent direct access if needed, or start session safely
if (session_status() === PHP_SESSION_NONE) {
    // Configure secure session cookie parameters
    $is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
                 (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) ||
                 (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

    session_set_cookie_params([
        'lifetime' => 86400 * 7, // 7 days
        'path' => '/',
        'domain' => '',
        'secure' => $is_https,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

// Load .env file if present in root
$env_file = dirname(__DIR__) . '/.env';
if (file_exists($env_file)) {
    $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $key = trim($parts[0]);
            $val = trim($parts[1]);
            // Remove optional surrounding quotes
            $val = trim($val, "\"'");
            if (!isset($_SERVER[$key]) && !isset($_ENV[$key])) {
                putenv("$key=$val");
                $_ENV[$key] = $val;
                $_SERVER[$key] = $val;
            }
        }
    }
}

// Environment helper
function env(string $key, mixed $default = null): mixed {
    $val = getenv($key);
    if ($val === false) {
        return $_ENV[$key] ?? $_SERVER[$key] ?? $default;
    }
    return match (strtolower((string)$val)) {
        'true', '(true)' => true,
        'false', '(false)' => false,
        'empty', '(empty)' => '',
        'null', '(null)' => null,
        default => $val
    };
}

// Application Settings
define('APP_NAME', 'Spillburg Logistics 1');
define('APP_LEGAL_NAME', 'Spillburg Logistics 1 (Private) Limited');
define('APP_TAGLINE', 'Moving Cargo. Connecting Businesses.');
define('APP_ENV', env('APP_ENV', 'development'));
define('APP_DEBUG', env('APP_DEBUG', false));
define('APP_URL', rtrim((string)env('APP_URL', 'http://localhost:8000'), '/'));

// Verified Company Contact & Physical Logistics Coordinates
define('COMPANY_PHONE_PRIMARY', '+94 11 2336116');
define('COMPANY_PHONE_OPS_1', '+94 777 487720');
define('COMPANY_PHONE_OPS_2', '+94 777 790919');
define('COMPANY_EMAIL', env('SITE_CONTACT_EMAIL', 'info@spillburglogistics1.com'));
define('COMPANY_NOTIFICATION_EMAIL', env('QUOTE_NOTIFICATIONS_EMAIL', 'info@spillburglogistics1.com'));

define('COMPANY_ADDRESS_LINE1', 'Office 14, Basement Level, Cinnamon Lakeside Hotel');
define('COMPANY_ADDRESS_LINE2', 'No 115, Sir Chittampalam A Gardiner Mawatha');
define('COMPANY_ADDRESS_CITY', 'Colombo 02');
define('COMPANY_ADDRESS_COUNTRY', 'Sri Lanka');
define('COMPANY_FULL_ADDRESS', COMPANY_ADDRESS_LINE1 . ', ' . COMPANY_ADDRESS_LINE2 . ', ' . COMPANY_ADDRESS_CITY . ', ' . COMPANY_ADDRESS_COUNTRY);

// Group Affiliation Links
define('GROUP_HOLDINGS_URL', 'https://www.spillburg.com');
define('GROUP_CORPORATE_URL', 'https://www.spillburgcorporate.com/en');
define('GROUP_VACATION_URL', 'https://spillburgvacation.com/v7/');
define('GROUP_LOGISTICS_URL', 'https://www.spillburglogistics1.com');

// Error reporting based on environment
if (APP_DEBUG) {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    error_reporting(E_ALL);
    ini_set('log_errors', '1');
    ini_set('error_log', dirname(__DIR__) . '/logs/error.log');
}

/**
 * CSRF Protection Helpers
 */
function get_csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_token(): string {
    return get_csrf_token();
}

function verify_csrf_token(?string $token): bool {
    if (empty($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

function csrf_field(): string {
    $token = htmlspecialchars(get_csrf_token(), ENT_QUOTES, 'UTF-8');
    return '<input type="hidden" name="csrf_token" value="' . $token . '">';
}

/**
 * Output sanitization helper
 */
function e(?string $str): string {
    if ($str === null) {
        return '';
    }
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * Flash messaging system
 */
function set_flash(string $type, string $message): void {
    $_SESSION['flash'] = [
        'type' => $type, // 'success', 'error', 'info', 'warning'
        'message' => $message
    ];
}

function get_flash(): ?array {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

/**
 * URL Helper
 * Returns root-relative path ensuring assets and links work on ANY port/host
 */
function url(string $path = ''): string {
    $path = ltrim($path, '/');
    if ($path === '') {
        return '/';
    }
    return '/' . $path;
}

/**
 * Absolute URL Helper for Canonical and OpenGraph meta tags
 */
function absolute_url(string $path = ''): string {
    $path = ltrim($path, '/');
    if (!empty($_SERVER['HTTP_HOST'])) {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        return $scheme . '://' . $_SERVER['HTTP_HOST'] . '/' . $path;
    }
    return APP_URL . '/' . $path;
}

/**
 * Active navigation link checker
 */
function is_active(string $route): string {
    $current = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    $current = trim((string)$current, '/');
    $route = trim($route, '/');
    
    if ($route === '' && ($current === '' || $current === 'index.php')) {
        return ' active';
    }
    if ($route !== '' && (str_contains($current, $route) || ($current === $route . '.php'))) {
        return ' active';
    }
    return '';
}
