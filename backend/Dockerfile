FROM php:8.3-apache

# 1. Install system dependencies & PostgreSQL dev libraries
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Install PHP extensions for Laravel & PostgreSQL
RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Enable Apache mod_rewrite for Laravel routes
RUN a2enmod rewrite

# 3. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files (uses wildcard to prevent error if composer.lock is missing)
COPY composer.* ./

# Install dependencies (no dev packages)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 4. Copy the rest of the application files
COPY . .

# 5. Set correct permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# 7. Configure Apache to listen on Render's dynamic PORT and point to the /public directory
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# AllowOverride All for the public directory so Laravel's .htaccess works (fixes 404s)
# Also set ServerName localhost to avoid apache startup warnings
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    { \
      echo "<Directory /var/www/html/public>"; \
      echo "    AllowOverride All"; \
      echo "    Require all granted"; \
      echo "</Directory>"; \
    } >> /etc/apache2/sites-available/000-default.conf

# 6. Create a startup script to run migrations and cache configs before starting Apache
RUN echo '#!/bin/bash\n\
php artisan config:cache\n\
php artisan route:cache\n\
php artisan view:cache\n\
php artisan migrate --force\n\
exec apache2-foreground\n\
' > /usr/local/bin/start.sh && chmod +x /usr/local/bin/start.sh

# Expose the PORT variable default (Render will override this at runtime)
ENV PORT=8000

# Start the application using the startup script
CMD ["/usr/local/bin/start.sh"]
