FROM php:8.2-apache

# Install dependencies yang diperlukan Laravel & PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file project ke dalam container
COPY . .

# Install dependency PHP via Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader

# Atur permission folder storage dan bootstrap cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Ganti DocumentRoot Apache ke folder public Laravel
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Enable Apache mod_rewrite untuk URL Laravel
RUN a2enmod rewrite

# Expose port 80 (Render secara internal menggunakan port ini)
EXPOSE 80
