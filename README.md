# UCP Alumni Portal

A comprehensive Laravel-based web application for managing and connecting university alumni. This platform allows alumni to register, view profiles, and network with fellow graduates.

## 📋 Table of Contents

- [Features](#features)
- [Project Structure](#project-structure)
- [Installation](#installation)
- [Configuration](#configuration)
- [Deployment](#deployment)
- [Documentation](#documentation)

## ✨ Features

- **Alumni Registration** - Easy registration form for alumni to join the portal
- **Alumni Directory** - Browse and search alumni profiles
- **Profile Management** - View detailed alumni profiles with professional information
- **Admin Dashboard** - Comprehensive admin panel for managing alumni data
- **Admin Authentication** - Secure login system for administrators
- **Statistics Dashboard** - View alumni statistics and employment data
- **Responsive Design** - Mobile-friendly interface using Tailwind CSS

## 📁 Project Structure

```
UCP-Alumni/
├── app/                              # Application code
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AlumniController.php          # Alumni public routes
│   │       └── Admin/
│   │           ├── AlumniController.php      # Admin alumni management
│   │           └── AuthController.php        # Admin authentication
│   ├── Models/
│   │   ├── Alumni.php                        # Alumni model
│   │   └── User.php                          # User model (admin)
│   └── Providers/
│       └── AppServiceProvider.php
│
├── bootstrap/
│   ├── app.php                       # Application bootstrap
│   ├── providers.php                 # Service providers
│   └── cache/                        # Cached configuration
│
├── config/                           # Configuration files
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── services.php
│   └── session.php
│
├── database/
│   ├── factories/
│   │   └── UserFactory.php           # User factory for seeding
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   └── 2024_01_01_000001_create_alumni_table.php
│   └── seeders/
│       ├── AdminUserSeeder.php       # Admin user seeding
│       └── DatabaseSeeder.php
│
├── public/                           # Web root
│   ├── index.php                     # Entry point
│   ├── robots.txt
│   ├── favicon.ico
│   ├── images/
│   │   └── ucp-logo.png              # UCP logo
│   ├── build/                        # Compiled assets
│   │   ├── manifest.json
│   │   └── assets/
│   └── storage/                      # User uploads link
│
├── resources/
│   ├── css/
│   │   └── app.css                   # Main stylesheet
│   ├── js/
│   │   ├── app.js                    # Main JavaScript
│   │   └── bootstrap.js              # Bootstrap script
│   └── views/                        # Blade templates
│       ├── home.blade.php            # Landing page
│       ├── welcome.blade.php         # Default welcome
│       ├── admin/
│       │   ├── dashboard.blade.php   # Admin dashboard
│       │   ├── login.blade.php       # Admin login
│       │   └── alumni/
│       │       ├── index.blade.php   # Alumni list
│       │       ├── create.blade.php  # Add alumni form
│       │       ├── edit.blade.php    # Edit alumni form
│       │       └── form.blade.php    # Shared form component
│       ├── alumni/
│       │   ├── index.blade.php       # Alumni directory
│       │   ├── show.blade.php        # Alumni profile
│       │   └── register.blade.php    # Registration form
│       └── layouts/
│           ├── app.blade.php         # Main layout
│           └── admin.blade.php       # Admin layout
│
├── routes/
│   ├── web.php                       # Web routes
│   └── console.php                   # Artisan commands
│
├── storage/
│   ├── app/
│   │   ├── private/
│   │   └── public/                   # Public file storage
│   ├── framework/
│   │   ├── cache/
│   │   ├── sessions/
│   │   ├── testing/
│   │   └── views/
│   └── logs/                         # Application logs
│
├── tests/
│   ├── TestCase.php
│   ├── Feature/
│   │   └── ExampleTest.php
│   └── Unit/
│       └── ExampleTest.php
│
├── vendor/                           # Composer dependencies
│
├── .env.example                      # Environment variables template
├── .gitignore                        # Git ignore file
├── artisan                           # Laravel CLI
├── composer.json                     # PHP dependencies
├── composer.lock                     # Locked dependencies
├── package.json                      # Node dependencies
├── package-lock.json                 # Node locked dependencies
├── phpunit.xml                       # PHPUnit configuration
├── vite.config.js                    # Vite build configuration
├── railway.json                      # Railway deployment config
├── railway.toml                      # Railway TOML config
├── nixpacks.toml                     # Nixpacks build config
├── RAILWAY_DEPLOYMENT.md             # Railway deployment guide
└── README.md                         # This file
```

## 🚀 Installation

### Prerequisites

- PHP 8.2+
- Composer
- Node.js 16+
- npm or yarn

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/Alpha-Solutions-Services/UCP-Alumni.git
   cd UCP-Alumni
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Set up database**
   ```bash
   php artisan migrate
   php artisan db:seed --class=AdminUserSeeder
   ```

6. **Build assets**
   ```bash
   npm run dev      # Development
   npm run build    # Production
   ```

7. **Serve application**
   ```bash
   php artisan serve
   ```

   Application will be available at `http://localhost:8000`

## ⚙️ Configuration

### Environment Variables

Create a `.env` file based on `.env.example`:

```env
APP_NAME="UCP Alumni Portal"
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:your-key-here
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# DB_DATABASE=database.sqlite

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

MAIL_MAILER=log
```

### Database

The application uses SQLite by default (file-based database). To use MySQL/PostgreSQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alumni_portal
DB_USERNAME=root
DB_PASSWORD=password
```

### Admin Access

Default admin credentials (after seeding):
- **Email**: admin@example.com
- **Password**: password

⚠️ Change these credentials in production!

## 📦 Deployment

### Railway Deployment

The project is configured for [Railway](https://railway.app) deployment.

1. **Connect GitHub Repository**
   - Go to Railway Dashboard
   - Create new project
   - Select GitHub repository

2. **Set Environment Variables**
   - Add all required variables from `.env.example`
   - Set `APP_KEY` (generate: `php artisan key:generate`)

3. **Deploy**
   - Railway automatically builds and deploys using nixpacks

See [RAILWAY_DEPLOYMENT.md](RAILWAY_DEPLOYMENT.md) for detailed instructions.

## 📚 Documentation

- [Railway Deployment Guide](RAILWAY_DEPLOYMENT.md)
- [Laravel Documentation](https://laravel.com/docs)

## 🗄️ Database Schema

### Users Table
- id (Primary Key)
- name
- email
- password
- created_at/updated_at

### Alumni Table
- id (Primary Key)
- full_name
- email
- contact_number
- whatsapp_number
- department
- year_passed
- current_job
- company_name
- job_time_duration
- profile_picture
- review
- created_at/updated_at

## 🔌 API Routes

### Public Routes
- `GET /` - Home page
- `GET /alumni` - Alumni directory
- `GET /alumni/{id}` - Alumni profile
- `GET /register` - Registration form
- `POST /register` - Submit registration
- `GET /admin/login` - Admin login

### Admin Routes (Protected)
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/alumni` - Alumni management list
- `POST /admin/alumni` - Create alumni
- `GET /admin/alumni/{id}/edit` - Edit form
- `PUT /admin/alumni/{id}` - Update alumni
- `DELETE /admin/alumni/{id}` - Delete alumni
- `POST /admin/logout` - Admin logout

## 🛠️ Key Technologies

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, Tailwind CSS
- **Database**: SQLite / MySQL / PostgreSQL
- **Build Tool**: Vite
- **Deployment**: Railway
- **Package Manager**: Composer (PHP), NPM (JavaScript)

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 👥 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📧 Support

For support, email: support@example.com

## 🔗 Links

- [Repository](https://github.com/Alpha-Solutions-Services/UCP-Alumni)
- [Issues](https://github.com/Alpha-Solutions-Services/UCP-Alumni/issues)
- [Discussions](https://github.com/Alpha-Solutions-Services/UCP-Alumni/discussions)

---

**Last Updated**: February 15, 2026
