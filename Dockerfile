FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    libgd-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install ionCube Loader
RUN curl -o ioncube.tar.gz https://downloads.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz \
    && tar -xvzf ioncube.tar.gz \
    && mv ioncube/ioncube_loader_lin_8.2.so $(php -r "echo ini_get('extension_dir');")/ioncube_loader_lin_8.2.so \
    && rm -rf ioncube.tar.gz ioncube \
    && echo "zend_extension=ioncube_loader_lin_8.2.so" > /usr/local/etc/php/conf.d/00-ioncube.ini

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    zip \
    xml \
    ctype \
    intl \
    mysqli

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose port (PHP-FPM default)
EXPOSE 9000

ENTRYPOINT ["entrypoint.sh"]
