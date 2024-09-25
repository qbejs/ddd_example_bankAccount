# Wybieramy obraz PHP 8 z wbudowaną obsługą Composer i PHPUnit
FROM php:8.2-cli

# Instalacja narzędzi wymaganych do działania Composer
RUN apt-get update && apt-get install -y git unzip

# Instalacja Composera
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalacja zależności PHP
RUN docker-php-ext-install pcntl

# Ustawiamy katalog roboczy
WORKDIR /app

# Kopiujemy pliki projektu
COPY . /app

# Instalujemy zależności Composer
RUN composer install --no-interaction

# Ustawienie bash jako domyślnej komendy, aby kontener działał w tle
CMD ["bash"]