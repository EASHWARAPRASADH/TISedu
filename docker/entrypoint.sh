#!/bin/bash

# Create storage flag files if they don't exist
mkdir -p /var/www/storage/app
mkdir -p /var/www/storage/framework/cache/data
mkdir -p /var/www/storage/framework/sessions
mkdir -p /var/www/storage/framework/views
mkdir -p /var/www/bootstrap/cache

# Create flag files
echo "1" > /var/www/storage/app/.app_installed
echo "1" > /var/www/storage/app/.temp_app_installed
date +%Y-%m-%d > /var/www/storage/app/.access_log

# Set permissions
chown -R www-data:www-data /var/www/storage
chown -R www-data:www-data /var/www/bootstrap/cache
chmod -R 775 /var/www/storage
chmod -R 775 /var/www/bootstrap/cache

# Start PHP-FPM
php-fpm -D

# Start Nginx
nginx -g 'daemon off;'
