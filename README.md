# Aplikasi CRUD Sederhana dengan FE Vue-JS dan BE Laravel

This template should help get you started developing with Vue 3 in Vite and Laravel.

## Prerequisites

Before you start, ensure you have the following installed:

- PHP >= 8.3
- Composer
- composer require tymon/jwt-auth (BE:Laravel)
- Node.JS 22
- npm

## Steps to Install

1. **Clone the Repository**

   Clone the repository to your local machine using the following command:

   ```bash
   git clone https://github.com/Ahmadsani31/Aplikasi-CRUD-Sederhana-Vue-Laravel.git
   ```

   ## Setup BE-Laravel

   ```bash
   cd be-laravel
   ```

   ```bash
   composer update
   composer install
   ```

   ```bash
   cp .env.example .env
   ```

   ```bash
   php artisan key:generate
   ```

   change your_database_name, your_database_user, your_database_password with what you have.

   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```

   ```bash
   php artisan migrate
   ```

   dont forget generate secret key JWT

   ```bash
   php artisan jwt:secret
   ```

   ```bash
   php artisan serve
   ```

   ## Setup FE-Vue JS

   ```bash
   npm install
   ```

   Compile and Hot-Reload for Development

   ```sh
   npm run dev
   ```

   Type-Check, Compile and Minify for Production

   ```sh
   npm run build
   ```

   ### Note!
   You can change the rest api URL in src/config/index.ts

## Page

### Page login

![Login](https://raw.githubusercontent.com/Ahmadsani31/Aplikasi-CRUD-Sederhana-Vue-Laravel/refs/heads/main/fe-vue/public/assets/images/github/login.png)

### Page Register

![Register](https://raw.githubusercontent.com/Ahmadsani31/Aplikasi-CRUD-Sederhana-Vue-Laravel/refs/heads/main/fe-vue/public/assets/images/github/register.png)

### Page Dashboard

![Register](https://raw.githubusercontent.com/Ahmadsani31/Aplikasi-CRUD-Sederhana-Vue-Laravel/refs/heads/main/fe-vue/public/assets/images/github/dashboard.png)

### Page Mahasiswa

![Register](https://raw.githubusercontent.com/Ahmadsani31/Aplikasi-CRUD-Sederhana-Vue-Laravel/refs/heads/main/fe-vue/public/assets/images/github/mhsw.png)

### Page Mahasiswa ADD

![Register](https://raw.githubusercontent.com/Ahmadsani31/Aplikasi-CRUD-Sederhana-Vue-Laravel/refs/heads/main/fe-vue/public/assets/images/github/mhsw-add.png)
