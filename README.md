# Laravel API Project

## Overview

This Laravel project is an API-based application that demonstrates various features commonly used in web development. It includes:

-   ORM (Object-Relational Mapping).
-   Seeders.
-   Validation .
-   Authentication using API with JSON Web Tokens (JWT).
-   CRUD operations for Posts and Comments through API endpoints.

## Setup Instructions

### Prerequisites

-   Ensure you have [Composer](https://getcomposer.org/) installed.
-   Configure a database and update the `.env` file with your database credentials.
-   Create a JWT secret key by running `php artisan jwt:secret`.

### Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/yourusername/laravel-api-project.git
    cd laravel-api-project
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Run migrations and seeders to set up the database with sample data:

    ```bash
    php artisan migrate --seed
    ```

4. Start the development server:

    ```bash
    php artisan serve
    ```

The API will be accessible at `http://localhost:8000`.
