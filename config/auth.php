<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Authentication & Administrator Session Security
 */

declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/database.php';

class Auth {
    private const SESSION_USER_ID = 'spillburg_admin_id';
    private const SESSION_USER_EMAIL = 'spillburg_admin_email';
    private const SESSION_USER_NAME = 'spillburg_admin_name';
    private const SESSION_LAST_ACTIVITY = 'spillburg_last_activity';
    private const SESSION_TIMEOUT = 3600 * 4; // 4 hours

    public static function check(): bool {
        if (empty($_SESSION[self::SESSION_USER_ID])) {
            return false;
        }

        // Check for session timeout
        if (isset($_SESSION[self::SESSION_LAST_ACTIVITY]) &&
            (time() - $_SESSION[self::SESSION_LAST_ACTIVITY] > self::SESSION_TIMEOUT)) {
            self::logout();
            return false;
        }

        $_SESSION[self::SESSION_LAST_ACTIVITY] = time();
        return true;
    }

    public static function requireAuth(): void {
        if (!self::check()) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'] ?? url('admin');
            set_flash('error', 'Please authenticate to access the logistics administrative console.');
            header('Location: ' . url('admin/login.php'));
            exit;
        }
    }

    public static function user(): ?array {
        if (!self::check()) {
            return null;
        }
        return [
            'id' => $_SESSION[self::SESSION_USER_ID],
            'email' => $_SESSION[self::SESSION_USER_EMAIL],
            'name' => $_SESSION[self::SESSION_USER_NAME]
        ];
    }

    public static function attempt(string $email, string $password): bool {
        $email = trim(strtolower($email));
        if ($email === '' || $password === '') {
            return false;
        }

        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT id, name, email, password_hash, is_active FROM admins WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $admin = $stmt->fetch();

        if (!$admin || !(int)$admin['is_active']) {
            return false;
        }

        if (password_verify($password, $admin['password_hash'])) {
            // Prevent session fixation
            session_regenerate_id(true);

            $_SESSION[self::SESSION_USER_ID] = (int)$admin['id'];
            $_SESSION[self::SESSION_USER_EMAIL] = $admin['email'];
            $_SESSION[self::SESSION_USER_NAME] = $admin['name'];
            $_SESSION[self::SESSION_LAST_ACTIVITY] = time();

            // Update last login
            $update = $db->prepare("UPDATE admins SET last_login_at = CURRENT_TIMESTAMP WHERE id = :id");
            $update->execute([':id' => $admin['id']]);

            return true;
        }

        return false;
    }

    public static function logout(): void {
        unset(
            $_SESSION[self::SESSION_USER_ID],
            $_SESSION[self::SESSION_USER_EMAIL],
            $_SESSION[self::SESSION_USER_NAME],
            $_SESSION[self::SESSION_LAST_ACTIVITY]
        );
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
        }
    }
}

function require_admin(): void {
    Auth::requireAuth();
}

function is_admin(): bool {
    return Auth::check();
}
