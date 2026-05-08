# Laravel 12 + Docker Project

A complete Laravel 12 application setup with Docker containerization, MySQL database, Redis cache, and Nginx web server.

## 📚 Documentation

- **[LARAVEL_GUIDE.md](LARAVEL_GUIDE.md)** - Complete Laravel development guide with examples
- **[LARAVEL_COMMANDS.md](LARAVEL_COMMANDS.md)** - Complete Laravel Artisan commands reference
- **[QUICK_REFERENCE.md](QUICK_REFERENCE.md)** - Quick reference for common tasks
- **[API.md](API.md)** - API endpoints documentation
- **[CONFIGURATION.md](CONFIGURATION.md)** - Configuration guide
- **[DEPLOYMENT.md](DEPLOYMENT.md)** - Deployment instructions

## Project Structure

```
laravel/
├── app/                    # Application code
│   └── Http/Controllers/   # Controllers
├── config/                 # Configuration files
├── database/               # Migrations and seeders
├── routes/                 # API and web routes
├── resources/views/        # Blade templates
├── public/                 # Public assets
├── storage/                # File storage
├── docker/                 # Docker configuration
│   └── nginx/
│       └── default.conf    # Nginx configuration
├── Dockerfile              # PHP-FPM container
├── docker-compose.yml      # Docker services definition
├── .env                    # Environment variables
├── .env.example            # Example environment file
├── composer.json           # PHP dependencies
└── README.md              # This file
```

## Services

### Web Application (PHP-FPM)
- **Image**: php:8.2-fpm
- **Port**: Internal (9000)
- **Volumes**: Application files mounted at `/var/www`

### Web Server (Nginx)
- **Image**: nginx:alpine
- **Port**: 8000 (accessible at http://localhost:8000)
- **Configuration**: `docker/nginx/default.conf`

### Database (MySQL)
- **Image**: mysql:8.0
- **Port**: 3306
- **Database**: laravel
- **User**: laravel
- **Password**: secret (configurable via .env)

### Cache (Redis)
- **Image**: redis:7-alpine
- **Port**: 6379

## Quick Start

### Prerequisites
- Docker
- Docker Compose

### Setup Instructions

1. **Clone or extract the project**
   ```bash
   cd /home/suryawan/projects/laravel
   ```

2. **Start the Docker containers**
   ```bash
   docker-compose up -d
   ```

3. **Install PHP dependencies** (if not already installed by Docker)
   ```bash
   docker-compose exec app composer install
   ```

4. **Generate application key**
   ```bash
   docker-compose exec app php artisan key:generate
   ```

5. **Run database migrations** (if migrations exist)
   ```bash
   docker-compose exec app php artisan migrate
   ```

6. **Access the application**
   - Open your browser to: **http://localhost:8000**
   - API Health Check: **http://localhost:8000/api/health**

## Common Commands

### Docker Commands

```bash
# Start all services
docker-compose up -d

# Stop all services
docker-compose down

# View logs
docker-compose logs -f [service-name]

# View logs for all services
docker-compose logs -f

# Rebuild containers
docker-compose up -d --build

# Access application container
docker-compose exec app bash

# Access database container
docker-compose exec db mysql -u laravel -p
```

### Laravel Artisan Commands

```bash
# Access artisan inside the container
docker-compose exec app php artisan [command]

# Generate model with migration
docker-compose exec app php artisan make:model Post -m

# Generate controller
docker-compose exec app php artisan make:controller PostController

# Run migrations
docker-compose exec app php artisan migrate

# Rollback migrations
docker-compose exec app php artisan migrate:rollback

# Seed database
docker-compose exec app php artisan db:seed

# Clear cache
docker-compose exec app php artisan cache:clear

# Create new user via tinker
docker-compose exec app php artisan tinker
```

### Database Access

```bash
# Access MySQL from host (if needed)
mysql -h 127.0.0.1 -P 3306 -u laravel -p

# Inside container
docker-compose exec db mysql -u laravel -p
```

## Environment Configuration

Edit `.env` file to customize:

- **APP_NAME**: Application name
- **APP_ENV**: Environment (local/production)
- **APP_DEBUG**: Debug mode (true/false)
- **DB_DATABASE**: Database name
- **DB_USERNAME**: Database user
- **DB_PASSWORD**: Database password
- **REDIS_HOST**: Redis hostname (redis in Docker)

## Volumes

The project uses Docker volumes for data persistence:

- **dbdata**: MySQL database data
- **redisdata**: Redis data

## Network

All services communicate through a custom bridge network named `laravel`.

## Ports

| Service | Port | Access |
|---------|------|--------|
| Nginx   | 8000 | http://localhost:8000 |
| MySQL   | 3306 | localhost:3306 |
| Redis   | 6379 | localhost:6379 |

## Troubleshooting

### Port already in use
```bash
# Change port in docker-compose.yml
ports:
  - "8001:80"  # Change 8000 to 8001
```

### Permission denied errors
```bash
# Fix permissions
docker-compose exec app chown -R www-data:www-data /var/www/storage
docker-compose exec app chmod -R 775 /var/www/storage
```

### Database connection error
```bash
# Ensure db container is running
docker-compose up -d db

# Check database credentials in .env
docker-compose logs db
```

### Clear application cache
```bash
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan cache:clear
```

## Routes

The application includes sample routes:

- `GET  /` - Home page
- `GET  /about` - About page
- `GET  /contact` - Contact page
- `GET  /api/health` - API health endpoint
- `GET  /api/user` - Get current user (requires auth)

## 🚀 Getting Started with Development

### Create Your First Route

**1. Simple Closure Route**

```php
// routes/web.php
Route::get('/hello', function () {
    return 'Hello, World!';
});
```

Test: `curl http://localhost:8000/hello`

**2. Route with View**

```php
// routes/web.php
Route::get('/welcome', function () {
    return view('welcome', ['name' => 'Developer']);
});
```

Create view: `resources/views/welcome.blade.php`

```blade
<h1>Welcome, {{ $name }}!</h1>
```

Test: http://localhost:8000/welcome

### Create a Full CRUD Feature

**1. Create Model with Migration**

```bash
docker compose exec app php artisan make:model Post -m
```

**2. Define Migration**

```php
// database/migrations/...
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('content');
    $table->string('author');
    $table->timestamps();
});
```

**3. Create Controller with Resource Methods**

```bash
docker compose exec app php artisan make:controller PostController --resource
```

**4. Define Routes**

```php
// routes/web.php
Route::resource('posts', PostController::class);
```

This creates:
- `/posts` (GET) - List all posts
- `/posts/create` (GET) - Show create form
- `/posts` (POST) - Store new post
- `/posts/{id}` (GET) - Show single post
- `/posts/{id}/edit` (GET) - Show edit form
- `/posts/{id}` (PUT) - Update post
- `/posts/{id}` (DELETE) - Delete post

**5. Implement Controller**

```php
// app/Http/Controllers/PostController.php
public function index()
{
    $posts = Post::all();
    return view('posts.index', compact('posts'));
}

public function store(Request $request)
{
    Post::create($request->validate([
        'title' => 'required|string',
        'content' => 'required|string',
        'author' => 'required|string',
    ]));
    return redirect('/posts')->with('success', 'Post created!');
}
```

**6. Run Migrations**

```bash
docker compose exec app php artisan migrate
```

**7. Access at**

- http://localhost:8000/posts - List
- http://localhost:8000/posts/create - Create form

### Common Development Commands

```bash
# Create resources
docker compose exec app php artisan make:model ModelName -m
docker compose exec app php artisan make:controller ControllerName
docker compose exec app php artisan make:request StoreName

# Database
docker compose exec app php artisan migrate
docker compose exec app php artisan tinker

# Clear cache
docker compose exec app php artisan cache:clear
docker compose exec app php artisan view:clear
docker compose exec app php artisan route:clear

# Optimize
docker compose exec app php artisan optimize
```

**📖 For complete examples and detailed documentation, see:**
- **[LARAVEL_GUIDE.md](LARAVEL_GUIDE.md)** - Complete development guide with examples
- **[QUICK_REFERENCE.md](QUICK_REFERENCE.md)** - Quick reference for common tasks

## Development Workflow

1. Make code changes in your editor
2. Files are synced via Docker volumes
3. View changes immediately in browser (refresh page)
4. Use artisan commands via `docker compose exec app php artisan [command]`
5. Check logs: `docker compose logs -f app`

## Production Deployment

When deploying to production:

1. Set `APP_DEBUG=false` in `.env`
2. Set `APP_ENV=production`
3. Generate a proper `APP_KEY`
4. Use strong database passwords
5. Configure environment-specific settings
6. Use Docker registry for images
7. Set up proper backup strategy for volumes
