FROM php:8.2-apache

# Enable Apache mod_rewrite & headers
RUN a2enmod rewrite headers

# Install system dependencies & SQLite / PDO MySQL extensions
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy application source
COPY . /var/www/html/

# Configure directory permissions for SQLite database and logs
RUN mkdir -p /var/www/html/database /var/www/html/logs \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/database /var/www/html/logs \
    && chmod +x /var/www/html/entrypoint.sh

# Default environment port
ENV PORT=10000

EXPOSE 10000

# Execute entrypoint to dynamically bind Render's PORT and launch Apache
ENTRYPOINT ["/bin/sh", "/var/www/html/entrypoint.sh"]
