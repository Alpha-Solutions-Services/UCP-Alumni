# Railway Deployment Guide

This Laravel Alumni Portal application is configured for deployment on [Railway](https://railway.app).

## Configuration Files

- **railway.json** - Main Railway configuration
- **railway.toml** - Alternative TOML format configuration
- **nixpacks.toml** - Build and runtime configuration using Nixpacks

## Environment Variables

Railway automatically sets the `PORT` environment variable. Your application listens on `0.0.0.0:${PORT}` (typically port 8080 on Railway using `php artisan serve`).

### Required Environment Variables

Set these in your Railway project dashboard:

```env
APP_NAME="UCP Alumni Portal"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_HERE
APP_URL=https://your-railway-domain.railway.app

# Database (Use MySQL for production)
DB_CONNECTION=mysql
DB_HOST=${{MYSQLHOST}}
DB_PORT=${{MYSQLPORT}}
DB_DATABASE=${{MYSQLDATABASE}}
DB_USERNAME=${{MYSQLUSER}}
DB_PASSWORD=${{MYSQLPASSWORD}}

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=debug

# Mail
MAIL_MAILER=log
```

### How to Get APP_KEY

Generate the APP_KEY locally and copy it:

```bash
php artisan key:generate --show
```

Copy the output (including `base64:` prefix) and set it in Railway.

### Adding MySQL Database

1. Go to your Railway project
2. Click "New" → "Database" → "Add MySQL"
3. Railway will automatically set the MySQL environment variables (`MYSQLHOST`, `MYSQLPORT`, etc.)
4. The variables prefixed with `${{MYSQL*}}` will be automatically populated

## Deployment Steps

1. **Create Railway Project**
   - Go to [Railway Dashboard](https://railway.app/dashboard)
   - Click "New Project"
   - Select "GitHub Repo"
   - Authorize and select `UCP-Alumni` repository

2. **Add MySQL Database**
   - In your Railway project, click "New" → "Database" → "Add MySQL"
   - Railway will automatically create MySQL and set environment variables

3. **Set Environment Variables**
   - Click on your Railway project
   - Go to "Variables"
   - Add all required environment variables from the [Environment Variables](#environment-variables) section above
   - For `APP_KEY`:
     ```bash
     # Generate locally
     php artisan key:generate --show
     # Copy the output and set as APP_KEY in Railway
     ```
   - For `APP_URL`: Use your Railway deployment domain (will be provided after first deployment)

4. **Deploy**
   - Railway will automatically detect and build using `nixpacks.toml`
   - Monitor the deployment progress in the "Deployments" tab
   - Your app will start on the assigned Railway port (typically 8080)

5. **Verify Deployment**
   - Check the "Logs" tab for any errors
   - Visit your Railway app URL to verify it's running
   - Login to admin panel at `/admin/login`
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

### "Application failed to respond" Error

This typically means the app isn't starting properly. Check:

1. **Check Railway Logs**
   - Go to your Railway project
   - Click on your service
   - Check "Logs" or "Deployments" tab for error messages

2. **Verify Environment Variables**
   - All required variables are set (especially `APP_KEY`, `DB_*`)
   - No typos in variable names
   - Database connection variables are correct

3. **Database Connection Issues**
   - Ensure MySQL database is added to your project
   - Verify `DB_HOST`, `DB_PORT`, `DB_USERNAME`, `DB_PASSWORD` are correct
   - MySQL service is running and accessible

4. **Storage Permissions**
   - The `nixpacks.toml` includes commands to set proper permissions
   - If issues persist, check logs for permission errors

### "Missing APP_KEY"
```bash
# Generate locally then copy to Railway
php artisan key:generate --show
# Copy the output and set APP_KEY in Railway variables
```

### "Connection refused" / Database Issues
- Verify MySQL is added to your Railway project
- Check that environment variable values are correct
- Test connection manually: `mysql -h $MYSQLHOST -u $MYSQLUSER -p$MYSQLPASSWORD $MYSQLDATABASE`

### "Port binding failed"
- Railway automatically assigns the `$PORT` variable
- The `nixpacks.toml` uses `${PORT:-8080}` as fallback
- Verify start command in `nixpacks.toml` uses correct port variable

### "Build fails with npm error"
- The `nixpacks.toml` includes Node.js 20 for asset compilation
- Ensure `npm run build` succeeds locally before pushing to Railway
- Check `package.json` for correct build script

### Manual Checks

If app is deployed but not responding, SSH into Railway and run:

```bash
railway shell
# Check if Laravel app can start
php artisan tinker
# Should show Psy Shell
exit()
# Check if migrations ran
php artisan migrate:status
```

## Additional Resources

- [Railway Documentation](https://docs.railway.app)
- [Laravel Deployment](https://laravel.com/docs/deployment)
- [Nixpacks Documentation](https://nixpacks.com)
