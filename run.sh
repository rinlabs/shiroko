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
fi
php artisan key:generate --no-interaction --force
php artisan storage:link
touch public/storage/bg.css
touch database/database.sqlite
if [ -s database/database.sqlite ]; then
        touch database/database.sqlite
else
        # The file is empty.
        php artisan migrate:fresh --seed
fi
php artisan serve --host=0.0.0.0 --port=8000 --env=production
