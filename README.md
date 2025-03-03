# User Management System

## Overview
This is a simple **User Management System** built with Laravel 11. It provides essential features for managing users, including authentication, registration, and user role management.

## Features
- **Admin Dashboard**
  - Manage users (Create, Read, Update, Delete)
  - Assign roles and permissions
  - Search and filter users
- **User Authentication**
  - Register & Login with email verification
  - Password reset functionality
- **Role-Based Access Control**
  - Admin and Member roles
  - Restricted access based on permissions

## Tech Stack
- **Backend:** Laravel 11, PHP 8.2
- **Database:** MySQL
- **Frontend:** Blade, Tailwind CSS
- **Others:** Composer, Git, Node.js & npm

## Installation Guide

### Prerequisites
Ensure you have the following installed:
- PHP 8.2 or higher
- MySQL
- Composer
- Node.js & npm
- Git

### Setup Instructions
1. **Clone the repository:**
   ```bash
   git clone https://github.com/sagorahmad/customer-member-admin-management.git
   cd customer-member-admin-management
   ```
2. **Install dependencies:**
   ```bash
   composer install
   npm install
   npm run build
   ```
3. **Set up environment variables:**
   - Copy `.env.example` to `.env`
   - Update database credentials and other settings
   ```bash
   cp .env.example .env
   ```
4. **Generate application key:**
   ```bash
   php artisan key:generate
   ```
5. **Run database migrations:**
   ```bash
   php artisan migrate
   ```
6. **Start the development server:**
   ```bash
   php artisan serve
   ```
   The application will be available at `http://127.0.0.1:8000`.

## Usage
- Register as a user and verify your email.
- Admins can log in and manage users from the dashboard.

## Contribution
Feel free to fork the repository and submit pull requests with improvements.

## License
This project is open-source and available under the MIT License.

