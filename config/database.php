<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Database Connection Manager (PDO)
 * Supports MySQL / MariaDB (production cPanel) and SQLite (automatic fallback)
 */

declare(strict_types=1);

require_once __DIR__ . '/config.php';

class Database {
    private static ?PDO $instance = null;
    private static string $driver = 'mysql';

    public static function getInstance(): PDO {
        return self::getConnection();
    }

    public static function getConnection(): PDO {
        if (self::$instance !== null) {
            return self::$instance;
        }

        $connection = env('DB_CONNECTION', 'mysql');
        $dbHost = env('DB_HOST', '127.0.0.1');
        $dbPort = env('DB_PORT', '3306');
        $dbDatabase = env('DB_DATABASE', 'spillburg_logistics1');
        $dbUsername = env('DB_USERNAME', 'root');
        $dbPassword = env('DB_PASSWORD', '');

        // Try MySQL first if configured
        if ($connection === 'mysql') {
            try {
                $dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbDatabase};charset=utf8mb4";
                $pdo = new PDO($dsn, $dbUsername, $dbPassword, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
                ]);
                self::$instance = $pdo;
                self::$driver = 'mysql';
                return self::$instance;
            } catch (PDOException $e) {
                // If in development or connection failed, fall back to SQLite to ensure zero-disruption operation
                error_log("MySQL connection failed: " . $e->getMessage() . ". Falling back to SQLite.");
            }
        }

        // SQLite Fallback
        $sqliteDir = dirname(__DIR__) . '/database';
        if (!is_dir($sqliteDir)) {
            mkdir($sqliteDir, 0755, true);
        }
        $sqlitePath = $sqliteDir . '/logistics1.sqlite';
        $dsn = "sqlite:" . $sqlitePath;

        try {
            $pdo = new PDO($dsn, null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
            // Enable WAL mode for high performance SQLite concurrency
            $pdo->exec('PRAGMA journal_mode = WAL;');
            $pdo->exec('PRAGMA foreign_keys = ON;');
            self::$instance = $pdo;
            self::$driver = 'sqlite';

            // Auto-run migrations if tables don't exist
            require_once __DIR__ . '/../database/migrations.php';
            Migrations::run(self::$instance, 'sqlite');

            return self::$instance;
        } catch (PDOException $e) {
            error_log("SQLite database initialization failed: " . $e->getMessage());
            throw new RuntimeException("Operational database unavailable: " . $e->getMessage());
        }
    }

    public static function getDriver(): string {
        if (self::$instance === null) {
            self::getConnection();
        }
        return self::$driver;
    }
}
