#!/bin/sh
set -e

# Render passes PORT dynamically at container runtime (default 10000 if not set)
PORT="${PORT:-10000}"
echo "Configuring Apache to listen on port: ${PORT}"

# Replace port in Apache ports.conf and default virtualhost configuration
sed -i "s/Listen [0-9]*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:[0-9]*>/<VirtualHost \*:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Run database migrations/seeds if needed
if [ -f "/var/www/html/database/migrations.php" ]; then
    echo "Running database migrations..."
    php /var/www/html/database/migrations.php || true
fi

# Start Apache in foreground
echo "Starting Apache..."
exec apache2-foreground

