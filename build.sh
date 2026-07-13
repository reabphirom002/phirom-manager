#!/usr/bin/env bash
# ចេញពី Script បើមាន Error
set -o errexit

# ១. ដំឡើង PHP Dependencies
composer install --no-dev --no-interaction --prefer-dist

# ២. ដំឡើង Node Dependencies និង Build CSS/JS (Tailwind)
npm install
npm run build

# ៣. សម្អាត និងបង្កើត Cache ឡើងវិញសម្រាប់ល្បឿនលឿន
php artisan config:cache
php artisan route:cache
php artisan view:cache