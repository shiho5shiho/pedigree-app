#!/bin/bash
set -e

php artisan config:clear
php artisan cache:clear

# マイグレーション実行(本番も含めて自動反映)
php artisan migrate --force

# Railwayが割り当てるPORT変数でリッスン
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}