# UTS Rekayasa Web - Daftar Wisata Alam

Aplikasi ini dibuat untuk memenuhi Ujian Tengah Semester mata kuliah Rekayasa Web. Project menggunakan Laravel, Blade Template, Bootstrap lokal, MySQL, migration, seeder, dan halaman web dinamis berbasis database.

## Identitas Project

| Keterangan | Nilai |
| --- | --- |
| Nama | Rizal Suryawan |
| NIM | `241011750067` |
| Digit terakhir NIM | `7` |
| Tema digit 7 | Daftar Wisata Alam |
| Nama database | `db_uts_241011750067` |
| Nama tabel utama | `destinations` |
| Framework | Laravel |
| Template engine | Blade |
| CSS framework | Bootstrap lokal |

## Kesesuaian Dengan Soal

| Requirement UTS | Implementasi di project | Status |
| --- | --- | --- |
| Menggunakan Laravel | Struktur Laravel lengkap tersedia di repo | Sesuai |
| Menggunakan Blade Template | View berada di `resources/views` dan memakai layout Blade | Sesuai |
| Menggunakan Bootstrap | Asset lokal berada di `public/Bootstrap` | Sesuai |
| Tema sesuai digit akhir NIM | Digit akhir `7`, tema `Daftar Wisata Alam` | Sesuai |
| Database khusus UTS | Database memakai `db_uts_241011750067` | Sesuai |
| Membuat tabel `destinations` | Migration `2026_05_09_020000_create_destinations_table.php` | Sesuai |
| Kolom `id` | Dibuat oleh `$table->id()` | Sesuai |
| Kolom `name` | `$table->string('name')` | Sesuai |
| Kolom `region` | `$table->string('region')` | Sesuai |
| Kolom `description` | `$table->text('description')` | Sesuai |
| Kolom `image` | `$table->string('image')` | Sesuai |
| Kolom `ticket_price` | `$table->decimal('ticket_price', 12, 2)` | Sesuai |
| Data dummy dari seeder | `DestinationSeeder` mengisi 10 data wisata alam | Sesuai |
| Gambar di public assets | Semua gambar berada di `public/assets/images` | Sesuai |
| Halaman daftar data | Route `/destinations` menampilkan card dan pagination | Sesuai |
| Halaman detail data | Route `/destinations/{destination}` menampilkan detail wisata | Sesuai |
| Navigasi antar halaman | Navbar berisi Home, About, Destinations, Contact | Sesuai |

## Fitur Aplikasi

- Homepage dengan hero image, ringkasan statistik, dan destinasi unggulan.
- Halaman daftar wisata alam dengan card, gambar, wilayah, deskripsi singkat, harga tiket, dan tombol detail.
- Pagination daftar wisata, 6 data per halaman, dengan ringkasan hasil di bawah pagination.
- Halaman detail wisata berisi gambar besar, wilayah, harga tiket, deskripsi, dan informasi destinasi.
- Halaman About berisi identitas UTS dan teknologi yang digunakan.
- Halaman Contact berisi informasi pengembang dan form tampilan.
- Data destinasi bersifat dinamis dari database MySQL melalui model `Destination`.
- Seeder menyediakan 10 data wisata alam Indonesia.
- Gambar destinasi menggunakan foto dari Wikimedia Commons dan disimpan lokal.
- Atribusi gambar tersedia di `public/assets/images/ATTRIBUTIONS.md`.

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

## Data Seeder

Seeder utama berada di `database/seeders/DestinationSeeder.php`. Jumlah data yang disediakan: 10 destinasi.

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
| GET | `/about` | `about` | `PageController@about` | Halaman informasi aplikasi |
| GET | `/destinations` | `destinations` | `DestinationController@index` | Daftar wisata alam |
| GET | `/destinations/{destination}` | `destinations.show` | `DestinationController@show` | Detail wisata alam |
| GET | `/contact` | `contact` | `PageController@contact` | Halaman contact |

## Cara Menjalankan Project

Pastikan Docker service sudah berjalan, lalu jalankan:

```bash
docker compose up -d
```

Buat database khusus UTS dan grant user Laravel:

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
APP_NAME="UTS Rizal Suryawan"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db_uts_241011750067
DB_USERNAME=laravel
DB_PASSWORD=secret
```

## Verifikasi Manual

Periksa route:

```bash
docker compose exec app php artisan route:list
```

Periksa migration:

```bash
docker compose exec app php artisan migrate:status
```

Periksa tabel dan jumlah data:

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

- Homepage menampilkan tema UTS dan identitas Rizal Suryawan.
- Seeder membuat 10 data destinasi.
- File gambar destinasi tersedia.
- Halaman daftar destinasi memakai pagination.
- Halaman About dan Contact bisa diakses.
- Halaman detail destinasi bisa diakses.

## Catatan Gambar

Semua gambar destinasi disimpan lokal di `public/assets/images` agar aplikasi tetap bisa menampilkan asset tanpa mengambil gambar langsung dari internet saat runtime.

Daftar sumber dan lisensi gambar tersedia di:

```text
public/assets/images/ATTRIBUTIONS.md
```

## Kesimpulan

Project ini sudah memenuhi requirement utama UTS Rekayasa Web milik Rizal Suryawan dengan NIM `241011750067` dan tema `Daftar Wisata Alam`: menggunakan Laravel, Blade, Bootstrap, migration, seeder, database MySQL, data dinamis, gambar lokal, halaman daftar, halaman detail, dan navigasi.
