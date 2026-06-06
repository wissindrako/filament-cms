# Filament CMS — Project Instructions

## Overview

Laravel 12 + Filament 3.3 portfolio/CMS. Admin panel for managing services, projects, and testimonials with a public landing page. Role-based access control via Spatie Permission + Filament Shield.

## Stack

- **Backend**: Laravel 12, PHP 8.2+
- **Admin panel**: Filament 3.3 at `/admin`
- **Auth & permissions**: Spatie Laravel Permission + Filament Shield
- **Media**: Spatie Media Library + Filament Media Library Plugin
- **Frontend**: Blade + Tailwind CSS 4 + Vite 6
- **Database**: SQLite (default)

## Running the Project

```bash
# Start all services (server + queue + logs + vite)
composer dev

# Or individually
php artisan serve
npm run dev
php artisan queue:listen --tries=1
```

## Project Structure

```
app/
├── Enums/ContentStatus.php          # Draft|PendingReview|Approved|Rejected|Published
├── Filament/
│   ├── Pages/SiteSettings.php       # Global site configuration page
│   └── Resources/
│       ├── ProjectResource.php
│       ├── ServiceResource.php
│       └── TestimonialResource.php
├── Http/Controllers/LandingController.php
├── Http/Controllers/ContactController.php
├── Mail/ContactFormMail.php
├── Models/
│   ├── Project.php                  # has cover + gallery media
│   ├── Service.php                  # has cover media
│   ├── SiteSetting.php              # key-value site config (group/key/value)
│   ├── Testimonial.php              # has avatar media
│   └── User.php                     # HasRoles trait
├── Policies/                        # Shield-generated, delegate to Spatie permissions
└── Providers/Filament/AdminPanelProvider.php
```

## Key Models

### Content Models (Service, Project, Testimonial)

All share this pattern:
- `status` → `ContentStatus` enum (Draft → PendingReview → Approved/Rejected → Published)
- `order` → integer for sorting
- `created_by` / `approved_by` → user tracking
- `slug` → auto-generated from title
- Scope: `published()` for public queries
- Media via Spatie (avoid direct file handling)

**Project** extras: `tech_stack` (JSON), `client`, `url`, `featured` (bool), gallery media collection.

### SiteSetting

Static helpers for global config:
```php
SiteSetting::get('hero', 'title');
SiteSetting::set('hero', 'title', 'New Value');
```
Groups: `hero`, `general`, `social`, `sections`, `mail`.

## Content Workflow

`Draft` → `PendingReview` → `Approved` or `Rejected` → `Published`

- Status field in Filament forms is restricted by role (admin/approver can change it)
- Public landing page only shows `Published` content

## Roles & Permissions

- Filament Shield generates permissions automatically: `view_any_project`, `create_project`, etc.
- Panel access controlled via `User::canAccessPanel()`
- Roles: admin, editor, approver (defined in seeders)

## Filament Admin Panel

- URL: `/admin`
- Color: Amber
- Navigation group for content resources: **"Contenido"**
- Resources and pages are **auto-discovered** — follow Filament conventions when adding new ones
- Status enum labels are in **Spanish**

## Contact Form

- `POST /contact` → `ContactController@store` — validates, configures SMTP at runtime, sends email
- Mailable: `App\Mail\ContactFormMail` — email view at `resources/views/emails/contact-form.blade.php`
- SMTP config is loaded from `SiteSetting` (group `mail`) at send time via `Config::set()`, falling back to `.env` values if not set in DB
- Admin configures mail from **Admin → Configuración → tab "Correo"**
- `mail_encryption` values: `smtps` (SSL/465), `tls` (STARTTLS/587), `none` (sin cifrado) — stored as `scheme` in Laravel mailer config, NOT as `encryption`
- Destination email: `mail_to` setting (falls back to `contact_email`, then `mail.from.address`)

## Routes

- `GET /` → `LandingController@index` (public landing, shows all published content + site settings)
- `POST /contact` → `ContactController@store`

## Conventions

- Use `ContentStatus` enum for all status fields — do not add raw string status columns
- Use Spatie Media Library for all image/file uploads — do not store paths in model columns
- Slug generation is automatic from title — do not manually set slugs unless overriding
- New content resources should follow the existing Resource pattern (form/table/infolist with status, order, media)
- Policies are Shield-managed — regenerate with `php artisan shield:generate` after adding resources
