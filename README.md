# Projectsity on Laravel

An online store with an Armenian-language interface, built with Laravel.

I built this project while studying Full-Stack Web Development at DiGi School in Yerevan.

## Features

- Product catalog with filters by category, price and availability
- Discounts and stock information on product cards
- Shopping cart and wishlist
- User registration, login, logout and a personal profile page
- Roles: the admin area for managing products (create, edit, delete, image upload) is available to admins only
- News, About and Contact pages
- Interface in Armenian

## Tech stack

- **Backend:** PHP, Laravel, SQLite
- **Frontend:** Blade templates, HTML5, CSS3
- **Tools:** Git, GitHub, VS Code

## How to run locally

1. Install PHP and Composer.
2. Clone the repository and install dependencies: `composer install`
3. Copy `.env.example` to `.env` and generate the app key: `php artisan key:generate`
4. Create an empty file `database/database.sqlite`, then run: `php artisan migrate`
5. Create the storage link for uploaded images: `php artisan storage:link`
6. Start the server with `php artisan serve` and open `http://127.0.0.1:8000`

## Notes

Uploaded product images and the SQLite database file are not stored in the repository, so a fresh copy starts without products. Categories are stored in the `categories` table, and products can be added through the admin area.

## Author

Daniel Babayan, junior PHP developer from Yerevan, Armenia.

GitHub: [danielbabayan55-wq](https://github.com/danielbabayan55-wq)
