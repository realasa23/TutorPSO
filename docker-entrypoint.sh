#!/bin/bash
set -e

echo "==> Waiting for database..."
until php -r "
    \$pdo = new PDO(
        'pgsql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE'),
        getenv('DB_USERNAME'),
        getenv('DB_PASSWORD')
    );
" 2>/dev/null; do
  echo "   DB not ready, retrying in 3s..."
  sleep 3
done

echo "==> Running migrations..."
php artisan migrate --force

echo "==> Caching config & routes..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Starting Apache..."
exec "$@"