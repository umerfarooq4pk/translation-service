# Translation Management Service

## Description

This service provides API endpoints for managing translations with support for multiple locales and tags. It is designed for scalability and performance.

## Setup Instructions

1. Clone the repository.
2. Run `composer install` to install dependencies.
3. Configure the `.env` file with your database and other settings.
4. Run migrations and seed the database:
   ```
   php artisan migrate --seed
   ```
5. Serve the application:
   ```
   php artisan serve
   ```
6. Use Postman or any API client to interact with the endpoints.