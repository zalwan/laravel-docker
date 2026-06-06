# Configuration Guide

## Environment Variables (.env)

The `.env` file is located in the root of the project. Important variables include:

### Application Settings
- **`APP_NAME`**: The name of the application.
- **`APP_ENV`**: `local` (development) or `production` (production).
- **`APP_KEY`**: A base64 string used for encryption. Auto-generated via `php artisan key:generate`.
- **`APP_DEBUG`**: Set to `true` to view detailed error messages during development. Ensure it is `false` in production.
- **`APP_URL`**: Base URL of the application.

### Database Settings
- **`DB_CONNECTION`**: Usually `mysql`.
- **`DB_HOST`**: Container name (`db`).
- **`DB_PORT`**: Default `3306`.
- **`DB_DATABASE`**: Configure as necessary (default `laravel`).
- **`DB_USERNAME`**: Default `laravel`.
- **`DB_PASSWORD`**: Set your chosen secure password (default `secret`).

### Default Admin Account
- **`ADMIN_NAME`**: Name used by `UserSeeder` for the local admin account.
- **`ADMIN_EMAIL`**: Email used by `UserSeeder` for admin login.
- **`ADMIN_PASSWORD`**: Password used by `UserSeeder`. Use a strong value outside local development.

After changing these values, run:

```bash
docker compose exec app php artisan db:seed --class=UserSeeder
```

## Docker Setup
The configuration for Docker containers is primarily in `docker-compose.yml`. Wait for all services to start before accessing the site at `http://localhost:8000`.

Adjust container configuration in:
- `docker-compose.yml` (ports, volumes, network)
- `docker/nginx/default.conf` (Nginx server settings)
- `Dockerfile` (PHP application container)
