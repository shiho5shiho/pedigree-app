FROM php:8.3-cli

# 必要な拡張機能をインストール
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring zip gd \
    && rm -rf /var/lib/apt/lists/*

# Composerをインストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# 依存関係を先にコピーしてキャッシュを効かせる
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --prefer-dist

# アプリ本体をコピー
COPY . .

RUN composer dump-autoload --optimize

# 起動スクリプトに実行権限
COPY start.sh /app/start.sh
RUN chmod +x /app/start.sh

EXPOSE 8080

CMD ["/app/start.sh"]