# MLM System

A robust Multi-Level Marketing (MLM) system built with Laravel, featuring user registration with referrals and automated tree placement.

## Project Structure

- `mlm-system-core/`: The main Laravel application containing the MLM logic, database migrations, and UI.
- `mlm-system/`: A secondary Laravel project folder (likely a backup or variant).

## Prerequisites

Ensure you have the following installed on your system:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL or any supported database

## Getting Started

Follow these steps to set up and run the project locally:

### 1. Clone the repository
```bash
git clone https://github.com/chaitanya197803/MLM-Blog-.git
cd MLM-Blog-
```

### 2. Setup the Core Application
Go to the core directory:
```bash
cd mlm-system-core
```

### 3. Install Dependencies
```bash
composer install
npm install
```

### 4. Environment Configuration
Copy the example environment file and configure your database settings:
```bash
cp .env.example .env
```
Open `.env` and update the database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Run Migrations
Run the database migrations to create the necessary tables:
```bash
php artisan migrate
```

### 7. Run the Application
Start the development server:
```bash
php artisan serve
```
In another terminal, run the asset bundler:
```bash
npm run dev
```

## Features
- **Registration with Referral**: Users can sign up using a referral code.
- **MLM Tree Logic**: Automatic placement of new users into the optimal position in the binary/matrix tree.
- **Premium UI**: Modern, responsive registration and login pages.
- **Tree Verification**: Built-in scripts to verify the integrity of the MLM tree structure.

## Useful Commands
- `php artisan migrate:fresh --seed`: Reset the database and seed it.
- `php artisan serve`: Start the local server at `http://localhost:8000`.
