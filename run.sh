#!/bin/sh

# Run setup only if .env file doesn't exist.
if [ ! -e .env.production ]
then
cat > .env.production << EOF
APP_NAME=shiroko
APP_DEBUG=false
APP_KEY=

DB_CONNECTION=sqlite
APP_URL=${APP_URL}
EOF
php artisan key:generate --no-interaction --force
php artisan storage:link
fi

#php artisan migrate:fresh --seed
php artisan serve --host=0.0.0.0 --port=8000 --env=production
