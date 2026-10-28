# Exchange Skill Platform

A web platform where users trade skills with each other instead of paying
for services: offer what you know, learn what you need.

## Overview

Exchange Skill Platform connects people who want to learn with people who
can teach. Each user lists the skills they offer and the skills they want,
then finds matching partners and arranges exchanges.

## Features

- User registration and authentication
- Skill profiles: skills offered and skills wanted
- Browse and search skills and members
- Exchange requests between users (send, accept, decline)
- Messaging between matched users
- Ratings and reviews after an exchange

## Tech Stack

| Layer    | Technologies                            |
|----------|-----------------------------------------|
| Backend  | Laravel (PHP), Eloquent ORM, migrations |
| Frontend | Blade, JavaScript, Tailwind CSS, Vite   |
| Database | MySQL                                   |
| Testing  | PHPUnit                                 |

## Getting Started

### Prerequisites

- PHP 8.1+ and Composer
- Node.js and npm
- MySQL (or another database supported by Laravel)

### Installation

    git clone https://github.com/cuervo0102/ExchangeSkillPlatForm.git
    cd ExchangeSkillPlatForm
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate

Set your database credentials in `.env`, then run:

    php artisan migrate
    npm run dev
    php artisan serve

The app is available at http://localhost:8000.

### Running Tests

    php artisan test

## Project Structure

    app/         Models, controllers, business logic
    routes/      Web and API routes
    database/    Migrations, seeders, factories
    resources/   Views, CSS, JavaScript
    tests/       PHPUnit tests

## Author

Siham - [GitHub](https://github.com/cuervo0102)
