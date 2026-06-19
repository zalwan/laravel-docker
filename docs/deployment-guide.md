# Deployment Guide

## Production Checklist

1. Configure production environment variables.
2. Build PHP dependencies with production flags.
3. Build frontend assets.
4. Run database migrations.
5. Create or rotate the production admin user.
6. Link public storage for gallery uploads.
7. Run tests and dependency audit.
8. Configure queue/cache/session drivers as needed.
9. Put the application behind HTTPS.

## Environment

Required production values:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.example

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your-db-name
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
FILESYSTEM_DISK=public
```

Generate a strong application key if one is not already set:

```bash
php artisan key:generate --force
```

## Build Commands

Install PHP dependencies:

```bash
composer install --no-dev --prefer-dist --optimize-autoloader
```

Install and build frontend assets:

```bash
npm ci
npm run build
```

If the project intentionally has no `package-lock.json`, use:

```bash
npm install --no-package-lock
npm run build
```

## Database

Run migrations:

```bash
php artisan migrate --force
```

Seed initial data only when needed:

```bash
php artisan db:seed --force
```

The default admin seed creates:

```text
admin@example.com / admin
```

Change this account immediately in production or replace it with a production-only user creation process.

## Storage

Gallery uploads use the `public` disk. Ensure the storage symlink exists:

```bash
php artisan storage:link
```

The web server must serve `public/storage`.

## Optimization

Run Laravel optimization commands after deployment:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

When deploying a new release, clear and rebuild caches if environment variables, routes, or views change.

## Verification

Run:

```bash
php artisan test
composer audit --no-dev
```

Smoke check these URLs:

- `/`
- `/about`
- `/services`
- `/contents`
- `/contact`
- `/login`
- `/admin`
- `/admin/reports/project-summary.pdf`

## Docker Deployment Notes

The included Docker setup is suitable for local development. For production, prefer:

- a production-grade image build that does not bind mount the project directory,
- immutable dependencies inside the image,
- secrets injected by the deployment platform,
- persistent database and storage volumes,
- HTTPS termination at a reverse proxy or load balancer.
