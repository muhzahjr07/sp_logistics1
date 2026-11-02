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

# Ensure Apache listens on PORT assigned by Render (default 10000 or 80)
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Configure directory permissions for SQLite database and uploads
RUN mkdir -p /var/www/html/database /var/www/html/logs \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/database /var/www/html/logs

# Set default Render environment variable
ENV PORT=10000

EXPOSE ${PORT}

# Run database migration seeds and start Apache in foreground
CMD ["sh", "-c", "php database/migrations.php && apache2-foreground"]
