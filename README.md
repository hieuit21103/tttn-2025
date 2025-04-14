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

4. Configure Database And Mail
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
- Set example mail host details: 
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=harunaai235@gmail.com
MAIL_PASSWORD=yacgvsjgohgbtlmv
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="harunaai235@gmail.com"
MAIL_FROM_NAME="BAN QUẢN LÝ KÝ TÚC XÁ"
```

5. Run Database Migrations
```bash
php artisan migrate
```

6. Create Default Admin Account
```bash
php artisan db:seed
```

The default admin account credentials are:
- username: admin
- password: password

After logging in, it is recommended to change the default password immediately.

7. Install Frontend Dependencies
```bash
npm install
npm run dev
```

8. Start the Development Server
```bash
php artisan serve
```

## Additional Configuration
- Check and set up any additional environment-specific configurations in the `.env` file
- Run `php artisan config:clear` if you make any changes to configuration files

## Create Additional Users
To create additional users with specific roles, use the following command:
```bash
php artisan create:user --email="user@example.com" --role="admin|user"
```

Available roles:
- admin: Full system access
- user: Read only mode

## Troubleshooting
- Ensure all PHP extensions required by Laravel are installed
- Check file permissions
- Verify database connection details

## Contributing
Please read the project's contribution guidelines before making any changes.

## License
Check the LICENSE file in the project repository for licensing information.