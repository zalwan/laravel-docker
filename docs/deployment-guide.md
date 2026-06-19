# Deployment Guide

This project can run in two deployment styles:

- **Docker/local development:** PHP-FPM, Nginx, MySQL, Redis.
- **Vercel demo:** serverless PHP runtime with a seeded SQLite template.

The Vercel deployment is already configured for demo use at:

```text
https://laravel-docker.vercel.app
```

## Production Checklist

1. Set `APP_ENV=production` and `APP_DEBUG=false`.
2. Generate and configure a strong `APP_KEY`.
3. Build frontend assets.
4. Install Composer dependencies without dev packages.
5. Run migrations on the target database.
6. Seed only the data needed for the environment.
7. Replace the default admin password.
8. Configure durable database and storage.
9. Force HTTPS at the platform or proxy layer.
10. Run tests and smoke checks.

## Local Docker Deployment

Start:

```bash
docker compose up -d --build
```

Reset database and seed:

```bash
docker compose exec app php artisan migrate:fresh --seed
```

Run tests:

```bash
docker compose exec app php artisan test
```

Local URLs:

```text
Public: http://localhost:8080
Admin:  http://localhost:8080/admin
Login:  http://localhost:8080/login
```

Seeded admin:

```text
admin@example.com / admin
```

## Vercel Demo Deployment

The Vercel setup uses:

- `api/index.php` as the Laravel serverless entrypoint.
- `vercel-php@0.9.0` as the PHP runtime.
- `database/vercel.sqlite` as a seeded SQLite template.
- `/tmp/database.sqlite` as runtime database storage.
- `SESSION_DRIVER=cookie`, `CACHE_STORE=array`, and `QUEUE_CONNECTION=sync`.
- Uploaded gallery images are stored in the `gallery_items` table for this demo, then served through `/gallery-items/{galleryItem}/image`.

Important limitation: `/tmp` is ephemeral. Data changed through admin CRUD, including uploaded gallery images stored in SQLite, may reset after cold starts or new deployments.

### Required Files

```text
api/index.php
vercel.json
.vercelignore
.env.vercel.example
database/vercel.sqlite
```

### Generate Vercel SQLite Template

When seed data changes, regenerate the SQLite template:

```bash
docker compose exec -T \
  -e DB_CONNECTION=sqlite \
  -e DB_DATABASE=/var/www/html/database/vercel.sqlite \
  app sh -lc 'rm -f database/vercel.sqlite && touch database/vercel.sqlite && php artisan migrate:fresh --seed --force'
```

Commit `database/vercel.sqlite` with the deployment config when the demo seed should be updated.

### Environment Variables

Set `APP_KEY` in Vercel:

```bash
docker compose exec app php artisan key:generate --show
printf '%s\n' 'base64:YOUR_GENERATED_KEY' | npx vercel env add APP_KEY preview
printf '%s\n' 'base64:YOUR_GENERATED_KEY' | npx vercel env add APP_KEY production
```

`vercel.json` already provides safe demo defaults:

```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=sqlite
DB_DATABASE=/tmp/database.sqlite
CACHE_STORE=array
SESSION_DRIVER=cookie
QUEUE_CONNECTION=sync
LOG_CHANNEL=stderr
```

### Deploy Commands

Login:

```bash
npx vercel login
```

Preview deploy:

```bash
npx vercel --yes
```

Production deploy:

```bash
npx vercel --prod --yes
```

Inspect deployment:

```bash
npx vercel inspect https://laravel-docker.vercel.app
```

Read logs:

```bash
npx vercel logs https://laravel-docker.vercel.app --since 30m --expand
```

## Managed Database Production Setup

For production persistence, replace SQLite demo mode with a managed database such as MySQL or Postgres.

Recommended env values:

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

Run migrations against the managed database:

```bash
php artisan migrate --force
php artisan db:seed --force
```

For Vercel with a managed database, remove or override these demo SQLite values:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/tmp/database.sqlite
```

## Storage

Local Docker can serve Laravel's `public` disk for legacy gallery paths.

```bash
docker compose exec app php artisan storage:link
```

New gallery uploads are stored in the database so they render consistently in Docker and the Vercel demo. This is acceptable for small demo uploads, but it is not ideal for production image storage.

Vercel serverless filesystem is not persistent. For production gallery uploads, prefer external object storage such as S3-compatible storage and configure `FILESYSTEM_DISK` accordingly.

The seeded Vercel gallery uses committed public assets under:

```text
public/images/projects
```

## Build Commands

PHP dependencies:

```bash
composer install --no-dev --prefer-dist --optimize-autoloader
```

Frontend assets:

```bash
npm ci
npm run build
```

If there is no lockfile:

```bash
npm install --no-package-lock
npm run build
```

## Optimization

Typical Laravel production commands:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

On Vercel, cache file paths are redirected to `/tmp` through `vercel.json`.

## Smoke Checks

Check these public URLs:

```text
/
/profile
/products
/articles
/gallery
/contact
/contents
/login
/admin
```

Expected:

```text
/admin -> 302 redirect to /login when unauthenticated
/login -> 200
/gallery -> images resolve from public assets
```

Check admin manually with:

```text
admin@example.com / admin
```

## Current Verified Result

Latest local verification:

```text
docker compose exec app php artisan test
35 passed
```

Latest production smoke result:

```text
https://laravel-docker.vercel.app/        200
https://laravel-docker.vercel.app/contact 200
https://laravel-docker.vercel.app/gallery 200
https://laravel-docker.vercel.app/login   200
https://laravel-docker.vercel.app/admin   302 -> /login
```
