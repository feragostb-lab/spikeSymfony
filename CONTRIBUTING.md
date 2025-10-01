# Contributing to Symfony PWA Bootstrap

Thank you for your interest in contributing! This document provides guidelines and instructions for contributing to this project.

## Development Setup

### Prerequisites

- PHP 8.2 or higher
- Composer 2.x
- Git
- A database (PostgreSQL, MySQL, or SQLite)

### Getting Started

1. **Fork and clone the repository**
   ```bash
   git clone https://github.com/your-username/spikeSymfony.git
   cd spikeSymfony
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure your environment**
   ```bash
   cp .env .env.local
   # Edit .env.local with your local settings
   ```

4. **Set up the database**
   ```bash
   # For SQLite (default)
   php bin/console doctrine:migrations:migrate
   
   # For PostgreSQL/MySQL
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5. **Start the development server**
   ```bash
   php -S localhost:8000 -t public
   # Or use Symfony CLI
   symfony server:start
   ```

## Development Workflow

### Code Style

We use PHP-CS-Fixer to maintain consistent code style:

```bash
# Check code style
composer lint

# Fix code style automatically
composer lint:fix
```

### Static Analysis

We use PHPStan for static analysis:

```bash
# Run PHPStan
composer phpstan
```

### Testing

We use PHPUnit for testing:

```bash
# Run all tests
composer test

# Run specific test file
php bin/phpunit tests/Controller/HomeControllerTest.php

# Run with coverage (requires xdebug)
XDEBUG_MODE=coverage php bin/phpunit --coverage-html coverage
```

### Creating New Features

1. **Create a new branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```

2. **Make your changes**
   - Follow PSR-12 coding standards
   - Write tests for new functionality
   - Update documentation if needed

3. **Run quality checks**
   ```bash
   composer lint:fix
   composer phpstan
   composer test
   ```

4. **Commit your changes**
   ```bash
   git add .
   git commit -m "feat: your feature description"
   ```

5. **Push and create a pull request**
   ```bash
   git push origin feature/your-feature-name
   ```

## Project Structure

```
.
├── bin/                    # Console commands
├── config/                 # Configuration files
│   ├── packages/          # Bundle configurations
│   └── routes/            # Routing configurations
├── migrations/            # Database migrations
├── public/                # Public web directory
├── src/                   # Application source code
│   ├── Controller/       # Controllers
│   ├── Entity/           # Doctrine entities
│   └── Repository/       # Doctrine repositories
├── templates/             # Twig templates
├── tests/                 # Test files
└── var/                   # Cache and logs
```

## Adding API Endpoints

### 1. Create an Entity

```bash
php bin/console make:entity Product
```

### 2. Add API Platform Annotations

```php
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;

#[ORM\Entity]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post()
    ]
)]
class Product
{
    // ...
}
```

### 3. Generate and Run Migration

```bash
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

### 4. Test Your API

```bash
curl http://localhost:8000/api/products
```

## Writing Tests

### Controller Tests

```php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class YourControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $client->request('GET', '/your-route');

        $this->assertResponseIsSuccessful();
    }
}
```

### API Tests

```php
namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class ProductTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/api/products');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }
}
```

## Commit Message Guidelines

We follow conventional commits:

- `feat:` New feature
- `fix:` Bug fix
- `docs:` Documentation changes
- `style:` Code style changes (formatting, etc.)
- `refactor:` Code refactoring
- `test:` Adding or updating tests
- `chore:` Maintenance tasks

Example:
```
feat: add user authentication endpoint
fix: resolve CORS issue in API
docs: update README with deployment instructions
```

## Pull Request Process

1. Ensure all tests pass
2. Update documentation if needed
3. Follow the code style guidelines
4. Provide a clear description of changes
5. Link related issues

## Questions or Problems?

Feel free to open an issue for:
- Bug reports
- Feature requests
- Questions about the code
- Documentation improvements

## License

By contributing, you agree that your contributions will be licensed under the MIT License.
