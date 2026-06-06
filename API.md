# API, Admin, and Swagger Guide

Panduan ini mencatat alur auth, admin panel, Swagger, dan REST API users agar setup project mudah diulang.

## Base URL

- Web app: `http://localhost:8000`
- API base: `http://localhost:8000/api`
- Swagger UI: `http://localhost:8000/api/docs`
- OpenAPI JSON: `http://localhost:8000/api/openapi.json`

## Menjalankan Project

```bash
docker compose up -d --build
docker compose exec app php artisan migrate --seed
```

Catatan Docker:
- `vendor/`, `storage/`, dan `bootstrap/cache` memakai Docker named volume.
- Jika `vendor/autoload.php` belum ada, `docker/entrypoint.sh` otomatis menjalankan `composer install`.
- Jika `APP_KEY` masih kosong atau placeholder, entrypoint otomatis menjalankan `php artisan key:generate --force`.

## Akun Admin Default

Seeder membuat akun admin default:

- Email: `admin@example.com`
- Password: `password123`

Login web:

```text
http://localhost:8000/login
```

Setelah login, admin bisa mengakses:

```text
http://localhost:8000/admin/projects
http://localhost:8000/api/docs
```

Credential default bisa dioverride lewat `.env`:

```env
ADMIN_NAME=Admin
ADMIN_EMAIL=admin@example.com
ADMIN_PASSWORD=password123
```

Lalu jalankan:

```bash
docker compose exec app php artisan db:seed --class=UserSeeder
```

## Swagger Auto Login

Swagger hanya bisa diakses oleh user yang sudah login lewat web session.

Alur yang disarankan:

1. Buka `http://localhost:8000/login`
2. Login dengan akun admin
3. Buka `http://localhost:8000/api/docs`
4. Swagger otomatis membuat Sanctum token untuk user yang sedang login
5. Token langsung dipasang ke `bearerAuth`, jadi endpoint protected bisa dicoba tanpa copy-paste `data.token`

Jika tetap menjalankan `POST /api/login` atau `POST /api/register` dari Swagger, token dari response juga otomatis diparsing dan dipasang ke Swagger.

Saat logout web, token `swagger-ui` milik user tersebut ikut dihapus.

## Authentication API

API menggunakan Laravel Sanctum personal access token.

Header untuk endpoint protected:

```http
Authorization: Bearer <token>
Accept: application/json
```

### Register

```http
POST /api/register
```

Body:

```json
{
  "name": "Admin",
  "email": "admin@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

Response `201`:

```json
{
  "message": "User registered successfully.",
  "data": {
    "user": {
      "id": 1,
      "name": "Admin",
      "email": "admin@example.com"
    },
    "token": "1|sanctum-token",
    "token_type": "Bearer"
  }
}
```

### Login

```http
POST /api/login
```

Body:

```json
{
  "email": "admin@example.com",
  "password": "password123"
}
```

Response `200` berisi `data.token`.

### Logout

```http
POST /api/logout
```

Auth: Bearer token.

Logout menghapus token yang sedang dipakai.

## Users API

Semua endpoint users membutuhkan Bearer token.

### Current User

```http
GET /api/users/me
```

### List Users

```http
GET /api/users
```

Response berupa pagination Laravel.

### Create User

```http
POST /api/users
```

Body:

```json
{
  "name": "User Baru",
  "email": "user@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

### Detail User

```http
GET /api/users/{id}
```

### Update User

```http
PUT /api/users/{id}
PATCH /api/users/{id}
```

Body bisa parsial:

```json
{
  "name": "User Updated",
  "email": "user.updated@example.com"
}
```

Untuk mengganti password:

```json
{
  "password": "newpassword123",
  "password_confirmation": "newpassword123"
}
```

### Delete User

```http
DELETE /api/users/{id}
```

Delete user juga menghapus semua token Sanctum milik user tersebut.

## Admin Panel

Route admin diproteksi middleware `auth`.

- Guest yang membuka `/admin/projects` akan diarahkan ke `/login`.
- User yang login bisa mengelola Projects dari admin panel.
- Tombol logout tersedia di sidebar admin.

## Useful Commands

```bash
# Lihat semua route
docker compose exec app php artisan route:list

# Lihat route API
docker compose exec app php artisan route:list --path=api

# Jalankan migration
docker compose exec app php artisan migrate

# Seed akun admin default
docker compose exec app php artisan db:seed --class=UserSeeder

# Reset database lokal dan seed ulang
docker compose exec app php artisan migrate:fresh --seed
```

## Troubleshooting

### Swagger redirect ke login

Artinya belum login web session. Login dulu di:

```text
http://localhost:8000/login
```

### Endpoint users mengembalikan 401

Pastikan:
- Sudah login web sebelum membuka Swagger
- Swagger sudah membuka `/api/docs` setelah login
- Jika pakai curl/Postman, header `Authorization: Bearer <token>` sudah dikirim

### Password admin default tidak cocok

Jalankan ulang:

```bash
docker compose exec app php artisan db:seed --class=UserSeeder
```

Jika `.env` berisi `ADMIN_PASSWORD`, password dari env itulah yang dipakai.
