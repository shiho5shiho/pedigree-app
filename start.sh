#!/bin/bash
set -e

# キャッシュのクリア&再構築
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# マイグレーション実行(本番も含めて自動反映)
php artisan migrate --force

# Railwayが割り当てるPORT変数でリッスン
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}