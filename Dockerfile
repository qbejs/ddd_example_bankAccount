FROM php:8.2-cli

RUN apt-get update && apt-get install -y git unzip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pcntl

WORKDIR /app
COPY . /app

RUN composer install --no-interaction

CMD ["bash"]