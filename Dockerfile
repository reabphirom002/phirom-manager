FROM php:8.2-apache

# ដំឡើង dependencies របស់ប្រព័ន្ធ និង PHP extensions ដែលចាំបាច់សម្រាប់ Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# បើកដំណើរការ Apache mod_rewrite
RUN a2enmod rewrite

# កំណត់ Apache Document Root ទៅកាន់ Folder "public" របស់ Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# ចម្លងឯកសារគម្រោងទាំងអស់ចូលទៅក្នុង Container
COPY . /var/www/html

# ដំឡើង Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# កំណត់សិទ្ធិ (Permissions) ទៅលើ Folder storage និង bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80