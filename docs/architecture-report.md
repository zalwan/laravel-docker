# Existing Project Architecture Report

## Overview

This project is a Laravel 12 company profile application for BAWANA. The public site is implemented with Blade views, Bootstrap assets stored in `public/`, and dynamic company profile content stored in the `company_contents` table.

The current application is intentionally small: public pages read structured rows from one content model, then render those rows into home, about, services, contents, content detail, and contact pages.

## Runtime Stack

- **Framework:** Laravel 12
- **PHP:** `^8.2`
- **Frontend tooling:** Vite, Tailwind CSS plugin, Bootstrap static assets
- **Database:** MySQL in Docker, with Laravel configured through `.env`
- **Docker services:** `nginx`, `php-fpm`, `mysql`, `redis`, optional `node`
- **Testing:** PHPUnit through `php artisan test`

## Public Route Map

| Route | Name | Controller | Purpose |
| --- | --- | --- | --- |
| `/` | `home` | `HomeController@index` | Homepage with stats and highlights |
| `/about` | `about` | `AboutController@index` | Company identity, mission, clients |
| `/services` | `services` | `ServiceController@index` | Services and competitive advantages |
| `/contents` | `contents` | `ContentController@index` | Paginated dynamic content list |
| `/contents/{content}` | `contents.show` | `ContentController@show` | Dynamic content detail |
| `/contact` | `contact` | `ContactController@index` | Company contact data |

## Data Model

### `CompanyContent`

The `CompanyContent` model is the source of truth for public company profile content.

Important fields:

- `section`: categorizes content such as `stat`, `highlight`, `identity`, `mission`, `client`, `service`, `advantage`, and `contact`.
- `title`: primary heading or item title.
- `description`: long-form detail.
- `value`: secondary value, commonly used for stats and contact values.
- `label`: label for key-value rows.
- `items`: JSON array for service features and grouped details.
- `image`: filename used by public views.
- `sort_order`: ordering within each section.

The `items` field is cast to an array in the model.

## Current View Structure

The public UI uses `resources/views/layouts/app.blade.php` as the shared layout. Page templates live under `resources/views/pages`.

The layout provides:

- common metadata,
- Bootstrap CSS and JS,
- navigation,
- shared typography/card styles,
- footer.

Page templates are currently public-only and do not include admin layout, form components, authentication screens, or upload flows.

## Seeder and Test Coverage

`CompanyContentSeeder` populates sample BAWANA content across all public sections. Existing feature tests cover:

- homepage rendering,
- public page availability,
- seeded content counts,
- `items` JSON casting,
- content pagination,
- content detail rendering.

This gives a useful baseline before adding admin features.

## Gaps Before Admin Implementation

- No authentication screens or manual login/logout flow.
- No protected admin middleware.
- No dashboard route or admin layout.
- No CRUD screens for company profile, articles, products, or gallery.
- No uploaded file storage workflow beyond `storage:link`.
- No report/PDF export feature.
- No dedicated admin tests.

## Recommended Implementation Direction

The next phases should preserve the existing public route behavior while adding admin capabilities behind a protected `/admin` route group.

Recommended boundaries:

- Keep public controllers focused on public display.
- Add separate admin controllers under `App\Http\Controllers\Admin`.
- Add manual auth routes under `/login` and `/logout`.
- Add custom middleware for admin route protection.
- Add dedicated models and migrations for articles, products, and gallery items.
- Keep `CompanyContent` CRUD compatible with existing public rendering.
- Store uploaded gallery images through the `public` disk.
- Add PDF export as a server-side report route from the admin area.
