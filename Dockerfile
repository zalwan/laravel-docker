FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create necessary directories first
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs storage/app/public bootstrap/cache && \
    mkdir -p /var/www && \
    chown -R www-data:www-data /var/www

# Copy application files with proper ownership
COPY --chown=www-data:www-data . .

# Switch to www-data for composer install
USER www-data

# Install dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Switch back to root for permissions
USER root

# Final permission setup
RUN chmod -R 777 /var/www/storage && \
    chmod -R 777 /var/www/bootstrap/cache

# Expose port
EXPOSE 9000

CMD ["php-fpm"]
