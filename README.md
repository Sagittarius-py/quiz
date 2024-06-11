# Quiz Application

A quiz application built with PHP and Blade templates.

## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
- [Configuration](#configuration)
- [Testing](#testing)
- [Contributing](#contributing)

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/Sagittarius-py/quiz.git
    cd quiz
    ```

2. Install dependencies:
    ```bash
    composer install
    npm install
    ```

3. Set up the environment variables:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Run the database migrations:
    ```bash
    php artisan migrate
    ```

5. Serve the application:
    ```bash
    php artisan serve
    ```

## Usage

1. Open your browser and go to `http://localhost:8000`.

2. Follow the on-screen instructions to take the quiz.

## Configuration

Modify the `.env` file to configure your database and other settings.

## Testing

Run the tests using PHPUnit:
```bash
php artisan test
