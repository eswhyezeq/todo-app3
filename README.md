<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

### 🔐 User Roles

* **Registered Users:**
  The app currently supports only one user role — **authenticated users** (those who register and log in).
  Each user can create, view, update, and delete their own to-do tasks.
  There are **no admin or guest roles** implemented.

---

### 🧾 Data Format and Input Types

The To-Do App stores the following fields in each task (`todos` table):

| Field         | Data Type        | Input Format              | Description                      |
| ------------- | ---------------- | ------------------------- | -------------------------------- |
| `title`       | `string`         | Text (max 255 characters) | Short name for the to-do item    |
| `description` | `text`           | Multi-line text           | Optional detailed notes          |
| `status`      | `enum`           | `pending` or `completed`  | The current status of the task   |
| `user_id`     | `unsignedBigInt` | Numeric (auto-linked)     | ID of the user who owns the task |
| `created_at`  | `timestamp`      | Auto-generated            | When the task was created        |
| `updated_at`  | `timestamp`      | Auto-generated            | When the task was last updated   |

---

### 🔎 Data Validation & Filtering Before Storage

The app uses **Laravel validation rules** to ensure data integrity before storing:

| Field         | Validation Rule                           |
| ------------- | ----------------------------------------- |
| `title`       | `required`, `string`, `max:255`           |
| `description` | `nullable`, `string`                      |
| `status`      | `required`, `in:pending,completed`        |
| `user_id`     | Automatically injected via `auth()->id()` |

Additional filtering:

* Only **authenticated users** can create, update, or delete tasks.
* Each user can only access their own tasks using a `where('user_id', auth()->id())` condition in queries.

---

# ✅ Laravel To-Do App: Security & Profile Enhancements

This project enhances a basic Laravel To-Do App by implementing:

- Input validation with Form Request classes
- A user Profile Page with editable details and avatar upload
- Multi-Factor Authentication (MFA) via email using Laravel Fortify
- Custom password salting and secure hashing
- Rate limiting on failed login attempts

---

## 🔒 1. Input Validation using Form Request

- Created RegisterRequest and LoginRequest classes to validate user input.
- Used regex to ensure only alphabets allowed for names and proper email format.
- Applied confirmed, min:8 rules for password security.

'name' => ['required', 'regex:/^[A-Za-z ]+$/'],
'password' => ['required', 'min:8', 'confirmed'],

## 👤 2. User Profile Page

- Created a `ProfileController` to manage user profile.
- Added fields to `users` table:
  - `nickname`
  - `avatar`
  - `phone`
  - `city`

### User Features:
- [ ] Upload a profile picture
- [ ] Edit profile information:
  - Nickname
  - Email
  - Phone
  - City
  - Password
- [ ] Delete account

> **Note:** Avatar uploads are stored in `/storage/app/public/avatars`

## 🛡️ 3. Multi-Factor Authentication (MFA)

### Implementation
- Installed Laravel Fortify package:
  ```bash
  composer require laravel/fortify
  php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"

Features
1. Email-based two-factor authentication (2FA)
2. Users receive a verification code via email to complete login

Flow
1. User attempts login
2. System sends verification code to registered email
3. User enters code to complete authentication

## 🔐 4. Password Hashing with Custom Salt

### Database Changes
- Added `salt` column to `users` table

### Implementation Details
- Generates random 16-character salt during registration
- Combines password + salt before hashing
- Stores both the hashed result and the plain salt
- Modifies login process to use stored salt for verification

### Code Example
```php
// Registration
$salt = Str::random(16);
$user->salt = $salt;
$user->password = Hash::make($request->password . $salt);

// Login Verification
$user = User::where('email', $request->email)->first();
if ($user && Hash::check($request->password . $user->salt, $user->password)) {
    // Authentication passed
};
```
---
## 🚫 5. Rate Limiting for Login

### Implementation
- Added rate limiting to prevent brute-force attacks
- Configured in `RouteServiceProvider.php`
- Limits to **3 login attempts per minute**

### Configuration
```php
// In RouteServiceProvider.php
RateLimiter::for('login', function (Request $request) {
    return Limit::perMinute(3)->by($request->email . $request->ip());
});
```

---
