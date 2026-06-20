# Sembark URL Shortener

A multi-tenant URL shortening application built with Laravel 12.

The application implements a role-based access control (RBAC) system where users belong to companies and can manage invitations and short URLs according to their assigned permissions.

---

## Features

### Authentication

* Login using Laravel Breeze
* Secure password hashing
* Session-based authentication

### Role-Based Access Control (RBAC)

Implemented using Spatie Laravel Permission.

Roles:

* SuperAdmin
* Admin
* Member

Permissions are assigned to roles instead of hardcoding authorization logic.

---

## User Roles

### SuperAdmin

Can:

* Invite Admin users
* View all short URLs across all companies

Cannot:

* Create short URLs

### Admin

Can:

* Invite Admin users
* Invite Member users
* Create short URLs
* View all short URLs within their company

Cannot:

* View URLs belonging to other companies

### Member

Can:

* Create short URLs
* View only URLs created by themselves

Cannot:

* Send invitations
* View URLs created by other users

---

## Invitation Workflow

The application uses an invitation-based onboarding process.

### SuperAdmin → Admin

1. SuperAdmin creates an invitation.
2. A company is created.
3. Invitation record is created.
4. Invitation email is generated.

### Admin → Admin / Member

1. Admin creates an invitation.
2. Invitation is linked to Admin's company.
3. Invitation email is generated.

### Accepting Invitations

1. User opens invitation link.
2. User enters:

   * Name
   * Password
   * Password Confirmation
3. User account is created.
4. Company is assigned automatically.
5. Role is assigned automatically.
6. Invitation is marked as accepted.
7. User is logged in automatically.

---

## Invitation Security

* UUID-based invitation tokens
* Expiring invitations
* Accepted invitations cannot be reused
* Authorization enforced through Policies
* Members cannot access invitation endpoints

---

## Email Testing

For local development, invitation emails are written to logs.

### Environment Configuration

```env
MAIL_MAILER=log
```

### Email Location

```text
storage/logs/laravel.log
```

### Testing Invitations

1. Create an invitation.
2. Open:

```text
storage/logs/laravel.log
```

3. Copy the invitation URL.
4. Open the URL in the browser.
5. Complete the registration process.

---

## Architecture

The application follows a layered architecture.

### Controllers

Handle:

* HTTP requests
* Authorization
* Responses

### Form Requests

Handle:

* Validation
* Request authorization

Examples:

* StoreInvitationRequest
* AcceptInvitationRequest

### Policies

Handle authorization rules.

Example:

* InvitationPolicy

### Services

Contain business logic.

Example:

* InvitationService

### Models

* User
* Company
* Invitation
* ShortUrl

---

## Database Structure

### companies

| Column     |
| ---------- |
| id         |
| name       |
| created_at |
| updated_at |

### users

| Column     |
| ---------- |
| id         |
| company_id |
| name       |
| email      |
| password   |
| created_at |
| updated_at |

### invitations

| Column      |
| ----------- |
| id          |
| company_id  |
| invited_by  |
| email       |
| role        |
| token       |
| expires_at  |
| accepted_at |
| created_at  |
| updated_at  |

---

## Tech Stack

* PHP 8.2
* Laravel 12
* MySQL
* Laravel Breeze
* Spatie Laravel Permission
* Blade
* Tailwind CSS

---

## Installation

Clone repository:

```bash
git clone <repository-url>
```

Move into project:

```bash
cd sembark-url-shortener
```

Install dependencies:

```bash
composer install
npm install
```

Create environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Configure MySQL database inside:

```env
DB_CONNECTION=mysql
DB_DATABASE=sembark_url_shortener
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations:

```bash
php artisan migrate
```

Seed roles and SuperAdmin:

```bash
php artisan db:seed
```

Install frontend assets:

```bash
npm run build
```

Start application:

```bash
php artisan serve
```

---

## Default SuperAdmin Account

```text
Email: superadmin@sembark.com
Password: password
```

---

## Authorization Strategy

Authorization is implemented using:

* Laravel Policies
* Spatie Permissions

This approach was chosen to avoid role checks inside controllers and keep authorization logic centralized and maintainable.

---

## Future Enhancements

* URL shortening module
* URL analytics
* Click tracking
* Queued emails
* Audit logs
* Company management dashboard

---

## Author

Ankit Parmar

Senior PHP Full Stack Developer
