

# 🎓 Educational Platform


</div>

---

## 📋 Table of Contents

- [Overview](#-overview)
- [Key Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [Architecture](#-architecture)
- [Getting Started](#-getting-started)
- [Environment Configuration](#-environment-configuration)
- [Database Setup](#-database-setup)
- [Running the Application](#-running-the-application)
- [API & Routes](#-api--routes)
- [Testing](#-testing)
- [Contributing](#-contributing)
- [License](#-license)

---

## 🌟 Overview

**Educational Platform** is a robust, scalable web application designed to bridge students and instructors in a seamless online learning environment. Built on **Laravel** — one of the most expressive PHP frameworks — the platform follows the **MVC architecture** and emphasizes clean code, modular design, and developer-friendly conventions.

Whether you are a student seeking courses, an instructor publishing content, or an administrator managing the ecosystem, this platform provides tailored dashboards and permission-controlled workflows for each role.

---

## ✨ Key Features

### 👩‍🎓 Student Experience
- Browse and search the course catalog
- Enroll in courses with a single click
- Track learning progress per course
- Access video lessons, documents, and resources
- Submit assignments and view grades
- Personal dashboard with enrolled courses overview

### 👨‍🏫 Instructor Tools
- Create and publish courses with rich content
- Organize content into structured sections and lessons
- Manage enrollment requests and student lists
- Grade assignments and provide feedback
- View enrollment analytics per course

### 🛡️ Admin Panel
- Full CRUD control over users, courses, and categories
- Assign and revoke roles and permissions
- Monitor platform activity and usage statistics
- Manage reported content and user disputes

### 🔐 Authentication & Authorization
- Secure registration, login, and password reset
- Role-Based Access Control (RBAC) — Admin, Instructor, Student
- Protected routes with middleware guards
- Session management and "remember me" functionality

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| **Backend Framework** | Laravel 11 (PHP 8.x) |
| **Frontend Bundler** | Vite 5 |
| **Templating Engine** | Blade |
| **Styling** | CSS / Tailwind CSS |
| **JavaScript** | Vanilla JS / Alpine.js |
| **Database** | MySQL 8 |
| **ORM** | Eloquent |
| **Testing** | PHPUnit |
| **Package Manager** | Composer + npm |

---

## 🏗️ Architecture

The application follows Laravel's **MVC (Model-View-Controller)** pattern with a clean separation of concerns:

```
Request  →  Router  →  Middleware  →  Controller  →  Service / Model  →  View / JSON
```

Key architectural decisions:
- **Service Layer** — Business logic is extracted from controllers into dedicated service classes, keeping controllers thin and readable.
- **Form Requests** — Input validation is handled through dedicated `FormRequest` classes for each operation.
- **Eloquent Relationships** — Models are interconnected via Laravel's expressive ORM (hasMany, belongsTo, belongsToMany, etc.).
- **Resource Collections** — API responses are transformed using Laravel API Resources for consistent JSON output.
- **Database Migrations & Seeders** — Schema management is fully version-controlled and reproducible.

---

## 🚀 Getting Started

### Prerequisites

Make sure the following are installed on your system:

| Tool | Minimum Version |
|---|---|
| PHP | `>= 8.1` |
| Composer | `>= 2.x` |
| Node.js | `>= 18.x` |
| npm | `>= 9.x` |
| MySQL | `>= 8.0` |

### Installation

**1. Clone the repository**
```bash
git clone https://github.com/MohammedAlmostfa/Educational_platform.git
cd Educational_platform
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Install Node.js dependencies**
```bash
npm install
```

**4. Copy the environment file**
```bash
cp .env.example .env
```

**5. Generate the application key**
```bash
php artisan key:generate
```

---

## ⚙️ Environment Configuration

Open `.env` and update the following variables:

```env
APP_NAME="Educational Platform"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=educational_platform
DB_USERNAME=root
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
```

---

## 🗄️ Database Setup

**1. Create the database**
```sql
CREATE DATABASE educational_platform;
```

**2. Run migrations**
```bash
php artisan migrate
```

**3. Seed the database with sample data**
```bash
php artisan db:seed
```

Or run both at once:
```bash
php artisan migrate:fresh --seed
```

---

## ▶️ Running the Application

**Start the Laravel development server**
```bash
php artisan serve
```

**Compile and watch frontend assets**
```bash
npm run dev
```

**Build for production**
```bash
npm run build
```

The application will be available at: **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 🗺️ API & Routes

### Web Routes (Session Auth)

| Method | URI | Description |
|---|---|---|
| `GET` | `/` | Landing / home page |
| `GET` | `/register` | Registration form |
| `POST` | `/register` | Create new account |
| `GET` | `/login` | Login form |
| `POST` | `/login` | Authenticate user |
| `POST` | `/logout` | End session |
| `GET` | `/dashboard` | User dashboard |
| `GET` | `/courses` | Browse all courses |
| `GET` | `/courses/{id}` | Course detail page |
| `POST` | `/courses/{id}/enroll` | Enroll in a course |

### Admin Routes

| Method | URI | Description |
|---|---|---|
| `GET` | `/admin/users` | Manage users |
| `GET` | `/admin/courses` | Manage all courses |
| `GET` | `/admin/categories` | Manage categories |

---

## 🧪 Testing

The project includes a PHPUnit test suite with both **Feature** and **Unit** tests.

**Run all tests:**
```bash
php artisan test
```

**Run a specific test file:**
```bash
php artisan test --filter=CourseTest
```

**Run with coverage report:**
```bash
php artisan test --coverage
```

---

## 🤝 Contributing

Contributions are welcome! Here's how to get started:

1. Fork the repository
2. Create a new feature branch: `git checkout -b feature/your-feature-name`
3. Make your changes and commit: `git commit -m "feat: add your feature"`
4. Push to your fork: `git push origin feature/your-feature-name`
5. Open a Pull Request against `main`

Please ensure all tests pass before submitting a PR.

---

## 📄 License

This project is open-source and available under the **[MIT License](https://opensource.org/licenses/MIT)**.

---

<div align="center">

Built with ❤️ by [Mohammed Almostfa](https://github.com/MohammedAlmostfa)

</div>
