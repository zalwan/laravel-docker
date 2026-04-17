# Quick Reference - Common Laravel Tasks

## 🚀 Project Setup

```bash
# Navigate to project
cd /home/suryawan/projects/laravel

# Start all services
docker compose up -d

# Stop all services
docker compose down

# View logs
docker compose logs -f app

# Access app container
docker compose exec app bash
```

## 📝 Create Routes

### Simple Route
```php
// routes/web.php
Route::get('/hello', function () {
    return 'Hello!';
});
```

### Route with Parameter
```php
Route::get('/users/{id}', function ($id) {
    return "User: " . $id;
})->where('id', '[0-9]+');
```

### Route to View
```php
Route::get('/about', function () {
    return view('about', ['title' => 'About Us']);
});
```

### Route to Controller
```php
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);
```

## 🎮 Controllers

### Create Controller
```bash
docker compose exec app php artisan make:controller PostController
docker compose exec app php artisan make:controller PostController --resource
```

### Controller Methods
```php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() { /* List all */ }
    public function create() { /* Show create form */ }
    public function store(Request $request) { /* Save */ }
    public function show($id) { /* Show single */ }
    public function edit($id) { /* Show edit form */ }
    public function update(Request $request, $id) { /* Update */ }
    public function destroy($id) { /* Delete */ }
}
```

## 📊 Models & Database

### Create Model with Migration
```bash
docker compose exec app php artisan make:model Post -m
docker compose exec app php artisan make:model Post -m --resource
```

### Define Migration
```php
// database/migrations/...
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('content');
    $table->integer('views')->default(0);
    $table->timestamps(); // created_at, updated_at
});
```

### Define Model
```php
// app/Models/Post.php
namespace App\Models;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'views'];
}
```

### Run Migrations
```bash
docker compose exec app php artisan migrate
docker compose exec app php artisan migrate:rollback
docker compose exec app php artisan migrate:refresh
```

### Database Operations
```bash
# Access MySQL
docker compose exec db mysql -u laravel -p
# Password: secret

# Or use Tinker (Laravel REPL)
docker compose exec app php artisan tinker
# Then in tinker:
# >>> App\Models\Post::all();
# >>> $post = new App\Models\Post();
# >>> $post->title = 'My First Post';
# >>> $post->save();
```

## 🎨 Views & Templates

### Create View
```bash
# Create file: resources/views/posts/index.blade.php
```

### Blade Syntax
```blade
<!-- Variable -->
{{ $variable }}

<!-- Echo with fallback -->
{{ $name ?? 'Guest' }}

<!-- If statement -->
@if ($condition)
    <p>True</p>
@else
    <p>False</p>
@endif

<!-- Loop -->
@foreach ($posts as $post)
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->content }}</p>
@endforeach

<!-- Check if empty -->
@forelse ($posts as $post)
    <p>{{ $post->title }}</p>
@empty
    <p>No posts found</p>
@endforelse

<!-- Include -->
@include('header')

<!-- Forms -->
<form method="POST" action="/posts">
    @csrf
    <input type="text" name="title">
    <button type="submit">Save</button>
</form>
```

## 💾 Validation

### Validate in Controller
```php
$validated = $request->validate([
    'title' => 'required|string|max:255',
    'content' => 'required|string|min:10',
    'email' => 'required|email|unique:users',
    'age' => 'required|integer|min:18|max:100',
    'tags' => 'array|max:5',
]);

// All rules: required, string, email, numeric, integer, min, max, 
//           unique, exists, regex, nullable, array, etc.
```

### Show Validation Errors
```blade
@error('title')
    <span class="error">{{ $message }}</span>
@enderror

<!-- Or use old() to repopulate form -->
<input type="text" name="title" value="{{ old('title') }}">
```

## 📡 Artisan Commands

```bash
# Make commands
docker compose exec app php artisan make:controller NameController
docker compose exec app php artisan make:model ModelName -m
docker compose exec app php artisan make:request StoreName
docker compose exec app php artisan make:middleware MiddlewareName
docker compose exec app php artisan make:job JobName
docker compose exec app php artisan make:mail MailName

# Database
docker compose exec app php artisan migrate
docker compose exec app php artisan migrate:rollback
docker compose exec app php artisan migrate:refresh
docker compose exec app php artisan seed:db

# Cache clearing
docker compose exec app php artisan cache:clear
docker compose exec app php artisan view:clear
docker compose exec app php artisan route:clear
docker compose exec app php artisan config:clear

# Optimization
docker compose exec app php artisan optimize
docker compose exec app php artisan config:cache
docker compose exec app php artisan route:cache

# Other
docker compose exec app php artisan tinker
docker compose exec app php artisan list
docker compose exec app php artisan key:generate
```

## 🔐 Authentication Example

### Create Auth Scaffolding
```bash
docker compose exec app php artisan make:model User -m
```

### Protect Routes
```php
// Require authentication
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// Or use route groups
Route::middleware('auth')->group(function () {
    Route::get('/profile', /* ... */);
    Route::get('/settings', /* ... */);
});
```

### Check Authentication
```blade
@auth
    <p>Welcome, {{ auth()->user()->name }}</p>
@else
    <p>Please log in</p>
@endauth
```

## 🧪 Testing API Endpoints

```bash
# GET request
curl http://localhost:8000/api/posts

# POST request
curl -X POST http://localhost:8000/api/posts \
  -H "Content-Type: application/json" \
  -d '{"title":"My Post","content":"Content here"}'

# PUT request
curl -X PUT http://localhost:8000/api/posts/1 \
  -H "Content-Type: application/json" \
  -d '{"title":"Updated"}'

# DELETE request
curl -X DELETE http://localhost:8000/api/posts/1

# With authentication token
curl -H "Authorization: Bearer TOKEN" \
  http://localhost:8000/api/posts
```

## 🛠️ Common Patterns

### Form with CSRF Protection
```blade
<form method="POST" action="/posts">
    @csrf
    <input type="text" name="title" required>
    <button>Save</button>
</form>
```

### Edit Form with Method Spoofing
```blade
<form method="POST" action="/posts/{{ $post->id }}">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $post->title }}">
    <button>Update</button>
</form>
```

### Delete Confirmation
```blade
<form method="POST" action="/posts/{{ $post->id }}" style="display:inline;">
    @csrf
    @method('DELETE')
    <button onclick="return confirm('Delete this post?')">Delete</button>
</form>
```

### Redirect with Message
```php
return redirect('/posts')->with('success', 'Post created!');
```

### Display Flash Message
```blade
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
```

## 📚 Full Example: Blog Post CRUD

### 1. Create Model & Migration
```bash
docker compose exec app php artisan make:model Post -m
```

### 2. Define Migration
```php
// database/migrations/...
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('content');
    $table->string('author');
    $table->integer('views')->default(0);
    $table->timestamps();
});
```

### 3. Create Controller
```bash
docker compose exec app php artisan make:controller PostController --resource
```

### 4. Define Routes
```php
// routes/web.php
Route::resource('posts', PostController::class);
```

This creates:
- GET /posts → index (list)
- GET /posts/create → create (form)
- POST /posts → store (save)
- GET /posts/{post} → show (detail)
- GET /posts/{post}/edit → edit (form)
- PUT /posts/{post} → update (save change)
- DELETE /posts/{post} → destroy (delete)

### 5. Implement Controller
```php
// app/Http/Controllers/PostController.php
public function index()
{
    $posts = Post::all();
    return view('posts.index', compact('posts'));
}

public function create()
{
    return view('posts.create');
}

public function store(Request $request)
{
    Post::create($request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'author' => 'required|string|max:100',
    ]));
    return redirect('/posts')->with('success', 'Post created!');
}

public function show(Post $post)
{
    return view('posts.show', compact('post'));
}

public function edit(Post $post)
{
    return view('posts.edit', compact('post'));
}

public function update(Request $request, Post $post)
{
    $post->update($request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'author' => 'required|string|max:100',
    ]));
    return redirect('/posts')->with('success', 'Post updated!');
}

public function destroy(Post $post)
{
    $post->delete();
    return redirect('/posts')->with('success', 'Post deleted!');
}
```

### 6. Create Views
```bash
mkdir -p resources/views/posts
# Create: create.blade.php, edit.blade.php, index.blade.php, show.blade.php
```

### 7. Run Migration
```bash
docker compose exec app php artisan migrate
```

### 8. Access at
- http://localhost:8000/posts - List all
- http://localhost:8000/posts/create - Create form
- http://localhost:8000/posts/1 - View post
- http://localhost:8000/posts/1/edit - Edit form

---

## 📖 Need More Help?

- See full documentation: `LARAVEL_GUIDE.md`
- Laravel docs: https://laravel.com/docs
- Ask in terminal: `docker compose exec app php artisan list`
