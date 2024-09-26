# Bank Account App

Author: [Jakub Skowron](jakub@skowron.dev)

A PHP application based on Domain-Driven Design (DDD) for a bank account and payment system.

## Requirements

- PHP 8.2
- Docker
- Composer

## Installation and Running Tests with Docker

1. Clone the repository to your local machine:
    ```bash
    git clone <repository-url>
    cd <repository-folder>
    ```

2. Build the Docker image and install dependencies:
    ```bash
    make install
    ```

3. To run unit tests, execute:
    ```bash
    make test
    ```

4. To stop and remove Docker containers after testing:
    ```bash
    make clean
    ```

## Running Locally Without Docker

1. Install dependencies using Composer:
    ```bash
    composer install
    ```

2. Run unit tests locally:
    ```bash
    ./vendor/bin/phpunit tests
    ```

## Project Structure

- **Domain** – Domain logic, aggregates, entities, value objects, and policies.
- **Application** – Use cases and application services.
- **Infrastructure** – Implementations of repositories and other technical infrastructure.
- **Tests** – Unit tests.

## Testing

You can run unit tests in Docker by following these steps:

1. Build the Docker image:
    ```bash
    make install
    ```

2. Run the container and execute the tests:
    ```bash
    make test
    ```

3. Stop and remove the container after tests:
    ```bash
    make clean
    ```

Alternatively, you can run the tests locally without Docker using:

```bash
./vendor/bin/phpunit tests