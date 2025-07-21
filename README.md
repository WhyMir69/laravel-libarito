<<<<<<< HEAD
# Laravel Livewire CRUD with Image Upload

A modern Laravel application using Livewire for reactive CRUD operations with image upload functionality.

## Features

### Product Management
- ✅ Create, Read, Update, Delete products
- ✅ Real-time search functionality
- ✅ Image upload with preview
- ✅ Grid layout with product cards
- ✅ Responsive design with Bootstrap 5
- ✅ Form validation with error handling
- ✅ File upload with progress indication

### Image Upload Features
- **File Types**: JPG, PNG, GIF supported
- **File Size**: Maximum 2MB per image
- **Storage**: Images stored in `storage/app/public/products/`
- **Preview**: Real-time image preview during upload
- **Validation**: Server-side image validation
- **Cleanup**: Automatic deletion of old images when updated

### Product Schema
- `product_code` (unique string)
- `name` (string)
- `quantity` (integer)
- `price` (decimal)
- `description` (text)
- `image` (string, nullable)

## Installation

1. Clone the repository
2. Install dependencies: `composer install`
3. Set up environment: `cp .env.example .env`
4. Generate application key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Seed database: `php artisan db:seed`
7. Create storage link: `php artisan storage:link`
8. Start server: `php artisan serve`

## Usage

1. **Adding Products**: Click "Add New Product" to open the modal form
2. **Image Upload**: Use the file input to select an image (max 2MB)
3. **Preview**: See uploaded image preview before saving
4. **Editing**: Click "Edit" on any product card to modify
5. **Deleting**: Click "Delete" to remove a product (images are automatically deleted)
6. **Searching**: Use the search bar to find products by name or code

## Technical Details

### Livewire Components
- `ProductManager`: Main component handling CRUD operations
- `WithFileUploads`: Trait for handling file uploads
- `WithPagination`: Trait for pagination

### File Storage
- Images stored in `storage/app/public/products/`
- Symbolic link created from `public/storage` to `storage/app/public`
- Automatic cleanup of old images on update/delete

### Validation
- Image files: Required format validation
- File size: Maximum 2MB
- Product code: Unique validation
- All fields: Required field validation

## Requirements

- PHP 8.2+
- Laravel 12+
- Livewire 3.6+
- SQLite (default) or MySQL

## File Structure

```
app/
├── Livewire/
│   └── ProductManager.php
├── Models/
│   └── Product.php
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── livewire/
│   │   └── product-manager.blade.php
│   └── products/
│       └── index.blade.php
storage/
└── app/
    └── public/
        └── products/          # Image uploads
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is open-sourced software licensed under the MIT license.
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Laravel CRUD Application with Authentication

This is a simple Laravel 11 CRUD application with user authentication system.

## Features

- **User Authentication**: Login and Registration system
- **Product Management**: Full CRUD operations for products
- **Post Management**: Full CRUD operations for posts
- **Session Management**: Database-based session storage
- **Responsive Design**: Bootstrap 5 with modern UI
- **Protected Routes**: Authentication middleware protecting all CRUD operations

## Authentication System

The application includes a complete authentication system with:

- **Registration**: Users can create new accounts with name, email, and password
- **Login**: Secure login with email and password
- **Logout**: Secure logout functionality
- **Session Management**: Persistent sessions using database storage
- **Protected Routes**: All CRUD operations require authentication
- **Guest Middleware**: Redirects authenticated users away from login/register pages

## Quick Start

1. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

2. **Environment Setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database Setup**:
   - Configure your database in `.env`
   - Run migrations:
   ```bash
   php artisan migrate
   ```

4. **Start Development Server**:
   ```bash
   php artisan serve
   ```

5. **Access the Application**:
   - Visit `http://localhost:8000`
   - You'll be redirected to the login page
   - Register a new account or login with existing credentials

## Authentication Routes

- `GET /login` - Login form
- `POST /login` - Handle login
- `GET /register` - Registration form  
- `POST /register` - Handle registration
- `POST /logout` - Handle logout

## Protected Routes

All the following routes require authentication:

- `GET /` - Redirects to products index
- `GET /products` - List all products
- `GET /products/create` - Create product form
- `POST /products` - Store new product
- `GET /products/{id}/edit` - Edit product form
- `PUT /products/{id}` - Update product
- `DELETE /products/{id}` - Delete product
- Similar CRUD routes for posts

## Technology Stack

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5, Blade templates
- **Database**: MySQL (configurable)
- **Session Storage**: Database
- **Authentication**: Laravel's built-in authentication system
>>>>>>> 4db59ba1938de0e418ef7c0900ff3dbdfa47e0ec
