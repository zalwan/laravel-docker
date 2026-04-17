# 🚀 Laravel Development Guide

Complete guide for developing with this Laravel + Docker project.

---

## Table of Contents

1. [Project Overview](#project-overview)
2. [Getting Started](#getting-started)
3. [Routes & Controllers](#routes--controllers)
4. [Models & Database](#models--database)
5. [Views & Blade Templates](#views--blade-templates)
6. [Artisan Commands](#artisan-commands)
7. [Common Workflows](#common-workflows)
8. [Troubleshooting](#troubleshooting)
9. [Deployment](#deployment)

---

## Project Overview

### Architecture

This is a **Laravel 11** application running on Docker with the following services:

```
┌─────────────────────────────────────────────────────────┐
│                    Docker Environment                    │
├─────────────────────────────────────────────────────────┤
│                                                           │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────┐ │
│  │  Nginx   │  │   PHP    │  │  MySQL   │  │  Redis   │ │
│  │ Alpine   │  │  8.2 FPM │  │   8.0    │  │   7.0    │ │
│  │ :8000    │  │  :9000   │  │  :3306   │  │  :6379   │ │
│  └──────────┘  └──────────┘  └──────────┘  └──────────┘ │
│                                                           │
└─────────────────────────────────────────────────────────┘
```

### Directory Structure

```
laravel/
├── app/                          # Application code
│   └── Http/
│       └── Controllers/          # Your controllers
├── routes/
│   ├── web.php                  # Web routes
│   ├── api.php                  # API routes
│   └── console.php              # Console commands
├── resources/
│   └── views/                   # Blade templates
│       ├── home.blade.php
│       ├── about.blade.php
│       └── contact.blade.php
├── database/
│   ├── migrations/              # Database migrations
│   └── seeders/                 # Database seeders
├── config/                       # Configuration files
├── storage/                      # File storage & logs
│   ├── logs/laravel.log         # Application logs
│   └── app/                     # File uploads
├── bootstrap/
│   └── cache/                   # Application cache
├── public/
│   └── index.php                # Entry point
├── docker/
│   └── nginx/
│       └── default.conf         # Nginx configuration
├── Dockerfile                    # PHP-FPM container
├── docker-compose.yml           # Services configuration
├── composer.json                # PHP dependencies
└── .env                         # Environment variables
```

---

## Getting Started

### Prerequisites

- Docker installed
- Docker Compose installed
- Terminal/Shell access

### Start the Project

```bash
cd /home/suryawan/projects/laravel

# Start all services
docker compose up -d

# Check if all containers are running
docker ps
```

### Access the Application

- **Home:** http://localhost:8000
- **About:** http://localhost:8000/about
- **Contact:** http://localhost:8000/contact
- **API Health:** http://localhost:8000/api/health

### Stop the Project

```bash
docker compose down
```

---

## Routes & Controllers

### Understanding Routes

Routes are defined in `routes/web.php` for web requests and `routes/api.php` for API requests.

### Current Routes

```php
// routes/web.php

// Home page - shows welcome message
GET  /              → displays home.blade.php

// About page - shows tech stack
GET  /about         → displays about.blade.php

// Contact page - shows contact form
GET  /contact       → displays contact.blade.php

// Protected dashboard (requires authentication)
GET  /dashboard     → displays dashboard (middleware: auth)
```

### Creating a New Route

#### Example 1: Simple Route with Closure

```php
// routes/web.php

Route::get('/hello', function () {
    return 'Hello, World!';
});
```

Test it:
```bash
curl http://localhost:8000/hello
```

#### Example 2: Route to a View

```php
// routes/web.php

Route::get('/services', function () {
    return view('services', [
        'title' => 'Our Services',
        'services' => ['Web Development', 'Mobile Apps', 'Cloud Solutions']
    ]);
});
```

#### Example 3: Route with Parameters

```php
// routes/web.php

Route::get('/users/{id}', function ($id) {
    return "User ID: " . $id;
});

// Or with regex validation
Route::get('/posts/{id}', function ($id) {
    return "Post ID: " . $id;
})->where('id', '[0-9]+');
```

Test it:
```bash
curl http://localhost:8000/users/123
curl http://localhost:8000/posts/456
```

#### Example 4: Route Group with Prefix

```php
// routes/web.php

Route::prefix('/admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    
    Route::get('/users', function () {
        return view('admin.users');
    });
});
```

Access it:
- http://localhost:8000/admin/dashboard
- http://localhost:8000/admin/users

### Using Controllers

Controllers organize related routes and logic.

#### Create a Controller

```bash
docker compose exec app php artisan make:controller ProductController
```

This creates: `app/Http/Controllers/ProductController.php`

#### Define Routes with Controller

```php
// routes/web.php

use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
```

#### Implement Controller Methods

```php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        $products = [
            ['id' => 1, 'name' => 'Laptop', 'price' => 999],
            ['id' => 2, 'name' => 'Phone', 'price' => 699],
            ['id' => 3, 'name' => 'Tablet', 'price' => 399],
        ];
        
        return view('products.index', ['products' => $products]);
    }
    
    // Show single product
    public function show($id)
    {
        $product = ['id' => $id, 'name' => 'Product Name', 'price' => 99];
        return view('products.show', ['product' => $product]);
    }
    
    // Show create form
    public function create()
    {
        return view('products.create');
    }
    
    // Store new product
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);
        
        // Save to database (when connected)
        // Product::create($validated);
        
        return redirect('/products')->with('success', 'Product created!');
    }
    
    // Update product
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
        
        // Product::find($id)->update($validated);
        
        return redirect('/products/' . $id)->with('success', 'Product updated!');
    }
    
    // Delete product
    public function destroy($id)
    {
        // Product::find($id)->delete();
        
        return redirect('/products')->with('success', 'Product deleted!');
    }
}
```

---

## Models & Database

### Database Configuration

Current `.env` settings:

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

### Access Database

```bash
# Connect to MySQL container
docker compose exec db mysql -u laravel -p
# Password: secret

# Or use Laravel Tinker
docker compose exec app php artisan tinker
```

### Create a Model with Migration

```bash
docker compose exec app php artisan make:model Product -m
```

This creates:
- `app/Models/Product.php` (Model)
- `database/migrations/XXXX_XX_XX_XXXXXX_create_products_table.php` (Migration)

### Define Migration

```php
// database/migrations/XXXX_XX_XX_XXXXXX_create_products_table.php

public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('price', 8, 2);
        $table->text('description')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('products');
}
```

### Run Migrations

```bash
# Run all pending migrations
docker compose exec app php artisan migrate

# Rollback last migration
docker compose exec app php artisan migrate:rollback

# Reset all migrations
docker compose exec app php artisan migrate:reset

# Refresh migrations (reset + run)
docker compose exec app php artisan migrate:refresh
```

### Define Model

```php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description'];
}
```

### Use Model in Controller

```php
// app/Http/Controllers/ProductController.php

use App\Models\Product;

public function index()
{
    $products = Product::all(); // Get all products
    return view('products.index', compact('products'));
}

public function show($id)
{
    $product = Product::findOrFail($id);
    return view('products.show', compact('product'));
}

public function store(Request $request)
{
    Product::create($request->validated());
    return redirect('/products')->with('success', 'Created!');
}

public function update(Request $request, $id)
{
    Product::findOrFail($id)->update($request->validated());
    return redirect('/products')->with('success', 'Updated!');
}

public function destroy($id)
{
    Product::findOrFail($id)->delete();
    return redirect('/products')->with('success', 'Deleted!');
}
```

---

## Views & Blade Templates

### Blade Template Syntax

Blade is Laravel's templating engine.

#### Variables

```blade
<!-- Display a variable -->
{{ $title }}

<!-- Display with escape (HTML safe) -->
{{ htmlspecialchars($content) }}

<!-- Display with fallback -->
{{ $name ?? 'Guest' }}
```

#### Control Structures

```blade
<!-- If statement -->
@if ($user)
    <p>Welcome, {{ $user->name }}!</p>
@elseif ($guest)
    <p>Welcome, Guest!</p>
@else
    <p>Please login</p>
@endif

<!-- Loop -->
@foreach ($products as $product)
    <div>
        <h3>{{ $product->name }}</h3>
        <p>${{ $product->price }}</p>
    </div>
@endforeach

<!-- For loop -->
@for ($i = 0; $i < 5; $i++)
    <p>{{ $i }}</p>
@endfor

<!-- While loop -->
@while ($condition)
    <!-- code -->
@endwhile

<!-- Check if empty -->
@forelse ($items as $item)
    <p>{{ $item }}</p>
@empty
    <p>No items found</p>
@endforelse
```

#### Includes & Components

```blade
<!-- Include another view -->
@include('header')
@include('products.item', ['product' => $product])

<!-- Include if exists -->
@includeIf('optional-view')

<!-- Loop and include -->
@each('products.item', $products, 'product')
```

#### Forms

```blade
<form method="POST" action="/products">
    @csrf <!-- CSRF protection token -->
    
    <input type="text" name="name" value="{{ old('name') }}" required>
    
    @error('name')
        <span class="error">{{ $message }}</span>
    @enderror
    
    <button type="submit">Save</button>
</form>
```

### Create a New View

Create file: `resources/views/products/index.blade.php`

```blade
<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .product { border: 1px solid #ddd; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>Products</h1>
    
    <a href="/products/create">+ Add Product</a>
    
    @forelse ($products as $product)
        <div class="product">
            <h3>{{ $product->name }}</h3>
            <p>Price: ${{ number_format($product->price, 2) }}</p>
            <a href="/products/{{ $product->id }}">View</a>
            <a href="/products/{{ $product->id }}/edit">Edit</a>
            <form method="POST" action="/products/{{ $product->id }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    @empty
        <p>No products found.</p>
    @endforelse
</body>
</html>
```

---

## Artisan Commands

Artisan is Laravel's CLI for managing your application.

### Common Commands

```bash
# Generate files
docker compose exec app php artisan make:controller NameController
docker compose exec app php artisan make:model ModelName -m
docker compose exec app php artisan make:migration create_table_name
docker compose exec app php artisan make:request StoreProductRequest
docker compose exec app php artisan make:mail MailName
docker compose exec app php artisan make:job JobName
docker compose exec app php artisan make:middleware MiddlewareName
docker compose exec app php artisan make:event EventName
docker compose exec app php artisan make:listener ListenerName

# Database
docker compose exec app php artisan migrate
docker compose exec app php artisan migrate:rollback
docker compose exec app php artisan migrate:fresh
docker compose exec app php artisan migrate:refresh --seed
docker compose exec app php artisan db:seed
docker compose exec app php artisan tinker

# Cache & Config
docker compose exec app php artisan config:cache
docker compose exec app php artisan config:clear
docker compose exec app php artisan cache:clear
docker compose exec app php artisan view:clear
docker compose exec app php artisan route:cache
docker compose exec app php artisan route:clear

# Serve & Debug
docker compose exec app php artisan serve
docker compose exec app php artisan optimize
docker compose exec app php artisan list

# Key generation
docker compose exec app php artisan key:generate
```

---

## Common Workflows

### Workflow 1: Create a Simple Page

**1. Create a Route**

```php
// routes/web.php
Route::get('/blog', function () {
    return view('blog.index');
});
```

**2. Create a View**

Create `resources/views/blog/index.blade.php`:

```blade
<h1>Blog Posts</h1>
<p>Welcome to my blog!</p>
```

**3. Access it**

Navigate to: http://localhost:8000/blog

### Workflow 2: Create REST API

**1. Create a Model with Migration**

```bash
docker compose exec app php artisan make:model Article -m
```

**2. Define Migration**

```php
// database/migrations/...
Schema::create('articles', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('content');
    $table->string('author');
    $table->timestamps();
});
```

**3. Create Controller**

```bash
docker compose exec app php artisan make:controller ArticleController --resource
```

**4. Define Routes**

```php
// routes/api.php
Route::apiResource('articles', ArticleController::class);
```

**5. Implement Controller**

```php
// app/Http/Controllers/ArticleController.php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:100',
        ]);
        
        return Article::create($validated);
    }
    
    public function show(Article $article)
    {
        return $article;
    }
    
    public function update(Request $request, Article $article)
    {
        $article->update($request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
            'author' => 'string|max:100',
        ]));
        
        return $article;
    }
    
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
```

**6. Test API**

```bash
# Get all articles
curl http://localhost:8000/api/articles

# Create article
curl -X POST http://localhost:8000/api/articles \
  -H "Content-Type: application/json" \
  -d '{"title":"Laravel Tips","content":"...","author":"John"}'

# Get single article
curl http://localhost:8000/api/articles/1

# Update article
curl -X PUT http://localhost:8000/api/articles/1 \
  -H "Content-Type: application/json" \
  -d '{"title":"Updated Title"}'

# Delete article
curl -X DELETE http://localhost:8000/api/articles/1
```

### Workflow 3: Run Migrations

```bash
# 1. Create migration
docker compose exec app php artisan make:migration create_users_table

# 2. Edit database/migrations/...
# Define your table structure

# 3. Run migration
docker compose exec app php artisan migrate

# 4. Check database
docker compose exec db mysql -u laravel -p
# Password: secret
# Then: USE laravel; SHOW TABLES;
```

---

## Troubleshooting

### Common Issues

#### 1. Port Already in Use

```bash
# If port 8000 is already in use, change it in docker-compose.yml
# ports:
#   - "8001:80"  # Change 8000 to 8001

docker compose down
docker compose up -d
```

#### 2. Permission Denied Errors

```bash
# Fix file permissions
docker compose exec -u root app chmod -R 777 storage bootstrap/cache
```

#### 3. Database Connection Error

```bash
# Check if MySQL container is running
docker ps

# Check logs
docker compose logs db

# Try connecting
docker compose exec app php artisan tinker
```

#### 4. Composer Dependency Issues

```bash
# Clear composer cache and reinstall
docker compose down -v
rm composer.lock
docker compose up -d --build
```

#### 5. Clear All Cache

```bash
docker compose exec app php artisan cache:clear
docker compose exec app php artisan view:clear
docker compose exec app php artisan route:clear
docker compose exec app php artisan config:clear
```

---

## Deployment

### Prepare for Production

**1. Update .env to Production**

```
APP_ENV=production
APP_DEBUG=false
CACHE_DRIVER=redis
SESSION_DRIVER=redis
```

**2. Generate Key**

```bash
docker compose exec app php artisan key:generate
```

**3. Cache Config**

```bash
docker compose exec app php artisan config:cache
docker compose exec app php artisan route:cache
```

**4. Optimize**

```bash
docker compose exec app php artisan optimize
```

**5. Run Database Migrations**

```bash
docker compose exec app php artisan migrate --force
```

### Deploy to Server

1. Push code to Git repository
2. SSH into server
3. Clone repository
4. Set `.env` file
5. Run: `docker compose up -d --build`
6. Run migrations: `docker compose exec app php artisan migrate --force`

---

## Useful Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Blade Template Engine](https://laravel.com/docs/blade)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Routing](https://laravel.com/docs/routing)
- [Controllers](https://laravel.com/docs/controllers)
- [Migrations](https://laravel.com/docs/migrations)
- [Artisan Console](https://laravel.com/docs/artisan)

---

## Project Structure Summary

| Directory | Purpose |
|-----------|---------|
| `app/` | Your application code (Models, Controllers, etc) |
| `routes/` | Route definitions |
| `resources/views/` | Blade templates |
| `database/` | Migrations and seeders |
| `config/` | Application configuration |
| `storage/` | Logs and file storage |
| `public/` | Public-facing files (images, CSS, JS) |
| `bootstrap/` | Application bootstrap code |
| `docker/` | Docker configuration |

---

## Quick Reference

### Create New Feature

```bash
# 1. Create Model + Migration
docker compose exec app php artisan make:model Feature -m

# 2. Define migration in database/migrations/...

# 3. Create Controller
docker compose exec app php artisan make:controller FeatureController

# 4. Define routes in routes/web.php

# 5. Create views in resources/views/

# 6. Run migration
docker compose exec app php artisan migrate

# 7. Test!
```

---

**Happy coding! 🚀**
