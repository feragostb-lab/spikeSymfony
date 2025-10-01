# Symfony PWA Bootstrap

A modern Progressive Web Application (PWA) bootstrap built with Symfony 7.3 and API Platform, featuring a complete RESTful API with OpenAPI documentation.

## 🚀 Features

- **Symfony 7.3**: Latest version of the Symfony framework
- **API Platform 3.3**: REST API with OpenAPI/Swagger documentation
- **Progressive Web App**: Service Worker for offline capabilities
- **OpenAPI Documentation**: Interactive API documentation with Swagger UI
- **Doctrine ORM**: Database abstraction and migrations
- **Security**: Built-in authentication and CORS support
- **TDD Ready**: PHPUnit, PHPStan, and PHP-CS-Fixer configured
- **Modern Stack**: Similar to GLPI project dependencies

## 📋 Requirements

- PHP 8.2 or higher
- Composer 2.x
- PostgreSQL, MySQL, or SQLite (configured in .env)
- Node.js (optional, for frontend assets)

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/feragostb-lab/spikeSymfony.git
   cd spikeSymfony
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   Copy `.env` and adjust the database configuration:
   ```bash
   cp .env .env.local
   # Edit .env.local with your database credentials
   ```

4. **Create the database**
   ```bash
   php bin/console doctrine:database:create
   ```

5. **Run migrations**
   ```bash
   php bin/console doctrine:migrations:migrate
   ```

6. **Start the development server**
   ```bash
   # Using Symfony CLI (recommended)
   symfony server:start
   
   # Or using PHP built-in server
   php -S localhost:8000 -t public
   ```

7. **Access the application**
   - Home: http://localhost:8000
   - API: http://localhost:8000/api
   - API Documentation: http://localhost:8000/api/docs

## 📚 API Documentation

The API is fully documented using OpenAPI 3.0 specification. Access the interactive documentation at:

- **Swagger UI**: http://localhost:8000/api/docs
- **OpenAPI JSON**: http://localhost:8000/api/docs.json

### Example API Endpoints

- `GET /api/products` - List all products
- `POST /api/products` - Create a new product
- `GET /api/products/{id}` - Get a specific product
- `PUT /api/products/{id}` - Update a product
- `DELETE /api/products/{id}` - Delete a product

## 🧪 Testing

### Run all tests
```bash
composer test
# or
php bin/phpunit
```

### Run PHPStan (static analysis)
```bash
composer phpstan
# or
vendor/bin/phpstan analyse
```

### Run PHP-CS-Fixer (code style)
```bash
# Check code style
composer lint

# Fix code style
composer lint:fix
```

## 📱 PWA Features

The application includes PWA capabilities:

- **Service Worker**: Automatic caching for offline support
- **Manifest**: App-like experience on mobile devices
- **Installable**: Can be installed on desktop and mobile

The service worker is automatically registered when you visit the application.

## 🗄️ Database

The project uses Doctrine ORM for database management. You can use:

- **PostgreSQL** (recommended for production)
- **MySQL/MariaDB**
- **SQLite** (for development)

### Create a new entity
```bash
php bin/console make:entity
```

### Generate a migration
```bash
php bin/console make:migration
```

### Run migrations
```bash
php bin/console doctrine:migrations:migrate
```

## 🔒 Security

The application includes:

- Symfony Security component
- CORS configuration for API access
- Password hashing with bcrypt/argon2
- CSRF protection

To configure authentication, uncomment and configure the User entity in `config/packages/security.yaml`.

## 📦 Stack Overview

### Core Dependencies
- `symfony/framework-bundle` - Core Symfony components
- `api-platform/core` - REST API with OpenAPI
- `doctrine/orm` - Database ORM
- `doctrine/doctrine-migrations-bundle` - Database migrations
- `nelmio/cors-bundle` - CORS support
- `symfony/security-bundle` - Security features
- `symfony/twig-bundle` - Template engine

### Development Dependencies
- `phpunit/phpunit` - Testing framework
- `phpstan/phpstan` - Static analysis
- `friendsofphp/php-cs-fixer` - Code style fixer
- `symfony/maker-bundle` - Code generators
- `symfony/web-profiler-bundle` - Debug toolbar

## 📝 Project Structure

```
.
├── bin/                    # Console commands
├── config/                 # Configuration files
│   ├── packages/          # Bundle configurations
│   └── routes/            # Routing configurations
├── public/                # Public web directory
│   ├── index.php         # Application entry point
│   ├── manifest.json     # PWA manifest
│   └── sw.js             # Service Worker
├── src/                   # Application source code
│   ├── Controller/       # Controllers
│   ├── Entity/           # Doctrine entities
│   └── Kernel.php        # Application kernel
├── templates/             # Twig templates
├── tests/                 # Test files
├── var/                   # Cache and logs
├── .env                   # Environment configuration
├── composer.json          # PHP dependencies
└── README.md             # This file
```

## 🤝 Contributing

This is a spike/bootstrap project for testing and development. Feel free to:

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests and linters
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License.

## 🔗 Resources

- [Symfony Documentation](https://symfony.com/doc/current/index.html)
- [API Platform Documentation](https://api-platform.com/docs/)
- [Doctrine ORM Documentation](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/)
- [PWA Documentation](https://web.dev/progressive-web-apps/)

## 🙏 Acknowledgments

This project structure is inspired by the [GLPI project](https://github.com/glpi-project/glpi) stack and follows Symfony best practices for modern web application development.
