# UTS Rekayasa Web - Daftar Wisata Alam

Aplikasi Laravel untuk Ujian Tengah Semester mata kuliah Rekayasa Web.

## Identitas

- NIM: 241011750067
- Digit terakhir NIM: 7
- Tema: Daftar Wisata Alam
- Nama tabel: `destinations`

## Struktur Tabel

Kolom tabel `destinations`:

- `id`
- `name`
- `region`
- `description`
- `image`
- `ticket_price`

## Fitur

- Migration tabel `destinations`
- Seeder 10 data wisata alam
- Gambar destinasi di `public/assets/images`
- Bootstrap lokal di `public/Bootstrap`
- Halaman daftar wisata dengan card dan pagination
- Halaman detail wisata
- Navigasi antar halaman

## Menjalankan

```bash
docker compose up -d
docker compose exec app php artisan migrate --force
docker compose exec app php artisan db:seed --force
```

Akses aplikasi:

```text
http://localhost:8000
http://localhost:8000/destinations
```

## Test

```bash
docker compose exec app php artisan test
```
