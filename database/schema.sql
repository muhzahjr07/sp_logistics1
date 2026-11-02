-- ==========================================================
-- Spillburg Logistics 1 (Private) Limited
-- Production MySQL / MariaDB Database Schema
-- Compatible with cPanel, phpMyAdmin, and MySQL 8.0+
-- ==========================================================

CREATE TABLE IF NOT EXISTS `admins` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(150) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `role` VARCHAR(50) NOT NULL DEFAULT 'operations_admin',
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `last_login_at` DATETIME NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `quotes` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `docket_number` VARCHAR(30) NOT NULL UNIQUE,
    `full_name` VARCHAR(120) NOT NULL,
    `company_name` VARCHAR(150) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `phone` VARCHAR(50) NOT NULL,
    `country` VARCHAR(80) NULL,
    `origin_pol` VARCHAR(150) NOT NULL,
    `destination_pod` VARCHAR(150) NOT NULL,
    `incoterm` VARCHAR(20) NOT NULL DEFAULT 'FOB',
    `target_etd` VARCHAR(50) NULL,
    `freight_mode` VARCHAR(30) NOT NULL DEFAULT 'sea',
    `commodity` VARCHAR(150) NOT NULL,
    `container_type` VARCHAR(80) NULL,
    `gross_weight` VARCHAR(50) NULL,
    `total_volume` VARCHAR(50) NULL,
    `package_count` VARCHAR(50) NULL,
    `req_customs` TINYINT(1) NOT NULL DEFAULT 0,
    `req_insurance` TINYINT(1) NOT NULL DEFAULT 0,
    `req_warehousing` TINYINT(1) NOT NULL DEFAULT 0,
    `req_delivery` TINYINT(1) NOT NULL DEFAULT 0,
    `special_instructions` TEXT NULL,
    `status` VARCHAR(30) NOT NULL DEFAULT 'pending',
    `operations_notes` TEXT NULL,
    `ip_address` VARCHAR(45) NULL,
    `user_agent` VARCHAR(255) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_docket` (`docket_number`),
    INDEX `idx_status` (`status`),
    INDEX `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `contacts` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(120) NOT NULL,
    `company` VARCHAR(150) NULL,
    `email` VARCHAR(150) NOT NULL,
    `phone` VARCHAR(50) NULL,
    `subject` VARCHAR(200) NOT NULL,
    `message` TEXT NOT NULL,
    `status` VARCHAR(30) NOT NULL DEFAULT 'unread',
    `ip_address` VARCHAR(45) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_contact_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `news` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `category` VARCHAR(80) NOT NULL DEFAULT 'Port Operations',
    `summary` TEXT NOT NULL,
    `content` LONGTEXT NOT NULL,
    `published_date` DATE NOT NULL,
    `is_published` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_news_published` (`is_published`, `published_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `settings` (
    `key_name` VARCHAR(100) PRIMARY KEY,
    `value` TEXT NOT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default Settings Seed
INSERT INTO `settings` (`key_name`, `value`) VALUES
('site_title', 'Spillburg Logistics 1 (Private) Limited'),
('tagline', 'Moving Cargo. Connecting Businesses.'),
('notification_email', 'info@spillburglogistics1.com'),
('primary_phone', '+94 11 2336116'),
('ops_phone_1', '+94 777 487720'),
('ops_phone_2', '+94 777 790919'),
('office_address', 'Office 14, Basement Level, Cinnamon Lakeside Hotel, No 115, Sir Chittampalam A Gardiner Mawatha, Colombo 02, Sri Lanka')
ON DUPLICATE KEY UPDATE `value`=`value`;
