# Railway Deployment Guide

This Laravel Alumni Portal application is configured for deployment on [Railway](https://railway.app).

## Configuration Files

- **railway.json** - Main Railway configuration
- **railway.toml** - Alternative TOML format configuration
- **nixpacks.toml** - Build and runtime configuration using Nixpacks

## Environment Variables

Railway automatically sets the `PORT` environment variable. Your application listens on `0.0.0.0:${PORT}` (typically port 3000 in Railway).

### Required Environment Variables

Set these in your Railway project dashboard:

```
APP_NAME=UCP Alumni Portal
APP_ENV=production
APP_DEBUG=false
APP_KEY=your-app-key-here
APP_URL=https://your-railway-app.up.railway.app

# Database
DB_CONNECTION=sqlite
# Or use PostgreSQL:
# DB_CONNECTION=postgres
# DB_HOST=your-db-host
# DB_DATABASE=alumni_portal
# DB_USERNAME=postgres
# DB_PASSWORD=your-password

# Session & Cache
SESSION_DRIVER=cookie
CACHE_STORE=array

# Mail
MAIL_MAILER=log
```

## Deployment Steps

1. **Connect Your GitHub Repository**
   - Go to [Railway Dashboard](https://railway.app/dashboard)
   - Click "New Project"
   - Select "GitHub Repo"
   - Authorize and select `UCP-Alumni` repository

2. **Set Environment Variables**
   - Click on your Railway project
   - Go to "Variables"
   - Add all required environment variables from above
   - For `APP_KEY`, generate one: `php artisan key:generate` and copy the result

3. **Deploy**
   - Railway will automatically detect and build using `nixpacks.toml`
   - Your app will start on the assigned Railway port
   - Check logs in the Railway dashboard if issues occur

## Available Ports

- **Railway assigns dynamically** via `$PORT` environment variable
- **Default fallback:** 8000 (if `$PORT` is not set)
- **Application listening address:** `0.0.0.0:${PORT:-8000}`

## Database Migrations

Migrations run automatically during the build process via `nixpacks.toml`:

```bash
php artisan migrate --force
```

If you need to run migrations manually after deployment:

```bash
railway run php artisan migrate --force
```

## Build Output

The build process performs:
- PHP 8.2 environment setup
- Composer dependency installation
- Laravel configuration caching
- Route caching
- View caching
- Database migrations

## Troubleshooting

### App not starting
- Check Railway logs for errors
- Verify all required environment variables are set
- Ensure `APP_KEY` is properly configured

### Database connection errors
- Verify database credentials in environment variables
- For SQLite, ensure the file path is writable
- For PostgreSQL, ensure the database exists

### Port binding errors
- Railway should handle port assignment automatically
- Verify the app is listening on `0.0.0.0:${PORT}`

## Additional Resources

- [Railway Documentation](https://docs.railway.app)
- [Laravel Deployment](https://laravel.com/docs/deployment)
- [Nixpacks Documentation](https://nixpacks.com)
