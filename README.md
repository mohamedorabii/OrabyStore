# OrabyStore

OrabyStore is a Laravel 12 e-commerce application with a Blade storefront, a JSON API, and a Filament admin panel. It supports multilingual catalog content, authenticated cart and checkout flows, OTP-based email verification and password reset, Google social login, Meilisearch-backed search, and admin management for products, categories, brands, subcategories, orders, users, and shipping settings.

## Project Overview

The app is a storefront for browsing products by category, subcategory, and brand, adding items to a cart, placing orders, and managing account flows such as registration, login, email verification, password reset, and order history. It also exposes the same catalog and commerce features over `/api` for client apps or SPA usage.

Admin users get a Filament dashboard at `/admin` for catalog and order management plus a statistics widget for users, products, orders, and revenue.

## Features

- Blade storefront with home, product listing, product details, categories, subcategories, brands, cart, checkout, orders, contact, and search pages.
- JSON API for products, home content, categories, brands, subcategories, cart, checkout, orders, search, registration, login, OTP verification, logout, and password reset.
- Multilingual content fields for English and Arabic across categories, brands, subcategories, products, and order/customer data.
- Authenticated cart management with support for guest carts and cart merging after login.
- Quantity validation against stock, including per-item maximums and checkout locking to avoid overselling.
- Order placement with stock decrement, order cancellation for pending orders, and stock restoration on cancel.
- OTP email verification after registration and OTP-based password reset.
- Social login via Laravel Socialite, with Google OAuth handled by the web routes.
- Search powered by Laravel Scout and Meilisearch for products, categories, brands, and subcategories.
- Contact form that emails submissions to the configured site inbox.
- Filament admin panel with CRUD resources for categories, brands, subcategories, products, orders, shipping settings, and users.
- Admin dashboard stats widget for total users, products, orders, and revenue.

## Tech Stack

### Backend

| Package | Version |
| --- | --- |
| PHP | ^8.2 |
| laravel/framework | ^12.0 |
| filament/filament | ^4.4 |
| laravel/sanctum | ^4.0 |
| laravel/scout | ^11.1 |
| laravel/socialite | ^5.25 |
| laravel/tinker | ^2.10.1 |
| laravel/ui | ^4.6 |
| meilisearch/meilisearch-php | ^1.16 |
| http-interop/http-factory-guzzle | ^1.2 |

### Development

| Package | Version |
| --- | --- |
| fakerphp/faker | ^1.23 |
| laravel/pail | ^1.2.2 |
| laravel/pint | ^1.24 |
| laravel/sail | ^1.41 |
| mockery/mockery | ^1.6 |
| nunomaduro/collision | ^8.6 |
| pestphp/pest | ^3.8 |
| pestphp/pest-plugin-laravel | ^3.2 |

### Frontend and Build Tooling

| Package | Version |
| --- | --- |
| vite | ^7.0.7 |
| laravel-vite-plugin | ^2.0.0 |
| tailwindcss | ^4.0.0 |
| @tailwindcss/vite | ^4.0.0 |
| bootstrap | ^5.2.3 |
| @popperjs/core | ^2.11.6 |
| axios | ^1.11.0 |
| sass | ^1.56.1 |
| concurrently | ^9.0.1 |

## Docker Setup

| Service | Image / Build | Ports | Purpose |
| --- | --- | --- | --- |
| php | Built from `Dockerfile` | No host port mapping | PHP-FPM application container |
| nginx | `nginx:alpine` | `8888:80` | Web entry point |
| mysql | `mariadb:10.5` | `3307:3306` | Database |
| phpmyadmin | `phpmyadmin` | `8080:80` | Database UI |
| redis | `redis:alpine` | `6379:6379` | Cache / queue support |
| meilisearch | `getmeili/meilisearch:latest` | `7700:7700` | Search engine |

Docker service defaults in `docker-compose.yml` also point the app container at `mysql`, `redis`, and `meilisearch` using the internal service names.

## Installation

### Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate --seed --force
npm install
npm run build
php artisan scout:import "App\\Models\\Product"
php artisan scout:import "App\\Models\\Category"
php artisan scout:import "App\\Models\\Brand"
php artisan scout:import "App\\Models\\Subcategory"
```

If you want the local dev servers, run:

```bash
php artisan serve
npm run dev
```

### Docker setup

```bash
docker compose up -d --build
docker exec -it orabystore_app bash
```

Then install dependencies and prepare the app:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate --seed --force
npm install
npm run build
php artisan scout:import "App\\Models\\Product"
php artisan scout:import "App\\Models\\Category"
php artisan scout:import "App\\Models\\Brand"
php artisan scout:import "App\\Models\\Subcategory"
```

Notes:

- The PHP container does not ship with Node.js, so frontend asset commands must be run on the host or another Node-capable environment.
- Update your `.env` database and service host values to match the Docker services when using Compose.
- The search index must be imported after seeding if you want live Meilisearch results.

### Seed data

The default database seeder creates an admin user plus sample categories, subcategories, brands, and products.

## API Endpoints

All API routes are registered under the `/api` prefix.

| Method | URI | Auth | Description |
| --- | --- | --- | --- |
| GET | `/api/user` | `auth:sanctum` | Returns the authenticated user. |
| POST | `/api/register` | None | Registers a user, sends OTP verification, and returns a token. |
| POST | `/api/login` | None | Authenticates a user and returns a token. |
| POST | `/api/forgot-password` | None | Sends an OTP code for password reset. |
| POST | `/api/reset-password` | None | Resets the password using email, code, and new password. |
| POST | `/api/verify-otp` | `auth:sanctum` | Verifies the signed-in user email with OTP. |
| POST | `/api/resend-otp` | `auth:sanctum` | Resends the OTP verification code. |
| POST | `/api/logout` | `auth:sanctum` | Revokes the current API token. |
| GET | `/api/products` | None | Lists active products, optionally filtered by category id. |
| GET | `/api/products/{id}` | None | Returns one product and related products. |
| GET | `/api/home` | None | Returns active categories and latest products. |
| GET | `/api/home/category/{id?}` | None | Returns active categories and products for a category. |
| GET | `/api/categories` | None | Lists active categories. |
| GET | `/api/categories/{id}/products` | None | Lists products for a category. |
| GET | `/api/brands` | None | Lists active brands. |
| GET | `/api/brands/{id}/products` | None | Lists products for a brand. |
| GET | `/api/subcategories` | None | Lists active subcategories. |
| GET | `/api/subcategories/{id}/products` | None | Lists products for a subcategory. |
| GET | `/api/cart` | `auth:sanctum` | Returns cart items and totals. |
| POST | `/api/cart` | `auth:sanctum` | Adds an item to the cart. |
| PUT | `/api/cart/{cart}` | `auth:sanctum` | Updates cart quantity. |
| DELETE | `/api/cart/{cart}` | `auth:sanctum` | Removes a cart item. |
| DELETE | `/api/cart` | `auth:sanctum` | Clears the cart. |
| GET | `/api/checkout` | `auth:sanctum` | Returns checkout summary and totals. |
| POST | `/api/checkout` | `auth:sanctum` | Places an order from the current cart. |
| GET | `/api/orders` | `auth:sanctum` | Returns the authenticated user's orders. |
| GET | `/api/orders/{id}` | `auth:sanctum` | Returns a single order with items. |
| GET | `/api/search?q=...` | None | Searches products, categories, brands, and subcategories. |

## Web Routes

The web app uses standard Laravel auth routes plus custom storefront routes.

| Method | URI | Description |
| --- | --- | --- |
| GET | `/` | Home page with latest products. |
| GET | `/home/category/{id?}` | Home page filtered by category. |
| GET | `/products/{id?}` | Product listing page, optionally filtered by category. |
| GET | `/products/details/{id}` | Product details page. |
| GET | `/categories/{id?}` | Categories listing page. |
| GET | `/subcategories/{id?}` | Subcategories listing page. |
| GET | `/subcategories/products/{id}` | Products for a subcategory. |
| GET | `/brands` | Brands listing page. |
| GET | `/products/brand/{id}` | Products for a brand. |
| GET | `/cart` | Cart page. |
| POST | `/cart/add` | Add product to cart. |
| POST | `/cart/update/{cart}` | Update a cart item. |
| POST | `/cart/remove/{cart}` | Remove a cart item. |
| POST | `/cart/clear` | Clear the cart. |
| GET | `/checkout` | Checkout page for authenticated and verified users. |
| POST | `/checkout/place-order` | Place an order. |
| GET | `/my-orders` | Order history page. |
| PATCH | `/orders/{order}/cancel` | Cancel a pending order and restore stock. |
| GET | `/contact` | Contact page. |
| POST | `/contact/send` | Submit the contact form. |
| GET | `/search` | Search results page. |
| GET | `/search/live` | Live search JSON endpoint. |
| POST | `/email/verify` | OTP email verification submission. |
| GET | `/password/reset/{token?}` | Password reset form. |
| POST | `/password/reset` | Submit password reset code and new password. |
| GET | `/auth/{provider}/redirect` | Social login redirect. |
| GET | `/auth/{provider}/callback` | Social login callback. |

Laravel's built-in auth scaffolding is also enabled with email verification. Social login routes are web-only; there is no API OAuth callback route in the current codebase.

## Architecture

The app uses a service layer between controllers and models.

| Service | Responsibility |
| --- | --- |
| `AuthService` | Registers users, authenticates logins, logs out API tokens, and handles OTP password reset / verification helpers. |
| `OtpService` | Generates OTP codes, stores expiry timestamps, sends verification emails, and verifies codes. |
| `SocialAuthService` | Handles OAuth callbacks and creates or updates users from social identity providers. |
| `CartService` | Resolves cart identifiers, loads cart items, validates stock, updates quantities, clears carts, and supports guest cart behavior. |
| `CheckoutService` | Builds checkout totals, creates orders and order items in a transaction, decrements stock, and handles order cancellation. |
| `HomeService` | Loads active categories and latest or category-filtered products for the storefront and API. |
| `ProductService` | Loads active products, product details, and related products. |
| `CategoryService` | Loads active categories. |
| `BrandService` | Loads active brands and products by brand. |
| `SubCategoryService` | Loads active subcategories and products by subcategory. |
| `SearchService` | Searches products, categories, brands, and subcategories using Scout. |
| `ContactService` | Sends contact form messages by email. |

Event listeners wire the app together:

- `SendOtpOnRegister` sends OTP verification when a user registers.
- `MergeGuestCart` merges guest cart items into the logged-in user's cart on login.

## Database

| Model | Relationships |
| --- | --- |
| `User` | No explicit Eloquent relationships are defined in the model. It uses Sanctum tokens, notifications, and Filament admin access via `canAccessPanel()`. |
| `Category` | `hasMany(Subcategory::class)`, `hasMany(Product::class)`. Also searchable via Scout. |
| `Subcategory` | `belongsTo(Category::class)`, `hasMany(Product::class)`. Also searchable via Scout. |
| `Brand` | `hasMany(Product::class)`. Also searchable via Scout. |
| `Product` | `belongsTo(Subcategory::class)`, `belongsTo(Brand::class)`, `belongsTo(Category::class)`. Also searchable via Scout. |
| `Cart` | `belongsTo(User::class)`, `belongsTo(Product::class)`. |
| `Order` | `belongsTo(User::class)`, `hasMany(OrderItem::class)`. |
| `OrderItem` | `belongsTo(Order::class)`, `belongsTo(Product::class)`. |
| `ShippingSetting` | No explicit relationships. The Filament resource limits it to a single record. |

Key schema notes:

- Products, categories, brands, and subcategories are multilingual with `*_en` and `*_ar` columns.
- Products store stock in `quantity` and an active flag in `status`.
- Orders store status, shipping price, customer contact data, and total price.
- Cart rows can belong to either a `user_id` or a `session_id`, which enables guest carts.

## Environment Variables

### Variables present in `.env.example`

| Variable | Purpose |
| --- | --- |
| `APP_NAME` | Application name. |
| `APP_ENV` | Environment name. |
| `APP_KEY` | Laravel app key. |
| `APP_DEBUG` | Debug mode toggle. |
| `APP_URL` | Base app URL. |
| `APP_LOCALE` | Default locale. |
| `APP_FALLBACK_LOCALE` | Fallback locale. |
| `APP_FAKER_LOCALE` | Faker locale. |
| `APP_MAINTENANCE_DRIVER` | Maintenance mode driver. |
| `BCRYPT_ROUNDS` | Hash cost. |
| `LOG_CHANNEL` | Default log channel. |
| `LOG_STACK` | Log stack channel. |
| `LOG_DEPRECATIONS_CHANNEL` | Deprecation log channel. |
| `LOG_LEVEL` | Log level. |
| `DB_CONNECTION` | Database driver. |
| `DB_HOST` | Database host. |
| `DB_PORT` | Database port. |
| `DB_DATABASE` | Database name. |
| `DB_USERNAME` | Database user. |
| `DB_PASSWORD` | Database password. |
| `SESSION_DRIVER` | Session driver. |
| `SESSION_LIFETIME` | Session lifetime. |
| `SESSION_ENCRYPT` | Encrypt sessions. |
| `SESSION_PATH` | Session path. |
| `SESSION_DOMAIN` | Session domain. |
| `BROADCAST_CONNECTION` | Broadcast driver. |
| `FILESYSTEM_DISK` | Default filesystem disk. |
| `QUEUE_CONNECTION` | Queue driver. |
| `CACHE_STORE` | Cache store. |
| `MEMCACHED_HOST` | Memcached host. |
| `REDIS_CLIENT` | Redis client. |
| `REDIS_HOST` | Redis host. |
| `REDIS_PASSWORD` | Redis password. |
| `REDIS_PORT` | Redis port. |
| `MAIL_MAILER` | Mail driver. |
| `MAIL_SCHEME` | Mail scheme. |
| `MAIL_HOST` | Mail host. |
| `MAIL_PORT` | Mail port. |
| `MAIL_USERNAME` | Mail username. |
| `MAIL_PASSWORD` | Mail password. |
| `MAIL_FROM_ADDRESS` | Outgoing email address. |
| `MAIL_FROM_NAME` | Outgoing email name. |
| `AWS_ACCESS_KEY_ID` | AWS key for optional SES/S3 usage. |
| `AWS_SECRET_ACCESS_KEY` | AWS secret for optional SES/S3 usage. |
| `AWS_DEFAULT_REGION` | AWS region. |
| `AWS_BUCKET` | AWS bucket. |
| `AWS_USE_PATH_STYLE_ENDPOINT` | AWS path-style endpoint flag. |
| `VITE_APP_NAME` | Client-side app name. |

### Additional variables used by the codebase

| Variable | Purpose |
| --- | --- |
| `SCOUT_DRIVER` | Scout search driver, used with Meilisearch. |
| `SCOUT_PREFIX` | Optional search index prefix. |
| `SCOUT_QUEUE` | Queue Scout sync operations. |
| `SCOUT_IDENTIFY` | Identify search users for supported engines. |
| `MEILISEARCH_HOST` | Meilisearch host URL. |
| `MEILISEARCH_KEY` | Meilisearch API key. |
| `SANCTUM_STATEFUL_DOMAINS` | Stateful domains for Sanctum SPA auth. |
| `SANCTUM_TOKEN_PREFIX` | Optional Sanctum token prefix. |
| `GOOGLE_CLIENT_ID` | Google OAuth client id. |
| `GOOGLE_CLIENT_SECRET` | Google OAuth client secret. |
| `GOOGLE_REDIRECT_URL` | Google OAuth callback URL. |
| `AUTH_GUARD` | Optional auth guard override. |
| `AUTH_PASSWORD_BROKER` | Optional password broker override. |
| `AUTH_MODEL` | Optional auth model override. |
| `AUTH_PASSWORD_RESET_TOKEN_TABLE` | Optional password reset table override. |
| `AUTH_PASSWORD_TIMEOUT` | Password confirmation timeout. |
| `POSTMARK_API_KEY` | Optional Postmark support. |
| `RESEND_API_KEY` | Optional Resend support. |
| `SLACK_BOT_USER_OAUTH_TOKEN` | Optional Slack notification support. |
| `SLACK_BOT_USER_DEFAULT_CHANNEL` | Optional Slack notification channel. |

The current `.env.example` does not include the Scout, Meilisearch, or Google OAuth keys above, but the application code reads them through `config/scout.php`, `config/services.php`, and the social-login controller.

## Project Structure

```text
app/
	Filament/
		Resources/
		Widgets/
	Http/
		Controllers/
			Api/
			Auth/
			Backend/
			FrontEnd/
		Middleware/
		Requests/
		Resources/
	Listeners/
	Models/
	Notifications/
	Providers/
	Services/
bootstrap/
config/
database/
	factories/
	migrations/
	seeders/
public/
	build/
	help-documentation/
	images/
	js/
	new-template/
resources/
	css/
	js/
	sass/
	views/
routes/
	api.php
	console.php
	web.php
storage/
tests/
docker/
	nginx/
```

## Security Features

- Sanctum token authentication for API endpoints that require a signed-in user.
- Rate limiting on registration, login, forgot-password, reset-password, OTP verify, and OTP resend flows.
- OTP-based email verification after registration.
- OTP-based password reset instead of plain token reset links.
- `auth` and `verified` middleware on checkout and order management pages.
- Cart ownership checks to prevent one user from changing another user's cart items.
- Guest cart isolation by session id, then merge into the authenticated cart after login.
- Stock validation and row locking during checkout to prevent overselling.
- Pending-order-only cancellation with stock restoration.
- Admin access control through the `User::canAccessPanel()` Filament check.
- Custom API exception rendering in `bootstrap/app.php` that returns structured JSON for validation, auth, authorization, missing resource, rate limit, and HTTP errors.
- CSRF protection through the normal web middleware stack and the Filament panel middleware stack.

## Running Tests

```bash
php artisan test
```

The Composer script `composer test` also clears config before running the test suite.
