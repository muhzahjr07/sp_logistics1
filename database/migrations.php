<?php
/**
 * Spillburg Logistics 1 (Private) Limited
 * Database Migrations & Initial Data Seeder
 */

declare(strict_types=1);

class Migrations {
    public static function run(PDO $pdo, string $driver = 'mysql'): void {
        if ($driver === 'sqlite') {
            self::runSqlite($pdo);
        } else {
            self::runMysql($pdo);
        }
        self::seedDefaultData($pdo);
    }

    private static function runSqlite(PDO $pdo): void {
        $queries = [
            "CREATE TABLE IF NOT EXISTS admins (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE,
                password_hash TEXT NOT NULL,
                role TEXT NOT NULL DEFAULT 'operations_admin',
                is_active INTEGER NOT NULL DEFAULT 1,
                last_login_at DATETIME NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );",

            "CREATE TABLE IF NOT EXISTS quotes (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                docket_number TEXT NOT NULL UNIQUE,
                full_name TEXT NOT NULL,
                company_name TEXT NOT NULL,
                email TEXT NOT NULL,
                phone TEXT NOT NULL,
                country TEXT NULL,
                origin_pol TEXT NOT NULL,
                destination_pod TEXT NOT NULL,
                incoterm TEXT NOT NULL DEFAULT 'FOB',
                target_etd TEXT NULL,
                freight_mode TEXT NOT NULL DEFAULT 'sea',
                commodity TEXT NOT NULL,
                container_type TEXT NULL,
                gross_weight TEXT NULL,
                total_volume TEXT NULL,
                package_count TEXT NULL,
                req_customs INTEGER NOT NULL DEFAULT 0,
                req_insurance INTEGER NOT NULL DEFAULT 0,
                req_warehousing INTEGER NOT NULL DEFAULT 0,
                req_delivery INTEGER NOT NULL DEFAULT 0,
                special_instructions TEXT NULL,
                status TEXT NOT NULL DEFAULT 'pending',
                operations_notes TEXT NULL,
                ip_address TEXT NULL,
                user_agent TEXT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );",

            "CREATE TABLE IF NOT EXISTS contacts (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                company TEXT NULL,
                email TEXT NOT NULL,
                phone TEXT NULL,
                subject TEXT NOT NULL,
                message TEXT NOT NULL,
                status TEXT NOT NULL DEFAULT 'unread',
                ip_address TEXT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );",

            "CREATE TABLE IF NOT EXISTS news (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT NOT NULL,
                slug TEXT NOT NULL UNIQUE,
                category TEXT NOT NULL DEFAULT 'Port Operations',
                summary TEXT NOT NULL,
                content TEXT NOT NULL,
                published_date DATE NOT NULL,
                is_published INTEGER NOT NULL DEFAULT 1,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );",

            "CREATE TABLE IF NOT EXISTS settings (
                key_name TEXT PRIMARY KEY,
                value TEXT NOT NULL,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );"
        ];

        foreach ($queries as $sql) {
            $pdo->exec($sql);
        }
    }

    private static function runMysql(PDO $pdo): void {
        $schemaFile = __DIR__ . '/schema.sql';
        if (file_exists($schemaFile)) {
            $sql = file_get_contents($schemaFile);
            $pdo->exec($sql);
        }
    }

    private static function seedDefaultData(PDO $pdo): void {
        // 1. Seed Default Admin if not exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM admins");
        $stmt->execute();
        if ((int)$stmt->fetchColumn() === 0) {
            $defaultPass = 'SpillburgLogistics2026!';
            $hash = password_hash($defaultPass, PASSWORD_BCRYPT);
            $insert = $pdo->prepare("INSERT INTO admins (name, email, password_hash, role, is_active) VALUES (:name, :email, :hash, 'super_admin', 1)");
            $insert->execute([
                ':name' => 'Spillburg Operations Director',
                ':email' => 'admin@spillburglogistics1.com',
                ':hash' => $hash
            ]);
        }

        // 2. Seed Settings
        $settings = [
            'site_title' => 'Spillburg Logistics 1 (Private) Limited',
            'tagline' => 'Moving Cargo. Connecting Businesses.',
            'notification_email' => 'info@spillburglogistics1.com',
            'primary_phone' => '+94 11 2336116',
            'ops_phone_1' => '+94 777 487720',
            'ops_phone_2' => '+94 777 790919',
            'office_address' => 'Office 14, Basement Level, Cinnamon Lakeside Hotel, No 115, Sir Chittampalam A Gardiner Mawatha, Colombo 02, Sri Lanka',
            'active_routes_status' => 'Colombo Port Terminals (JCT, CICT, SAGT) Normal Operational Status'
        ];

        foreach ($settings as $k => $v) {
            $chk = $pdo->prepare("SELECT COUNT(*) FROM settings WHERE key_name = :k");
            $chk->execute([':k' => $k]);
            if ((int)$chk->fetchColumn() === 0) {
                $ins = $pdo->prepare("INSERT INTO settings (key_name, value) VALUES (:k, :v)");
                $ins->execute([':k' => $k, ':v' => $v]);
            }
        }

        // 3. Seed Verified Port & Trade Advisories from Stitch Specification
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM news");
        $stmt->execute();
        if ((int)$stmt->fetchColumn() === 0) {
            $advisories = [
                [
                    'title' => 'Colombo Port JCT Phase IV Expansion: Berth Deepening & Feeder Turnaround Update',
                    'slug' => 'colombo-port-jct-phase-iv-expansion-berth-deepening',
                    'category' => 'Terminal Advisory',
                    'summary' => 'Sri Lanka Ports Authority (SLPA) announces accelerated quay crane integration and berth deepening to accommodate modern ULCS vessels at Jaya Container Terminal.',
                    'content' => "<p>The Sri Lanka Ports Authority (SLPA) has reported significant milestones in the Phase IV upgrade at Jaya Container Terminal (JCT). With new post-panamax ship-to-shore gantry cranes commissioned, terminal capacity for feeder turnaround across the Bay of Bengal and Arabian Sea corridors has increased by approximately 18%.</p><p>For Spillburg Logistics 1 clients utilizing Colombo as a primary transshipment node, dwell times for inter-terminal transfers between JCT, CICT, and SAGT remain within optimal windows. Transshipment cargo documentation is fully integrated through the SLPA automated gate operating systems.</p>",
                    'published_date' => '2026-09-15'
                ],
                [
                    'title' => 'Indian Ocean & Cape Route Transit Time Variations for Q4 Supply Chains',
                    'slug' => 'indian-ocean-cape-route-transit-time-variations-q4',
                    'category' => 'Routing Intelligence',
                    'summary' => 'Analysis of maritime schedule reliability and transshipment buffer requirements between Far East hubs, Colombo, and European discharge ports via the Cape of Good Hope.',
                    'content' => "<p>Global ocean freight networks continue to navigate revised transit schedules along the Cape route. Port of Colombo remains the pivotal deep-water bunkering and transshipment hub connecting Southeast Asian origins with European and North American destination ports.</p><p>Our operations desk advises shippers with tight delivery windows to build a 3-5 day contingency buffer for European discharge ports. Spillburg Logistics 1 provides multi-carrier booking allocations to guarantee space commitments and avoid rolled container delays.</p>",
                    'published_date' => '2026-08-28'
                ],
                [
                    'title' => 'Digital Automated Manifest Declaration Mandate: Sri Lanka Customs Regulatory Notice',
                    'slug' => 'digital-automated-manifest-declaration-mandate-sri-lanka-customs',
                    'category' => 'Customs & Regulatory',
                    'summary' => 'Sri Lanka Customs implements mandatory 24-hour advance electronic cargo manifest submission for all containerized import and transshipment dockets.',
                    'content' => "<p>In compliance with the updated Sri Lanka Customs Automated System for Customs Data (ASYCUDA World) regulations, all inbound maritime and air cargo manifests must be electronically lodged 24 hours prior to vessel arrival at Colombo or Hambantota.</p><p>Spillburg Logistics 1, as an approved customs brokerage and clearing agent, manages end-to-end EDI lodging, HS code classification, and BOI exemption entries on behalf of our client dockets to avoid customs holds and demurrage charges.</p>",
                    'published_date' => '2026-08-10'
                ]
            ];

            foreach ($advisories as $item) {
                $ins = $pdo->prepare("INSERT INTO news (title, slug, category, summary, content, published_date, is_published) VALUES (:title, :slug, :cat, :summary, :content, :pdate, 1)");
                $ins->execute([
                    ':title' => $item['title'],
                    ':slug' => $item['slug'],
                    ':cat' => $item['category'],
                    ':summary' => $item['summary'],
                    ':content' => $item['content'],
                    ':pdate' => $item['published_date']
                ]);
            }
        }
    }
}
