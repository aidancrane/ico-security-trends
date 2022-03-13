#!/bin/bash
# Install composer dependencies
#composer install
echo "Waiting on Database to startup before re-seeding database."
echo "If you see Error 502 Bad Gateway please wait for the database to seed first it can take a few seconds."
# # Wait for DB to be up
/usr/local/bin/wait-for-it.sh db:3306 -t 0 --strict -- php artisan key:generate && php artisan migrate:refresh --seed
#
echo "Database has been completely re-seeded from source."
echo "Running all Mix Tasks."

npm run dev

php-fpm
