# Laravel Product Management System

A Laravel project to manage products and product categories, featuring:
- Database migrations for `products` and `product_categories`.
- Models with relationships.
- Artisan CLI command to mark old products in the "Socks" category as inactive.

## Requirements
- PHP >= 8.0
- Composer
- Laravel 10.x
- SQLite, MySQL, or other supported databases

## Installation
1. Clone the repository:
- git clone https://github.com/VishalBabuBaraiya/laravel-demo.git
- cd laravel-product-management
- composer update
- php artisan products:deactivate-old-socks
