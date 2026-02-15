# Deploying Laravel to Vercel

This guide explains how to deploy the UCP Alumni Portal to Vercel.

## Why Vercel?
Vercel is recommended over Netlify for Laravel because it has better support for PHP through the `vercel-php` runtime.

## Prerequisites
1. A Vercel account.
2. The Vercel CLI installed (`npm install -g vercel`) or your project pushed to GitHub/GitLab/Bitbucket.
3. A remote MySQL database (e.g., PlanetScale, Supabase, or AWS RDS). **Vercel does not provide a built-in database.**

## Deployment Steps

### 1. Prepare Environment Variables
In your Vercel Project Settings, add the following Environment Variables:

| Variable | Recommended Value |
|----------|-------------------|
| `APP_NAME` | `UCP Alumni Portal` |
| `APP_ENV` | `production` |
| `APP_KEY` | `base64:your_generated_key` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://your-project.vercel.app` |
| `DB_CONNECTION` | `mysql` |
| `DB_HOST` | `your-remote-db-host` |
| `DB_PORT` | `3306` |
| `DB_DATABASE` | `your_db_name` |
| `DB_USERNAME` | `your_db_user` |
| `DB_PASSWORD` | `your_db_password` |
| `CACHE_STORE` | `array` |
| `SESSION_DRIVER` | `cookie` |
| `LOG_CHANNEL` | `stderr` |
| `VIEW_COMPILED_PATH` | `/tmp` |

### 2. Deployment via GitHub (Recommended)
1. Push your code to a GitHub repository.
2. Import the repository in Vercel.
3. Vercel will automatically detect the configuration in `vercel.json` and deploy.

### 3. Deployment via CLI
Run the following command in the `Laravel/alumni-portal` directory:
```bash
vercel
```

## Important Notes for Serverless Laravel

### Read-Only Filesystem
Vercel's filesystem is read-only. We have configured the following to use `/tmp`:
- Compiled Views: `/tmp`
- Config/Route Cache: `/tmp`

### Database Migrations
You cannot run `php artisan migrate` directly on Vercel's build step easily.
**Recommendation:** Run migrations from your local machine pointing to the production database:
```bash
php artisan migrate --force
```

### Static Assets
Vercel handles the `public` folder for static assets (CSS, JS, Images). If you use Vite, make sure to run `npm run build` before deploying, or configure Vercel's build command to:
```bash
npm install && npm run build && composer install --no-dev
```
However, since `vercel-php` handles the PHP part, it's often easier to just push the built assets or use a GitHub Action.

### Storage Link
The `storage/app/public` folder won't work for uploads on Vercel because the filesystem is ephemeral. Use **AWS S3** or **Cloudinary** for file uploads in production.
Update `FILESYSTEM_DISK` to `s3` in your environment variables.
