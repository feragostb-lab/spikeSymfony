# API Documentation

This document provides an overview of the REST API endpoints available in the Symfony PWA Bootstrap application.

## Base URL

```
http://localhost:8000/api
```

## Authentication

Currently, the API is open and does not require authentication. To add authentication:

1. Configure JWT or API Token authentication in `config/packages/security.yaml`
2. Add authentication requirements to API Platform resources

## Content Types

The API supports multiple content types:

- `application/ld+json` (JSON-LD format, default)
- `application/json` (Standard JSON)
- `text/html` (HTML representation)

Specify the desired format using the `Accept` header:

```bash
curl -H "Accept: application/json" http://localhost:8000/api/products
```

## Endpoints

### Products

#### List all products

**GET** `/api/products`

Returns a paginated list of products.

**Query Parameters:**
- `page` (integer): Page number (default: 1)
- `itemsPerPage` (integer): Items per page (default: 30, max: 100)

**Example Request:**
```bash
curl http://localhost:8000/api/products
```

**Example Response:**
```json
{
  "@context": "/api/contexts/Product",
  "@id": "/api/products",
  "@type": "hydra:Collection",
  "hydra:totalItems": 1,
  "hydra:member": [
    {
      "@id": "/api/products/1",
      "@type": "Product",
      "id": 1,
      "name": "Test Product",
      "description": "A test product for demo",
      "price": "29.99",
      "createdAt": "2025-10-01T07:12:11+00:00"
    }
  ]
}
```

#### Get a single product

**GET** `/api/products/{id}`

Returns a single product by ID.

**Example Request:**
```bash
curl http://localhost:8000/api/products/1
```

**Example Response:**
```json
{
  "@context": "/api/contexts/Product",
  "@id": "/api/products/1",
  "@type": "Product",
  "id": 1,
  "name": "Test Product",
  "description": "A test product for demo",
  "price": "29.99",
  "createdAt": "2025-10-01T07:12:11+00:00"
}
```

#### Create a product

**POST** `/api/products`

Creates a new product.

**Request Body:**
```json
{
  "name": "New Product",
  "description": "Product description",
  "price": "49.99"
}
```

**Example Request:**
```bash
curl -X POST http://localhost:8000/api/products \
  -H "Content-Type: application/json" \
  -d '{
    "name": "New Product",
    "description": "Product description",
    "price": "49.99"
  }'
```

**Example Response:**
```json
{
  "@context": "/api/contexts/Product",
  "@id": "/api/products/2",
  "@type": "Product",
  "id": 2,
  "name": "New Product",
  "description": "Product description",
  "price": "49.99",
  "createdAt": "2025-10-01T08:00:00+00:00"
}
```

**Status Code:** `201 Created`

#### Update a product

**PUT** `/api/products/{id}`

Replaces a product with new data.

**Request Body:**
```json
{
  "name": "Updated Product",
  "description": "Updated description",
  "price": "59.99"
}
```

**Example Request:**
```bash
curl -X PUT http://localhost:8000/api/products/1 \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Updated Product",
    "description": "Updated description",
    "price": "59.99"
  }'
```

**Status Code:** `200 OK`

#### Delete a product

**DELETE** `/api/products/{id}`

Deletes a product.

**Example Request:**
```bash
curl -X DELETE http://localhost:8000/api/products/1
```

**Status Code:** `204 No Content`

## Error Responses

The API returns appropriate HTTP status codes and error messages:

### 400 Bad Request

```json
{
  "@context": "/api/contexts/ConstraintViolationList",
  "@type": "ConstraintViolationList",
  "hydra:title": "An error occurred",
  "hydra:description": "name: This value should not be blank.",
  "violations": [
    {
      "propertyPath": "name",
      "message": "This value should not be blank."
    }
  ]
}
```

### 404 Not Found

```json
{
  "@context": "/api/contexts/Error",
  "@type": "hydra:Error",
  "hydra:title": "An error occurred",
  "hydra:description": "Not Found"
}
```

### 405 Method Not Allowed

```json
{
  "@context": "/api/contexts/Error",
  "@type": "hydra:Error",
  "hydra:title": "An error occurred",
  "hydra:description": "No route found for \"PATCH /api/products/1\": Method Not Allowed (Allow: GET, PUT, DELETE)"
}
```

## Interactive Documentation

For interactive API exploration, visit:

- **Swagger UI:** http://localhost:8000/api
- **ReDoc:** http://localhost:8000/api/docs?ui=re_doc

You can also export the OpenAPI specification:

- **OpenAPI JSON:** http://localhost:8000/api/index.jsonopenapi
- **OpenAPI YAML:** http://localhost:8000/api/index.yamlopenapi

## Pagination

Collections are paginated by default. Use the following parameters:

```bash
curl "http://localhost:8000/api/products?page=2&itemsPerPage=10"
```

The response includes pagination metadata:

```json
{
  "@context": "/api/contexts/Product",
  "@id": "/api/products",
  "@type": "hydra:Collection",
  "hydra:totalItems": 50,
  "hydra:member": [...],
  "hydra:view": {
    "@id": "/api/products?page=2",
    "@type": "hydra:PartialCollectionView",
    "hydra:first": "/api/products?page=1",
    "hydra:last": "/api/products?page=5",
    "hydra:previous": "/api/products?page=1",
    "hydra:next": "/api/products?page=3"
  }
}
```

## Filtering and Sorting

To add filtering and sorting capabilities, configure them in your entity:

```php
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;

#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'partial'])]
#[ApiFilter(OrderFilter::class, properties: ['createdAt', 'price'])]
class Product
{
    // ...
}
```

Then use them in requests:

```bash
# Search
curl "http://localhost:8000/api/products?name=test"

# Sort
curl "http://localhost:8000/api/products?order[price]=desc"
```

## CORS

Cross-Origin Resource Sharing (CORS) is enabled for the `/api` path. The configuration can be modified in `config/packages/nelmio_cors.yaml`.

## Rate Limiting

Rate limiting is not currently enabled. To add it, install and configure:

```bash
composer require symfony/rate-limiter
```

## Versioning

API versioning can be implemented by:

1. **URL versioning:** `/api/v1/products`, `/api/v2/products`
2. **Header versioning:** `Accept: application/vnd.api+json;version=1`
3. **Query parameter:** `/api/products?version=1`

## Additional Resources

- [API Platform Documentation](https://api-platform.com/docs/)
- [Symfony REST API Best Practices](https://symfony.com/doc/current/best_practices.html)
- [OpenAPI Specification](https://swagger.io/specification/)
