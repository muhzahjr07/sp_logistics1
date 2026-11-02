# Spillburg Logistics 1 — Production Deployment Guide

This guide provides instructions for deploying the **Spillburg Logistics 1** web platform to production hosting environments (Render Cloud, cPanel, standard Apache, LiteSpeed, or Nginx).

---

## 1. Quick Deploy to Render.com (Recommended Cloud PaaS)

This repository includes a production-ready `Dockerfile` and `render.yaml` specification for zero-config container deployment on Render.

### Step 1: Connect GitHub Repository
1. Log into your [Render Dashboard](https://dashboard.render.com/).
2. Click **New +** &rarr; Select **Web Service** (or **Blueprint** to use `render.yaml`).
3. Connect your GitHub repository: `https://github.com/muhzahjr07/sp_logistics1`.

### Step 2: Configure Web Service
If setting up manually as a Web Service:
- **Name**: `spillburg-logistics1`
- **Language**: `Docker`
- **Branch**: `main`
- **Region**: Choose closest to target market (e.g. `Singapore` for Sri Lanka / Asia or `Frankfurt` / `Oregon`).
- **Plan**: `Free` or `Starter`.

### Step 3: Environment Variables
Add the following in the **Environment** tab:
| Key | Value | Notes |
|---|---|---|
| `APP_ENV` | `production` | Enables production mode |
| `APP_DEBUG` | `false` | Disables debug stacktraces |
| `DB_CONNECTION` | `sqlite` | Uses auto-migrated persistent SQLite or switch to `mysql` |
| `SITE_CONTACT_EMAIL` | `info@spillburglogistics1.com` | Primary recipient for inquiries |
| `QUOTE_NOTIFICATIONS_EMAIL` | `info@spillburglogistics1.com` | Destination for RFQ notifications |

*(If connecting to an external cloud MySQL instance like PlanetScale, Aiven, or AWS RDS, set `DB_CONNECTION=mysql` along with `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`).*

### Step 4: Deploy
Click **Create Web Service**. Render will automatically build the Docker image, run migrations, and launch Apache.

---

## 2. Hosting Requirements

- **PHP Version**: PHP 8.2 or later (PHP 8.3 recommended).
- **PHP Extensions**:
  - `pdo`
  - `pdo_mysql` (for production MySQL/MariaDB)
  - `pdo_sqlite` (optional, for development/fallback)
  - `mbstring`
  - `curl`
  - `openssl`
  - `json`
- **Web Server**: Apache 2.4+ (with `mod_rewrite`), LiteSpeed, or Nginx.
- **Database**: MySQL 8.0+ or MariaDB 10.5+.
- **SSL Certificate**: HTTPS enabled (Let's Encrypt or commercial SSL).

---

## 2. cPanel Deployment (Standard Setup)

### Step 1: Upload Files
1. Log into your cPanel account.
2. Open **File Manager** and navigate to your domain document root (usually `public_html` or a subdomain folder like `public_html/spillburglogistics1`).
3. Upload all project files from the repository root. Ensure hidden files like `.htaccess` and `.env` are included.

### Step 2: Create MySQL Database
1. In cPanel, go to **MySQL Databases**.
2. Create a new database: e.g., `spillburg_logistics1`.
3. Create a new MySQL user with a strong password: e.g., `spillburg_admin`.
4. Add the user to the database with **ALL PRIVILEGES**.
5. Open **phpMyAdmin**, select the newly created database, click the **Import** tab, and import `database/schema.sql`.

### Step 3: Configure `.env` File
1. In the project root, create a file named `.env` based on `.env.example`:
   ```bash
   APP_NAME="Spillburg Logistics 1"
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://www.spillburglogistics1.com

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_cpanel_database_name
   DB_USERNAME=your_cpanel_database_user
   DB_PASSWORD=your_cpanel_database_password

   SITE_CONTACT_EMAIL=info@spillburglogistics1.com
   QUOTE_NOTIFICATIONS_EMAIL=quotes@spillburglogistics1.com
   ```
2. Set permissions on `.env` to `600` or `640` to ensure it is protected from unauthorized access.
3. The included `.htaccess` file blocks web access to `.env`, `.git`, `.sqlite`, and `config/` files.

---

## 3. Web Server Configuration

### Apache / LiteSpeed (`.htaccess`)
The project includes a production `.htaccess` file with:
- URL rewriting for clean URLs (optional).
- Security headers (`X-Frame-Options`, `X-Content-Type-Options`, `Referrer-Policy`).
- Protection against direct access to sensitive configuration files:
  ```apache
  <FilesMatch "^\.env|schema\.sql|logistics1\.sqlite">
      Order allow,deny
      Deny from all
  </FilesMatch>
  ```

### Nginx Configuration
If deploying on an Nginx server, use the following server block:
```nginx
server {
    listen 80;
    server_name spillburglogistics1.com www.spillburglogistics1.com;
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl http2;
    server_name spillburglogistics1.com www.spillburglogistics1.com;
    root /var/www/spillburglogistics1;
    index index.php index.html;

    # SSL Configuration
    ssl_certificate /etc/letsencrypt/live/spillburglogistics1.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/spillburglogistics1.com/privkey.pem;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    # Block sensitive files
    location ~* (^|/)\.(env|git|htaccess) {
        deny all;
        return 404;
    }
    location ~* \.(sqlite|sql|log)$ {
        deny all;
        return 404;
    }

    # Static assets caching
    location ~* \.(css|js|webp|png|jpg|jpeg|gif|ico|svg|woff2?)$ {
        expires 30d;
        add_header Cache-Control "public, no-transform";
    }

    # Route PHP requests
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

---

## 4. Post-Deployment Checklist

1. **Verify Database Connectivity**:
   - Access `https://your-domain.com/admin/login.php`.
   - Log in with `admin@spillburglogistics1.com` / `SpillburgLogistics2026!`.
2. **Update Admin Credentials**:
   - Change the master administrator password and email in phpMyAdmin or via your database management tool:
     ```sql
     UPDATE admins SET password_hash = '$2y$12$NEW_HASH_HERE' WHERE email = 'admin@spillburglogistics1.com';
     ```
3. **Configure Notifications Mailbox**:
   - In `admin/settings.php`, confirm the operational notification recipient email.
   - If using standard PHP `mail()`, ensure SPF and DKIM records are configured for `spillburglogistics1.com` in cPanel Email Deliverability to prevent messages landing in spam.
4. **Test Quote Submission**:
   - Submit a test quote on `/quote.php`.
   - Verify that an `RFQ-SL1-2026-XXXX` docket receipt displays.
   - Log into `/admin/quotes.php` to verify the docket appears in the management list.
5. **Ensure Debug Mode Is Disabled**:
   - Ensure `APP_DEBUG=false` in `.env` to prevent error call stacks from being displayed to visitors.

---

## 5. Security & Maintenance

- **Backups**: Schedule automated daily backups of the MySQL database and the `/database` folder in cPanel.
- **Log Monitoring**: Check `/logs/error.log` periodically for unhandled warnings or carrier API timeouts.
- **SSL Auto-Renewal**: Ensure Let's Encrypt AutoSSL is enabled in cPanel.
