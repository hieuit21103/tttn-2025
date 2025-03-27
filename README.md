# TTTN-2025 Laravel Project Setup Guide

## Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL or another compatible database
- Node.js and npm

## Clone the Repository

```bash
# Clone the repository
git clone https://github.com/hieuit21103/tttn-2025.git

# Navigate to the project directory
cd tttn-2025
```

## Installation Steps

1. Install PHP Dependencies
```bash
composer install
```

2. Create Environment File
```bash
cp .env.example .env
```

3. Generate Application Key
```bash
php artisan key:generate
```

4. Configure Database
- Open `.env` file
- Set your database connection details:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

5. Run Database Migrations
```bash
php artisan migrate
```

6. Install Frontend Dependencies
```bash
npm install
npm run dev
```

7. Start the Development Server
```bash
php artisan serve
```

## Additional Configuration
- Check and set up any additional environment-specific configurations in the `.env` file
- Run `php artisan config:clear` if you make any changes to configuration files

## Troubleshooting
- Ensure all PHP extensions required by Laravel are installed
- Check file permissions
- Verify database connection details

## Contributing
Please read the project's contribution guidelines before making any changes.

## License
Check the LICENSE file in the project repository for licensing information.