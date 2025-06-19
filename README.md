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
Here’s your **GitHub `README.md` update** explaining the **Authorization and Role-Based Access Control (RBAC)** implementation for your Laravel To-Do App:

---

## 🛡️ Authorization & Role-Based Access Control (RBAC)

This section documents the implementation of **Authorization Layer with RBAC** in the Laravel-based To-Do App.

---

### ✅ Purpose

To restrict access to different parts of the application based on **user roles** (User/Admin) and their **permissions** (CRUD rights).

---

### 👥 User Roles

We implemented two primary user roles:

| Role  | Access                                            |
| ----- | ------------------------------------------------- |
| Admin | Full access to all users, To-Dos, role management |
| User  | Can only perform actions permitted by their role  |

---

### 🧱 Database Schema Changes

#### 1. `user_roles` Table

Stores roles assigned to each user.

| Column      | Type                           |
| ----------- | ------------------------------ |
| id          | bigint                         |
| user\_id    | foreign key to `users.id`      |
| role\_name  | string (e.g., `admin`, `user`) |
| description | string                         |

#### 2. `role_permissions` Table

Stores actions each role is allowed to perform.

| Column         | Type                                              |
| -------------- | ------------------------------------------------- |
| id             | bigint                                            |
| user\_role\_id | foreign key to `user_roles.id`                    |
| permission     | string (`Create`, `Retrieve`, `Update`, `Delete`) |

---

### 🛠️ Models

#### `User.php`

```php
public function role()
{
    return $this->hasOne(UserRole::class);
}
```

#### `UserRole.php`

```php
public function user()
{
    return $this->belongsTo(User::class);
}

public function permissions()
{
    return $this->hasMany(RolePermission::class);
}
```

#### `RolePermission.php`

```php
public function userRole()
{
    return $this->belongsTo(UserRole::class);
}
```

---

### 🧪 Seeding Roles and Permissions

#### `UserRolesSeeder.php`

```php
UserRole::create([
    'user_id' => 1,
    'role_name' => 'admin',
    'description' => 'Administrator'
]);

UserRole::create([
    'user_id' => 2,
    'role_name' => 'user',
    'description' => 'Regular user'
]);
```

Run with:

```bash
php artisan db:seed --class=UserRolesSeeder
```

---

### 🔐 Middleware for Role Authorization

#### `RoleMiddleware.php`

```php
public function handle($request, Closure $next, $role)
{
    if (Auth::check() && Auth::user()->role->role_name === $role) {
        return $next($request);
    }

    abort(403, 'Unauthorized');
}
```

Registered in `Kernel.php`:

```php
'role' => \App\Http\Middleware\RoleMiddleware::class,
```

---

### 🌐 Route Definitions

```php
// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::resource('todo', TodoController::class);
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('admin.users');
    Route::post('/admin/user/{id}/deactivate', [AdminController::class, 'deactivateUser'])->name('admin.deactivate');
});
```

---

### 🖥️ Admin Functions

#### AdminController:

```php
public function listUsers()
{
    $users = User::with('role')->get();
    return view('admin.users', compact('users'));
}

public function deactivateUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return back()->with('success', 'User deactivated.');
}
```

---

### 🧼 Blade UI Authorization Example

```blade
@php
    $permissions = Auth::user()->role->permissions->pluck('permission')->toArray();
@endphp

@if(in_array('Create', $permissions))
    <a href="{{ route('todo.create') }}" class="btn btn-primary">New Task</a>
@endif
```

---

### ✅ Test Cases

| Scenario                         | Outcome                        |
| -------------------------------- | ------------------------------ |
| User logs in                     | Redirected to `/todo`          |
| Admin logs in                    | Redirected to `/admin/users`   |
| User accesses admin route        | Blocked with 403               |
| Admin deactivates user           | User account deleted           |
| Button visibility per permission | Only allowed actions are shown |

---
Here is a full section you can add to your `README.md` file to explain your implementation of **CSP**, **XSS**, and **CSRF** defenses for your Laravel To-Do App as required in your assignment:

---

## 🛡️ Web Security Enhancements: CSP, XSS, and CSRF

This section explains how the Laravel To-Do App was secured by implementing **Content Security Policy (CSP)**, **Cross-Site Scripting (XSS)** prevention, and **Cross-Site Request Forgery (CSRF)** defenses.

---

### 🔐 1. Content Security Policy (CSP)

**Goal**: Enforce same-origin policy and restrict which resources can be loaded by the browser.

#### ✅ Implementation:

1. Install the `spatie/laravel-csp` package:

   ```bash
   composer require spatie/laravel-csp
   ```

2. Publish the config file:

   ```bash
   php artisan vendor:publish --provider="Spatie\Csp\CspServiceProvider"
   ```

3. Customize the `config/csp.php`:

   ```php
   return [
       'policy' => Spatie\Csp\Policies\Basic::class,
   ];
   ```

4. Optionally, create a custom policy:

   ```php
   namespace App\Policies;

   use Spatie\Csp\Policies\Policy;
   use Spatie\Csp\Directive;
   use Spatie\Csp\Keyword;

   class CustomCspPolicy extends Policy
   {
       public function configure()
       {
           $this
               ->addDirective(Directive::DEFAULT_SRC, [Keyword::SELF])
               ->addDirective(Directive::SCRIPT_SRC, [Keyword::SELF])
               ->addDirective(Directive::STYLE_SRC, [Keyword::SELF, 'https://fonts.bunny.net']);
       }
   }
   ```

   Update `config/csp.php`:

   ```php
   'policy' => App\Policies\CustomCspPolicy::class,
   ```

---

### 🛑 2. XSS (Cross-Site Scripting) Defense

**Goal**: Prevent user-submitted scripts from executing in the browser.

#### ✅ Implementation:

1. **Escape All Output in Blade Views:**

   Laravel escapes all `{{ }}` by default. So always use:

   ```blade
   {{ $todo->title }}
   {{ $user->nickname }}
   ```

2. **Validate and Sanitize Input:**

   Example (in `FormRequest`):

   ```php
   public function rules()
   {
       return [
           'title' => 'required|string|max:255',
           'description' => 'nullable|string|max:1000'
       ];
   }
   ```

3. **Avoid `{!! !!}` unless necessary**, and sanitize it using Laravel Purifier (optional):

   ```bash
   composer require mews/purifier
   ```

---

### 🛡️ 3. CSRF (Cross-Site Request Forgery) Protection

**Goal**: Ensure forms are submitted only from trusted sources.

#### ✅ Implementation:

1. **Use Laravel’s built-in CSRF protection:**

   Laravel includes a CSRF token in all forms:

   ```blade
   <form method="POST" action="{{ route('todo.store') }}">
       @csrf
       <!-- your inputs -->
   </form>
   ```

2. **Ensure `VerifyCsrfToken` middleware is enabled:**

   Located at:

   ```php
   App\Http\Middleware\VerifyCsrfToken::class
   ```

3. **AJAX requests must send CSRF token:**

   ```js
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
   ```

4. **CSRF Token Meta Tag (already included):**

   ```blade
   <meta name="csrf-token" content="{{ csrf_token() }}">
   ```

---

### ✅ Security Summary

| Security Feature    | Implemented | Details                                                     |
| ------------------- | ----------- | ----------------------------------------------------------- |
| **CSP**             | ✅           | Set via Spatie Laravel CSP, custom policy added             |
| **XSS Prevention**  | ✅           | Output escaping in Blade, input validation in Form Requests |
| **CSRF Protection** | ✅           | Token used in all forms, middleware enabled                 |

---
