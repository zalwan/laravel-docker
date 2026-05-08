# Katalog Wisata Alam

Katalog Wisata Alam adalah aplikasi web berbasis Laravel untuk menampilkan daftar destinasi wisata alam Indonesia. Aplikasi ini memakai data dinamis dari MySQL, Blade Template untuk tampilan, Bootstrap lokal untuk styling, serta gambar destinasi yang disimpan di dalam project agar halaman tetap konsisten saat dijalankan.

## Ringkasan

| Keterangan | Nilai |
| --- | --- |
| Nama pengembang | Rizal Suryawan |
| Nomor identitas | `241011750067` |
| Tema aplikasi | Daftar Wisata Alam |
| Database | `db_uts_241011750067` |
| Tabel utama | `destinations` |
| Framework | Laravel |
| Template engine | Blade |
| CSS framework | Bootstrap lokal |

## Fitur Utama

- Homepage dengan hero image, statistik singkat, dan destinasi unggulan.
- Halaman daftar wisata alam berisi card destinasi, gambar, wilayah, deskripsi singkat, dan harga tiket.
- Pagination pada daftar destinasi, 6 data per halaman, dengan ringkasan jumlah data di bawah pagination.
- Halaman detail destinasi berisi gambar besar, wilayah, harga tiket, deskripsi, dan metadata destinasi.
- Halaman About untuk menjelaskan identitas aplikasi dan teknologi yang digunakan.
- Halaman Contact untuk informasi pengembang dan form tampilan.
- Data destinasi bersifat dinamis dari database melalui model `Destination`.
- Seeder menyediakan 10 data destinasi wisata alam Indonesia.
- Gambar destinasi memakai foto lokal dari `public/assets/images`.
- Atribusi gambar tersedia di `public/assets/images/ATTRIBUTIONS.md`.

## Stack Teknologi

| Area | Teknologi |
| --- | --- |
| Backend | Laravel |
| View | Blade Template |
| Styling | Bootstrap lokal |
| Database | MySQL |
| ORM | Eloquent |
| Asset | Public assets |
| Testing | Laravel Feature Test |

## Struktur Database

Tabel utama: `destinations`

| Kolom | Tipe | Keterangan |
| --- | --- | --- |
| `id` | big integer unsigned | Primary key, auto increment |
| `name` | varchar | Nama destinasi wisata |
| `region` | varchar | Wilayah/provinsi destinasi |
| `description` | text | Deskripsi destinasi |
| `image` | varchar | Nama file gambar di `public/assets/images` |
| `ticket_price` | decimal(12,2) | Harga tiket masuk |
| `created_at` | timestamp | Waktu data dibuat |
| `updated_at` | timestamp | Waktu data diperbarui |

Migration tabel berada di:

```text
database/migrations/2026_05_09_020000_create_destinations_table.php
```

## Data Awal

Seeder utama berada di `database/seeders/DestinationSeeder.php`. Seeder ini mengisi 10 destinasi awal.

| No | Nama Destinasi | Wilayah | Gambar | Harga Tiket |
| --- | --- | --- | --- | --- |
| 1 | Pantai Pink Lombok | Nusa Tenggara Barat | `pantai-pink.png` | Rp 25.000 |
| 2 | Kawah Ijen | Jawa Timur | `kawah-ijen.png` | Rp 15.000 |
| 3 | Raja Ampat | Papua Barat Daya | `raja-ampat.png` | Rp 500.000 |
| 4 | Gunung Bromo | Jawa Timur | `gunung-bromo.png` | Rp 29.000 |
| 5 | Danau Toba | Sumatera Utara | `danau-toba.png` | Rp 15.000 |
| 6 | Taman Nasional Komodo | Nusa Tenggara Timur | `komodo.png` | Rp 150.000 |
| 7 | Curug Cikaso | Jawa Barat | `curug-cikaso.png` | Rp 10.000 |
| 8 | Nusa Penida | Bali | `nusa-penida.png` | Rp 25.000 |
| 9 | Dataran Tinggi Dieng | Jawa Tengah | `dieng.png` | Rp 20.000 |
| 10 | Gunung Rinjani | Nusa Tenggara Barat | `rinjani.png` | Rp 35.000 |

## Struktur File Penting

```text
app/
  Http/Controllers/
    HomeController.php
    DestinationController.php
    PageController.php
  Models/
    Destination.php

database/
  migrations/
    2026_05_09_020000_create_destinations_table.php
  seeders/
    DatabaseSeeder.php
    DestinationSeeder.php

public/
  Bootstrap/
    bootstrap.min.css
    bootstrap.bundle.min.js
  assets/images/
    ATTRIBUTIONS.md
    *.png

resources/views/
  layouts/app.blade.php
  pages/home.blade.php
  pages/about.blade.php
  pages/destinations.blade.php
  pages/destination-detail.blade.php
  pages/contact.blade.php
  vendor/pagination/centered-bootstrap-5.blade.php

routes/
  web.php
```

## Route Aplikasi

| Method | URL | Nama Route | Controller | Fungsi |
| --- | --- | --- | --- | --- |
| GET | `/` | `home` | `HomeController@index` | Homepage |
| GET | `/about` | `about` | `PageController@about` | Informasi aplikasi |
| GET | `/destinations` | `destinations` | `DestinationController@index` | Daftar destinasi |
| GET | `/destinations/{destination}` | `destinations.show` | `DestinationController@show` | Detail destinasi |
| GET | `/contact` | `contact` | `PageController@contact` | Kontak |

## Cara Menjalankan Project

Pastikan Docker service sudah berjalan, lalu jalankan:

```bash
docker compose up -d
```

Buat database dan berikan akses untuk user Laravel:

```bash
docker compose exec db mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS db_uts_241011750067 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; GRANT ALL PRIVILEGES ON db_uts_241011750067.* TO 'laravel'@'%'; FLUSH PRIVILEGES;"
```

Jalankan migration dan seeder:

```bash
docker compose exec app php artisan migrate --force
docker compose exec app php artisan db:seed --force
```

Akses aplikasi melalui browser:

```text
http://localhost:8000
http://localhost:8000/destinations
```

## Konfigurasi Environment

Konfigurasi utama ada di `.env` dan contoh konfigurasi tersedia di `.env.example`.

```env
APP_NAME="Katalog Wisata Alam"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db_uts_241011750067
DB_USERNAME=laravel
DB_PASSWORD=secret
```

## Verifikasi Manual

Periksa daftar route:

```bash
docker compose exec app php artisan route:list
```

Periksa status migration:

```bash
docker compose exec app php artisan migrate:status
```

Periksa struktur tabel dan jumlah data:

```bash
docker compose exec db mysql -ularavel -psecret db_uts_241011750067 -e "DESCRIBE destinations; SELECT COUNT(*) AS total_destinations FROM destinations;"
```

Hasil yang diharapkan:

- Migration `create_destinations_table` berstatus `Ran`.
- Tabel `destinations` memiliki kolom `id`, `name`, `region`, `description`, `image`, `ticket_price`, `created_at`, dan `updated_at`.
- Jumlah data destinasi adalah `10`.

## Testing

Jalankan test:

```bash
docker compose exec app php artisan test
```

Test yang tersedia memeriksa:

- Homepage menampilkan tema aplikasi dan identitas pengembang.
- Seeder membuat 10 data destinasi.
- File gambar destinasi tersedia.
- Halaman daftar destinasi memakai pagination.
- Halaman About dan Contact bisa diakses.
- Halaman detail destinasi bisa diakses.

## Catatan Gambar

Semua gambar destinasi disimpan lokal di `public/assets/images` agar aplikasi dapat menampilkan asset tanpa mengambil gambar langsung dari internet saat runtime.

Daftar sumber dan lisensi gambar tersedia di:

```text
public/assets/images/ATTRIBUTIONS.md
```

## Catatan Pengembangan

Project ini berfokus pada implementasi aplikasi katalog yang sederhana, rapi, dan mudah diperiksa. Struktur data dipisahkan melalui migration dan seeder, tampilan dipisahkan melalui Blade, dan akses halaman dikelola melalui route serta controller Laravel.
