#!/bin/sh
php artisan key:generate
php artisan migrate --force
php artisan db:seed --force
php artisan serve --port=3000 --host=0.0.0.0