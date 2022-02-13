#!/bin/bash
# Install composer dependencies
#composer install
echo "Waiting on Database to startup before re-seeding database."
# # Wait for DB to be up
/usr/local/bin/wait-for-it.sh db:3306 -t 0 --strict -- php artisan key:generate && php artisan migrate:refresh --seed
#
echo "Database has been completely re-seeded from source."

php-fpm
