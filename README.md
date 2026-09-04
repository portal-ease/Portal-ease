# PortalEase

PortalEase is a modern client portal platform built with Laravel. It provides businesses with a centralized place to manage clients, projects, documents, communication, and other client-facing workflows.

## Requirements

Before installing PortalEase, make sure you have the following installed:

- Docker
- Git

PHP, Composer, Node.js, and MySQL are provided through the Docker development environment.

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/portal-ease/Portal-ease.git
cd PortalEase
```

### 2. Create the environment file

```bash
cp .env.example .env
```

### 3. Install PHP dependencies

```bash
composer install
```

### 4. Start Docker

Build and start the Laravel Sail containers:

```bash
./vendor/bin/sail up -d --build
```

### 5. Generate the application key

```bash
./vendor/bin/sail artisan key:generate
```

### 6. Install frontend dependencies

```bash
./vendor/bin/sail npm install
```

### 7. Run database migrations and seeders

```bash
./vendor/bin/sail artisan migrate --seed
```

### 8. Format the code

```bash
./vendor/bin/sail npm run format
```

After completing the installation, PortalEase should be available at:

```text
http://localhost
```

The exact URL may depend on your Docker and Sail configuration.

## Docker

PortalEase uses Laravel Sail to provide a consistent development environment.

### Start the application

```bash
./vendor/bin/sail up -d
```

### Stop the application

```bash
./vendor/bin/sail down
```

### Restart the application

```bash
./vendor/bin/sail restart
```

### View application logs

```bash
./vendor/bin/sail logs
```

### Run Artisan commands

```bash
./vendor/bin/sail artisan <command>
```

For example:

```bash
./vendor/bin/sail artisan migrate
```

## Database

PortalEase uses MySQL through the Docker development environment.

Run migrations:

```bash
./vendor/bin/sail artisan migrate
```

Run the database seeders:

```bash
./vendor/bin/sail artisan db:seed
```

Reset the database and run all seeders:

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

> **Warning:** `migrate:fresh` deletes all existing database data.

## Development

Start the Laravel and Vite application:

```bash
./vendor/bin/sail up -d
```

Run the code formatter:

```bash
./vendor/bin/sail npm run format
```

## Testing

Run the Laravel test suite:

```bash
./vendor/bin/sail artisan test
```

Run a specific test:

```bash
./vendor/bin/sail artisan test tests/Feature/ExampleTest.php
```

## Useful Commands

### Laravel

```bash
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail artisan db:seed
./vendor/bin/sail artisan route:list
./vendor/bin/sail artisan optimize:clear
```

### Docker

```bash
./vendor/bin/sail up -d
./vendor/bin/sail down
./vendor/bin/sail restart
./vendor/bin/sail logs
```

### Frontend

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run format
```

## Contributing

Contributions, suggestions, and bug reports are welcome.

### Development Workflow

1. Fork the repository.
2. Create a feature branch:

```bash
git checkout -b feature/PE-00_my-feature
```

3. Make your changes.

5. Format your code:

```bash
./vendor/bin/sail npm run format
```

6. Commit your changes:

```bash
git commit -m "add my feature"
```

7. Push your branch:

```bash
git push origin feature/my-feature
```

8. Open a Pull Request.

## Author

**Stijn1290**

PortalEase is developed as a modern client portal platform focused on making client collaboration and business processes easier to manage.

---

If you find PortalEase useful, consider giving the repository a star.
