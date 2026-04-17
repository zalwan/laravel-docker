# Deployment Guide

This document describes how to deploy the Laravel + Docker application to a production environment.

## 1. Preparation
Ensure you have Docker and Docker Compose installed on your host server.

## 2. Clone the Repository
Clone your project onto the deployment server:
```bash
git clone <repository_url> /path/to/deployment
cd /path/to/deployment
```

## 3. Set Up Environment Variables
Copy `.env.example` to `.env`:
```bash
cp .env.example .env
```
Update `.env` with production settings:
- `APP_ENV=production`
- `APP_DEBUG=false`
- Update `APP_URL` with your server's domain.
- Set complex database credentials in `DB_PASSWORD`.

## 4. Spin Up Containers
Use docker compose to start the environment:
```bash
docker-compose up -d --build
```

## 5. First Time Setup Steps
Execute these commands specifically in the newly running application container:
```bash
# Install PHP dependencies without dev dependencies
docker-compose exec app composer install --optimize-autoloader --no-dev

# Generate the app key
docker-compose exec app php artisan key:generate

# Run DB migrations
docker-compose exec app php artisan migrate --force

# Caching for performance
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

## 6. Maintenance and Updates
Whenever code changes, repeat setup Steps 4 and cache clearing:
```bash
git pull origin main
docker-compose exec app composer install --optimize-autoloader --no-dev
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan config:cache
```
