# ===============================
# 🧱 Dockerfile: Laravel + Apache
# ===============================

# Gunakan base image resmi PHP 8.3 dengan Apache
FROM php:8.3-apache

# Install dependensi sistem & PHP extension yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Salin seluruh file project ke container
COPY . .

# Install composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Pastikan folder penting bisa ditulis Apache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Aktifkan mod_rewrite agar route Laravel berfungsi
RUN a2enmod rewrite

# Set document root ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Port default Apache
EXPOSE 80

# # Tambahkan healthcheck agar mudah monitor container
# HEALTHCHECK --interval=30s --timeout=5s --start-period=40s --retries=3 \
#   CMD curl -f http://localhost/ || exit 1

# Jalankan Apache
CMD ["apache2-foreground"]
