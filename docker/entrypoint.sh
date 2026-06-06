#!/bin/sh
set -e

cd /var/www

mkdir -p \
    vendor \
    storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

if [ ! -f vendor/autoload.php ] || [ composer.lock -nt vendor/autoload.php ]; then
    echo "Installing Composer dependencies..."
    COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction --prefer-dist --optimize-autoloader
    chown -R www-data:www-data vendor
fi

if [ -f .env ]; then
    APP_KEY_VALUE="$(grep -E '^APP_KEY=' .env | cut -d= -f2-)"

    if [ -z "$APP_KEY_VALUE" ] || [ "$APP_KEY_VALUE" = "base64:key_placeholder" ]; then
        echo "Generating Laravel application key..."
        php artisan key:generate --force
    fi
fi

exec "$@"
