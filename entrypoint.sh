#!/bin/sh

# Install dependencies
composer install

# Build frontend assets (optional)
npm install && npm run build

# Laravel key generation and migrations
php artisan key:generate
php artisan migrate --force

# Finally, start php-fpm
exec php-fpm
