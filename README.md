# URL Shortener

A multi-tenant URL Shortener built with Laravel 12.

## Features

### Authentication

- Laravel Breeze Authentication
- Login
- Logout

### Roles

- SuperAdmin
- Admin
- Member

Implemented using:

- Spatie Laravel Permission
- Laravel Policies

---

## Multi-Tenant Architecture

Each Company contains:

- Multiple Users
- Multiple Short URLs

Users belong to exactly one company.

---

## Invitation Workflow

### SuperAdmin

Can:

- Invite Admin to a new company

### Admin

Can:

- Invite Admin in own company
- Invite Member in own company

### Member

Cannot:

- Send invitations

---

## URL Shortener

### Admin

Can:

- Create short URLs
- View all short URLs in own company

### Member

Can:

- Create short URLs
- View only URLs created by themselves

### SuperAdmin

Can:

- View all short URLs
- Cannot create short URLs

---

## Public Redirect

Example:

http://127.0.0.1:8000/s/AbCd12

Redirects to:

https://google.com

Every redirect increments the hit counter.

---

## Design Decisions

### Authorization

Authorization is handled through:

- Laravel Policies
- Spatie Permissions

No role checks are hardcoded in controllers.

### Service Layer

Business logic is extracted into:

- InvitationService
- ShortUrlService

Controllers remain thin and focused on HTTP concerns.

### Multi-Tenant Isolation

Data visibility is enforced by role:

- SuperAdmin → All URLs
- Admin → Company URLs
- Member → Own URLs

---

## Installation

Clone repository

```bash
git clone <repository-url>
```

Install dependencies

```bash
composer install
npm install
```

Create environment file

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Configure database

```env
DB_CONNECTION=mysql
DB_DATABASE=sembark_url_shortener
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations

```bash
php artisan migrate
```

Run seeders

```bash
php artisan db:seed
```

Start application

```bash
php artisan serve
npm run dev
```

---

## SuperAdmin Credentials

Email:

```text
superadmin@sembark.com
```

Password:

```text
password
```

---

## Mail Testing

Application uses:

```env
MAIL_MAILER=log
```

Invitation emails are written to:

```text
storage/logs/laravel.log
```

Copy the invitation URL from the log and open it in the browser.

---

## AI Usage Disclosure

AI tools were used for:

- Laravel syntax lookup
- Validation examples
- Architectural discussions
- Debugging assistance

All requirements interpretation, implementation decisions, debugging, testing, and final code verification were performed manually.