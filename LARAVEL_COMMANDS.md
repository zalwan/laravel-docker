# Laravel Commands Documentation

Complete reference for all major Laravel Artisan commands used in development, testing, and deployment.

**Note**: All commands use the Docker container format. Replace `docker compose exec app` with just `php` if running locally without Docker.

## Table of Contents

- [Database Commands](#database-commands)
- [Model & Migration Commands](#model--migration-commands)
- [Controller Commands](#controller-commands)
- [Route Commands](#route-commands)
- [Request & Validation Commands](#request--validation-commands)
- [Service Provider Commands](#service-provider-commands)
- [Cache Commands](#cache-commands)
- [Queue Commands](#queue-commands)
- [View & Asset Commands](#view--asset-commands)
- [Testing Commands](#testing-commands)
- [Optimization Commands](#optimization-commands)
- [Utility Commands](#utility-commands)
- [Development Commands](#development-commands)

---

## Database Commands

### Run Migrations
```bash
# Run all pending migrations
docker compose exec app php artisan migrate

# Run migrations in specific environment
docker compose exec app php artisan migrate --env=production

# Run migrations with seed
docker compose exec app php artisan migrate --seed

# Run migrations for specific database
docker compose exec app php artisan migrate --database=mysql
```

### Rollback Migrations
```bash
# Rollback last batch
docker compose exec app php artisan migrate:rollback

# Rollback all migrations
docker compose exec app php artisan migrate:reset

# Rollback and re-run all migrations
docker compose exec app php artisan migrate:refresh

# Rollback and re-run with seed
docker compose exec app php artisan migrate:refresh --seed

# Rollback n steps
docker compose exec app php artisan migrate:rollback --step=1
```

### Check Migrations
```bash
# Show migration status
docker compose exec app php artisan migrate:status

# Show pending migrations
docker compose exec app php artisan migrate:status | grep Pending
```

### Seed Database
```bash
# Run database seeders
docker compose exec app php artisan db:seed

# Run specific seeder
docker compose exec app php artisan db:seed --class=UserSeeder

# Run seeders with migration refresh
docker compose exec app php artisan migrate:refresh --seed
```

### Database Table Commands
```bash
# Show database tables
docker compose exec app php artisan db

# Drop all tables (with confirmation)
docker compose exec app php artisan db:wipe

# Drop all tables and re-run migrations
docker compose exec app php artisan migrate:fresh

# Drop all tables, re-run migrations, and seed
docker compose exec app php artisan migrate:fresh --seed
```

---

## Model & Migration Commands

### Create Model
```bash
# Create basic model
docker compose exec app php artisan make:model User

# Create model with migration
docker compose exec app php artisan make:model Post -m

# Create model with migration and controller
docker compose exec app php artisan make:model Post -mc

# Create model with all scaffolding (migration, controller, factory, seeder)
docker compose exec app php artisan make:model Post -a

# Create model as resource controller
docker compose exec app php artisan make:model Post -mr

# Create model with controller and resource
docker compose exec app php artisan make:model Post -mcr
```

### Create Migration
```bash
# Create new migration
docker compose exec app php artisan make:migration create_posts_table

# Create migration for model table
docker compose exec app php artisan make:migration create_posts_table --create=posts

# Create migration for table changes
docker compose exec app php artisan make:migration add_status_to_posts_table --table=posts

# Create migration with custom path
docker compose exec app php artisan make:migration create_posts_table --path=database/migrations/custom
```

### Create Factory
```bash
# Create model factory
docker compose exec app php artisan make:factory PostFactory

# Create factory for specific model
docker compose exec app php artisan make:factory PostFactory --model=Post
```

### Create Seeder
```bash
# Create database seeder
docker compose exec app php artisan make:seeder UserSeeder

# Create seeder for specific model
docker compose exec app php artisan make:seeder PostSeeder
```

### Tinker (Interactive Shell)
```bash
# Start tinker shell
docker compose exec app php artisan tinker

# Example commands in tinker
# Create a record: User::create(['name' => 'John', 'email' => 'john@example.com'])
# Query records: User::all()
# Update record: User::find(1)->update(['name' => 'Jane'])
# Delete record: User::find(1)->delete()
```

---

## Controller Commands

### Create Controller
```bash
# Create basic controller
docker compose exec app php artisan make:controller PostController

# Create resource controller (with CRUD methods)
docker compose exec app php artisan make:controller PostController --resource

# Create API resource controller (index, show, store, update, destroy)
docker compose exec app php artisan make:controller PostController --api

# Create controller with model
docker compose exec app php artisan make:controller PostController --model=Post

# Create model controller (model + controller)
docker compose exec app php artisan make:controller PostController --model=Post --resource

# Create invokable controller (single action)
docker compose exec app php artisan make:controller InvoiceController --invokable
```

### Controller Locations
```
app/Http/Controllers/          # Standard controllers
app/Http/Controllers/Api/      # API controllers
app/Http/Controllers/Admin/    # Admin controllers
```

---

## Route Commands

### List Routes
```bash
# Show all registered routes
docker compose exec app php artisan route:list

# Show routes as table
docker compose exec app php artisan route:list --method=GET

# Show routes for specific HTTP method
docker compose exec app php artisan route:list --method=POST

# Show routes with middleware
docker compose exec app php artisan route:list --except-vendor

# Export routes to JSON
docker compose exec app php artisan route:list --json

# Show only API routes
docker compose exec app php artisan route:list --path=api
```

### Cache Routes
```bash
# Cache routes for performance
docker compose exec app php artisan route:cache

# Clear route cache
docker compose exec app php artisan route:clear

# Check if routes are cached
docker compose exec app php artisan optimize:list | grep route
```

---

## Request & Validation Commands

### Create Request Class
```bash
# Create form request for validation
docker compose exec app php artisan make:request StorePostRequest

# Create request in nested directory
docker compose exec app php artisan make:request Posts/StorePostRequest

# Create request for specific model
docker compose exec app php artisan make:request StoreUserRequest
```

### Request Usage
```php
// app/Http/Requests/StorePostRequest.php
public function rules()
{
    return [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ];
}
```

---

## Service Provider Commands

### Create Service Provider
```bash
# Create service provider
docker compose exec app php artisan make:provider MyServiceProvider

# Create event service provider
docker compose exec app php artisan make:provider EventServiceProvider
```

### Register Service Provider
```php
// config/app.php - Add to 'providers' array
'providers' => [
    App\Providers\AppServiceProvider::class,
],
```

---

## Cache Commands

### Cache Operations
```bash
# Clear all cache
docker compose exec app php artisan cache:clear

# Clear specific cache tag
docker compose exec app php artisan cache:clear --tags=users

# Forget specific cache key
docker compose exec app php artisan cache:forget cache_key_name

# Clear route cache
docker compose exec app php artisan route:clear

# Clear config cache
docker compose exec app php artisan config:clear

# Clear view cache
docker compose exec app php artisan view:clear

# Clear all caches and optimizations
docker compose exec app php artisan optimize:clear

# Clear compiled view cache
docker compose exec app php artisan view:clear

# Clear application cache
docker compose exec app php artisan app:cache
```

### Cache Table
```bash
# Create database cache table
docker compose exec app php artisan cache:table

# Run migration for cache table
docker compose exec app php artisan migrate
```

---

## Queue Commands

### Queue Configuration
```bash
# Create jobs table for database queue
docker compose exec app php artisan queue:table

# Create batch table for batch processing
docker compose exec app php artisan queue:batches-table

# Create failed jobs table
docker compose exec app php artisan queue:failed-table

# Run migrations for queue tables
docker compose exec app php artisan migrate
```

### Process Queue
```bash
# Start queue worker
docker compose exec app php artisan queue:work

# Start queue worker for specific queue
docker compose exec app php artisan queue:work --queue=default

# Start queue worker with multiple options
docker compose exec app php artisan queue:work --tries=3 --timeout=180

# Restart queue workers
docker compose exec app php artisan queue:restart

# Check job status
docker compose exec app php artisan queue:failed
```

### Create Jobs
```bash
# Create queued job
docker compose exec app php artisan make:job ProcessImage

# Create synchronous job
docker compose exec app php artisan make:job ProcessImage --sync
```

---

## View & Asset Commands

### View Caching
```bash
# Clear compiled views
docker compose exec app php artisan view:clear

# Cache views
docker compose exec app php artisan view:cache

# Show compiled view paths
docker compose exec app php artisan view:list
```

### Asset Publishing
```bash
# Publish vendor assets
docker compose exec app php artisan vendor:publish

# Publish specific vendor package
docker compose exec app php artisan vendor:publish --provider="Vendor\Package\ServiceProvider"

# Publish only assets
docker compose exec app php artisan vendor:publish --tag=public
```

---

## Testing Commands

### Run Tests
```bash
# Run all tests
docker compose exec app php artisan test

# Run specific test file
docker compose exec app php artisan test tests/Feature/UserTest.php

# Run specific test method
docker compose exec app php artisan test tests/Feature/UserTest.php --filter=testCreateUser

# Run tests with coverage
docker compose exec app php artisan test --coverage

# Run tests in parallel
docker compose exec app php artisan test --parallel

# Run unit tests only
docker compose exec app php artisan test tests/Unit

# Run feature tests only
docker compose exec app php artisan test tests/Feature
```

### Create Tests
```bash
# Create feature test
docker compose exec app php artisan make:test UserTest

# Create unit test
docker compose exec app php artisan make:test UserTest --unit

# Create test for specific model
docker compose exec app php artisan make:test UserTest --model=User
```

### PHPUnit Direct (Alternative)
```bash
# Run tests with PHPUnit
docker compose exec app php vendor/bin/phpunit

# Run with coverage
docker compose exec app php vendor/bin/phpunit --coverage-html coverage
```

---

## Optimization Commands

### Optimize Application
```bash
# Optimize application
docker compose exec app php artisan optimize

# Clear optimization cache
docker compose exec app php artisan optimize:clear

# Show optimization status
docker compose exec app php artisan optimize:list

# Cache configuration
docker compose exec app php artisan config:cache

# Cache routes
docker compose exec app php artisan route:cache

# Cache all optimizations
docker compose exec app php artisan cache:clear && docker compose exec app php artisan config:cache && docker compose exec app php artisan route:cache
```

---

## Utility Commands

### Configuration
```bash
# Publish configuration
docker compose exec app php artisan vendor:publish --tag=config

# Show configuration
docker compose exec app php artisan config:show

# Cache configuration
docker compose exec app php artisan config:cache

# Clear configuration cache
docker compose exec app php artisan config:clear

# Validate configuration
docker compose exec app php artisan config:validate
```

### Environment
```bash
# Set environment variable
docker compose exec app php artisan env:set APP_DEBUG true

# Show current environment
docker compose exec app php artisan about

# Show application details
docker compose exec app php artisan about --only=environment
```

### Information
```bash
# Show Laravel version
docker compose exec app php artisan --version

# Show environment info
docker compose exec app php artisan about

# Show all available commands
docker compose exec app php artisan list

# Show command help
docker compose exec app php artisan help migrate

# Show specific command help
docker compose exec app php artisan make:model --help
```

### Storage
```bash
# Create storage symlink
docker compose exec app php artisan storage:link

# Remove storage symlink
docker compose exec app php artisan storage:unlink

# Create missing storage directories
docker compose exec app php artisan storage:make-public-symlink
```

---

## Development Commands

### Development Server
```bash
# Start development server (local only)
php artisan serve

# Start on custom host and port
php artisan serve --host=0.0.0.0 --port=8001

# Access through Docker
docker compose exec app php artisan serve --host=0.0.0.0 --port=8000
```

### Code Style & Formatting
```bash
# Fix code style issues
docker compose exec app php artisan pint

# Check code style without fixing
docker compose exec app php artisan pint --test

# Fix specific file
docker compose exec app php artisan pint app/Http/Controllers/UserController.php
```

### Database Inspection
```bash
# Connect to database terminal (MySQL)
docker compose exec mysql mysql -u root -p -D laravel

# Show database tables
docker compose exec mysql mysql -u root -p -D laravel -e "SHOW TABLES;"

# Show table structure
docker compose exec mysql mysql -u root -p -D laravel -e "DESCRIBE table_name;"
```

### Tinker Commands
```bash
# Start interactive shell
docker compose exec app php artisan tinker

# Example Tinker commands:
# Get user: $user = User::find(1)
# Create: User::create(['name' => 'John', 'email' => 'john@example.com'])
# Update: $user->update(['name' => 'Jane'])
# Delete: $user->delete()
# Count: User::count()
# Query: User::where('role', 'admin')->get()
# Paginate: User::paginate(15)
# First: User::where('email', 'john@example.com')->first()
```

---

## Installation & Composer Commands

### Composer
```bash
# Install dependencies
docker compose exec app composer install

# Update dependencies
docker compose exec app composer update

# Require new package
docker compose exec app composer require vendor/package

# Require dev dependency
docker compose exec app composer require --dev vendor/package

# Remove package
docker compose exec app composer remove vendor/package

# Dump autoloader
docker compose exec app composer dump-autoload

# Check for security vulnerabilities
docker compose exec app composer audit
```

### Key Packages
```bash
# Install Laravel Sanctum (API authentication)
docker compose exec app composer require laravel/sanctum

# Install Laravel Passport (OAuth2)
docker compose exec app composer require laravel/passport

# Install Laravel Horizon (Queue monitoring)
docker compose exec app composer require laravel/horizon

# Install Laravel Telescope (Debugging)
docker compose exec app composer require laravel/telescope --dev

# Install Laravel Tinker (REPL)
docker compose exec app composer require laravel/tinker
```

---

## Common Workflow Examples

### Complete Development Setup
```bash
# 1. Start containers
docker compose up -d

# 2. Install dependencies
docker compose exec app composer install

# 3. Generate app key
docker compose exec app php artisan key:generate

# 4. Run migrations
docker compose exec app php artisan migrate

# 5. Seed database
docker compose exec app php artisan db:seed

# 6. Create storage link
docker compose exec app php artisan storage:link

# 7. Cache optimization (optional)
docker compose exec app php artisan optimize
```

### Create New Feature
```bash
# 1. Create Model with all scaffolding
docker compose exec app php artisan make:model Post -a

# 2. Edit migration file
# Edit database/migrations/xxxx_create_posts_table.php

# 3. Run migration
docker compose exec app php artisan migrate

# 4. Edit model
# Edit app/Models/Post.php - add fillable, relationships, etc.

# 5. Add routes
# Edit routes/web.php or routes/api.php

# 6. Create tests
docker compose exec app php artisan make:test PostTest

# 7. Run tests
docker compose exec app php artisan test
```

### Production Deployment
```bash
# 1. Pull latest code
git pull origin main

# 2. Install dependencies
docker compose exec app composer install --optimize-autoloader --no-dev

# 3. Cache configuration
docker compose exec app php artisan config:cache

# 4. Cache routes
docker compose exec app php artisan route:cache

# 5. Run migrations
docker compose exec app php artisan migrate --force

# 6. Clear caches
docker compose exec app php artisan cache:clear

# 7. Optimize
docker compose exec app php artisan optimize
```

---

## Troubleshooting Commands

### Debug & Fix Issues
```bash
# Clear all caches
docker compose exec app php artisan optimize:clear

# Regenerate app key
docker compose exec app php artisan key:generate

# Fix file permissions
docker compose exec app chmod -R 775 storage bootstrap/cache

# Check Laravel installation
docker compose exec app php artisan about

# Show environment details
docker compose exec app php artisan env:show

# Validate configuration
docker compose exec app php artisan config:validate

# Check database connection
docker compose exec app php artisan db
```

### View Docker Logs
```bash
# View application logs
docker compose logs -f app

# View last 100 lines
docker compose logs --tail=100 app

# View specific service logs
docker compose logs -f nginx

# View all service logs
docker compose logs -f

# Clear logs
docker compose logs --clear
```

---

## Tips & Best Practices

1. **Development**: Use `php artisan serve` for local development
2. **Caching**: Always cache routes and config in production
3. **Migrations**: Always version control migrations
4. **Testing**: Write tests for critical features
5. **Git**: Commit `.env.example` but not `.env`
6. **Dependencies**: Regularly update with `composer update`
7. **Security**: Run `composer audit` to check vulnerabilities
8. **Performance**: Use queue for long-running tasks
9. **Storage**: Always create storage link in production
10. **Monitoring**: Use Laravel Horizon for queue monitoring

---

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Artisan Console](https://laravel.com/docs/artisan)
- [Laravel Database](https://laravel.com/docs/database)
- [Laravel Migrations](https://laravel.com/docs/migrations)
- [Laravel Eloquent ORM](https://laravel.com/docs/eloquent)
