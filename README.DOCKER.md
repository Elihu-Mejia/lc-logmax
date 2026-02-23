# Docker Setup for Laravel + Inertia JS

This project includes Docker configuration for both local development and production-like environments.

## Quick Start

1. **Copy the environment file:**
   ```bash
   cp .env.docker .env
   ```

2. **Generate Laravel key:**
   ```bash
   docker-compose run --rm app php artisan key:generate
   ```

3. **Run migrations:**
   ```bash
   docker-compose run --rm app php artisan migrate
   ```

4. **Start the application:**
   ```bash
   docker-compose up -d
   ```

5. **Access the application:**
   - Frontend: `http://localhost:8000`

## Available Services

- **app**: PHP-FPM application server
- **db**: SQLite database (or MySQL if configured)
- **redis** (optional): Caching and session storage
- **nginx** (optional): Reverse proxy for production setup

## Common Commands

### Development
```bash
# Start services
docker-compose up -d

# Stop services
docker-compose down

# View logs
docker-compose logs -f app

# Access container shell
docker-compose exec app sh

# Run artisan commands
docker-compose exec app php artisan migrate
docker-compose exec app php artisan tinker

# Build assets
docker-compose exec app npm run dev
docker-compose exec app npm run build
```

### Testing
```bash
# Run tests
docker-compose exec app php artisan test

# Run with coverage
docker-compose exec app php artisan test --coverage
```

## Database Configuration

### SQLite (Default)
The default configuration uses SQLite. Database file is at `database/database.sqlite`.

### MySQL
To use MySQL instead:

1. Update `docker-compose.yml` - uncomment the MySQL service
2. Update `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=laravel
   DB_PASSWORD=secret
   ```

## Production with Nginx

To enable Nginx as a reverse proxy:

1. Uncomment the `nginx` service in `docker-compose.yml`
2. Update the `app` service port to `9000`
3. Rebuild and restart:
   ```bash
   docker-compose down
   docker-compose up -d --build
   ```

## Storage & Cache

- Application logs: `storage/logs/`
- Cache: `storage/framework/cache/`
- Sessions: `storage/framework/sessions/`
- Views: `storage/framework/views/`

These are persisted on your host machine.

## Node & Asset Building

Assets are built during the Docker build process. For development changes:

```bash
# Hot reload development
docker-compose exec app npm run dev

# Production build
docker-compose exec app npm run build
```

## Troubleshooting

### Permission Denied Errors
Ensure proper permissions in your host environment:
```bash
chmod -R 755 storage bootstrap/cache
```

### Port Already in Use
Change the port in `docker-compose.yml`:
```yaml
ports:
  - "8001:8000"  # Use 8001 instead
```

### Database Connection Error
Ensure the database exists for SQLite:
```bash
docker-compose exec app touch database/database.sqlite
```

## Environment Variables

Copy `.env.docker` to `.env` and customize as needed. Key variables:

- `APP_KEY`: Generate with `php artisan key:generate`
- `APP_DEBUG`: Set to `false` in production
- `DB_CONNECTION`: Database driver (sqlite, mysql, pgsql)
- `CACHE_DRIVER`: Cache driver (file, redis)
- `QUEUE_CONNECTION`: Queue driver (sync, redis, database)

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Docker Documentation](https://docs.docker.com)
- [Inertia JS Documentation](https://inertiajs.com)
