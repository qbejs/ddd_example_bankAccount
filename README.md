# Bank Account App

Author: [Jakub Skowron](jakub@skowron.dev)

Aplikacja PHP oparta na Domain-Driven Design (DDD) dla systemu konta bankowego i płatności.

## Wymagania

- PHP 8.2
- Docker
- Composer

## Instalacja i uruchamianie testów z Docker

1. Skopiuj repozytorium na lokalną maszynę:
    ```bash
    git clone <URL-do-repozytorium>
    cd <folder-repozytorium>
    ```

2. Uruchom instalację zależności oraz budowanie projektu w kontenerze Docker:
    ```bash
    make install
    ```

3. Aby uruchomić testy jednostkowe, wykonaj:
    ```bash
    make test
    ```
   
4. Aby zatrzymać i usunąć kontenery Docker, wykonaj:
    ```bash
    make clean
    ```

## Uruchamianie lokalne bez Docker

1. Zainstaluj zależności przy pomocy Composera:
    ```bash
    composer install
    ```

2. Uruchom testy jednostkowe lokalnie:
    ```bash
    ./vendor/bin/phpunit tests
    ```

## Struktura projektu

- **Domain** – Logika domenowa, agregaty, encje, wartości obiektów (Value Objects), polityki.
- **Application** – Przypadki użycia, serwisy aplikacyjne.
- **Infrastructure** – Implementacje repozytoriów, infrastruktura techniczna.
- **Tests** – Testy jednostkowe.

## Testowanie

Testy jednostkowe można uruchomić w Dockerze, używając:

```bash
make test