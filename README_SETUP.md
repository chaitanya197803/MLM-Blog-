# MLM System - Manual Setup

Since the environment lacked PHP/Composer at the time of generation, these files were created manually.

## Setup Instructions

1.  **Create a fresh Laravel Project:**
    ```bash
    composer create-project laravel/laravel mlm-system-core
    ```
2.  **Copy Files:**
    Copy the contents of this folder into your new Laravel project, overwriting existing files where necessary.
    - `database/migrations/` -> `database/migrations/`
    - `app/` -> `app/`
    - `routes/` -> `routes/`
    - `resources/` -> `resources/`

3.  **Run Migrations:**
    ```bash
    php artisan migrate
    ```

## Features Implemented
- **User Migration**: Added `referral_code` and `referrer_id`.
- **User Model**: Added `referral` relations and helper methods.
- **Registration**: Custom registration logic to handle referral codes.
