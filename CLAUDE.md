# CLAUDE.md

## Project Overview

CSE485 - Web Technology course repository (Thang Long University). Contains practical assignments (BTTH/) and tutorial sessions (PHT/). The main project is **BTTH2**: an Online Course Management System built with PHP MVC.

## Repository Structure

```
CSE485-CongNgheWeb/
├── BTTH/                    # Practical Assignments
│   ├── BTTH01/              # Assignment 1: Basic PHP, CSV, DB basics
│   └── BTTH2/               # Main project: Online Course Management System
│       ├── app/
│       │   ├── Core/        # Router.php, Controller.php (base class)
│       │   ├── Controllers/ # Home, Auth, Course, Student, Instructor
│       │   ├── Models/      # Database, User, Course, Category, Enrollment
│       │   └── Views/       # 14 PHP templates (layouts, auth, courses, etc.)
│       ├── config/          # app.php (autoloading), database.php
│       ├── database/        # onlinecourse.sql (schema + sample data)
│       ├── public/assets/   # css/style.css, js/script.js
│       └── index.php        # Entry point & route definitions
├── PHT/                     # Tutorial Sessions (Buoi 1-5)
└── CLAUDE.md
```

## Tech Stack

- **Backend:** PHP 7.4+ with custom MVC framework (no Composer)
- **Database:** MySQL 5.7+ via PDO with prepared statements
- **Frontend:** HTML5, CSS3 (custom properties), vanilla JS (ES6+), Bootstrap 5, Font Awesome 6
- **Server:** Apache/Nginx with mod_rewrite (XAMPP/WAMP/LAMP)
- **No build tools, no package managers, no test framework**

## Key Architecture (BTTH2)

### Entry Point & Routing

`index.php` defines all routes using a custom `Router` class with regex pattern matching. Routes dispatch to `Controller@method` strings.

### Design Patterns

- **MVC** — strict separation across app/Models, app/Views, app/Controllers
- **Singleton** — `Database::getInstance()` for DB connection
- **Active Record-ish** — models handle their own queries
- **Template layout** — views use `layouts/main.php` as wrapper

### Database

6 tables: `users`, `categories`, `courses`, `enrollments`, `lessons`, `materials`. Schema at `BTTH2/database/onlinecourse.sql`. User roles: 0=student, 1=instructor, 2=admin.

**Sample credentials** (password: `password`): admin@onlinecourse.com, instructor1@onlinecourse.com, student1@onlinecourse.com

### Routes

| Method | Path | Controller |
|--------|------|-----------|
| GET | / | HomeController@index |
| GET/POST | /login, /register | AuthController |
| GET | /courses, /courses/{id} | CourseController |
| GET/POST | /student/* | StudentController (role 0) |
| GET/POST | /instructor/* | InstructorController (role 1) |

## Code Conventions

### PHP
- 4-space indentation
- PascalCase classes, camelCase methods, UPPER_SNAKE_CASE constants
- Opening braces on same line
- No closing `?>` tags in class files
- All DB queries use PDO prepared statements

### JavaScript
- 4-space indentation, camelCase
- Event-driven with DOMContentLoaded
- Global namespace: `window.CourseManager`
- Fetch API for AJAX (`makeRequest` helper)

### CSS
- CSS custom properties for design tokens (colors, spacing, typography)
- BEM-like component naming (`.course-card`, `.dashboard-card`)
- Mobile-first responsive design (breakpoint at 768px)

## Development Setup

1. Place project in web server root at `/cse485/BTTH2/`
2. Import `BTTH2/database/onlinecourse.sql` into MySQL
3. Update `BTTH2/config/database.php` if credentials differ from root/empty
4. Access at `http://localhost/cse485/BTTH2`

## Security Notes

- Passwords hashed with `password_hash()` (bcrypt)
- PDO prepared statements prevent SQL injection
- Session config: HttpOnly cookies, cookie-only sessions
- Role-based access via `requireRole()` in base Controller
- **Missing:** CSRF protection, input validation middleware, environment-based config

## Important Conventions for AI Assistants

- **Language:** Code comments and variable names in English; UI content and documentation often in Vietnamese
- **No dependency managers** — do not add composer.json or package.json unless explicitly requested
- **No autoloading standard** — uses custom `spl_autoload_register` in `config/app.php`
- **Hardcoded base path** — Router assumes `/cse485/BTTH2` prefix; update `Router.php` if deploying elsewhere
- **Database config** — hardcoded in `config/database.php` (localhost, root, no password, db: `onlinecourse`)
- **No tests exist** — no testing framework is set up
- **No CI/CD** — no GitHub Actions or pipelines configured
- **Keep it simple** — this is an educational project; avoid over-engineering or adding unnecessary abstractions
