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

# Pastikan folder penting ada (jika belum dibuat oleh repo) dan bisa ditulis Apache,
# lalu buat symlink public/storage -> ../storage/app/public (mengikuti perintah yang kamu minta)
RUN set -eux; \
    # buat direktori storage yang diperlukan jika belum ada
    mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs public/uploads; \
    # hapus jika ada file atau symlink lama di public/storage
    rm -f public/storage || true; \
    # buat symlink relative dari public ke storage/app/public
    ln -s ../storage/app/public public/storage || true; \
    # tampilkan listing & resolve link (berguna saat build logs)
    ls -la public | grep storage || true; \
    readlink public/storage || readlink -f public/storage || true; \
    # set owner & permission untuk storage dan link
    chown -R www-data:www-data storage public/storage public/uploads; \
    # set permission directories dan file pada storage
    find storage -type d -exec chmod 755 {} \; ; \
    find storage -type f -exec chmod 644 {} \; ; \
    # optional: beri write ke storage/app/public jika aplikasi perlu upload
    chmod -R u+w storage/app/public; \
    # set permission untuk public/uploads (untuk upload langsung ke public/uploads)
    chmod -R 755 public/uploads

# Aktifkan mod_rewrite agar route Laravel berfungsi
RUN a2enmod rewrite

# Set document root ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Port default Apache
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
