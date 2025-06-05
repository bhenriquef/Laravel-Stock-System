# Laravel API Products

A RESTful API built with Laravel and Docker for managing product stock, designed as a personal project to practice and improve my skills with Laravel and React. The goal is to develop a complete stock management system with a React-based frontend and a Laravel backend running in a containerized environment. The project is still in development.

## Technologies

-   PHP 8.x (with PDO, pdo_mysql and Redis extensions)
-   Laravel Framework
-   MySQL 8.x
-   Redis 7.x
-   Nginx
-   Docker & Docker Compose
-   phpMyAdmin for DB administration
-   Composer (dependency management)

## Requirements

-   Docker >= 20.x
-   Docker Compose >= 1.29.x
-   Optional (for local development): PHP and Composer installed locally

## Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/yourproject.git
cd yourproject
```

### 2. Configure the `.env` File

Copy the example file and update it if needed:

```bash
cp .env.example .env
```

### 3. Build and Start the Containers

```bash
docker-compose up -d --build
```

### 4. Run Migrations and Seeders (Optional)

```bash
docker exec -it laravel_api_products php artisan migrate --seed
```

### 5. Access the Application

-   Laravel API: [http://localhost:8000](http://localhost:8000)
-   phpMyAdmin: [http://localhost:8080](http://localhost:8080)
    -   **User:** `laravel`
    -   **Password:** `root`

### 6. Test Redis (Optional)

```bash
docker exec -it laravel_api_products php artisan tinker
```

Then in Tinker:

```php
Cache::store('redis')->put('key', 'value', 600);
Cache::store('redis')->get('key'); // should return 'value'
```

---

## Project Structure

```
/app        # Laravel application code
/docker     # Docker setup (Dockerfile, nginx config)
/database   # Migrations, factories, seeders
/public     # Public entry (served by Nginx)
/resources  # Views, assets, etc.
/routes     # API routes
```

---

## Important Notes

-   Environment variables for MySQL and Redis are set in `.env`
-   The Docker setup includes services: `app`, `nginx`, `mysql`, `redis`, and `phpmyadmin`
-   The PHP container includes required extensions such as `pdo_mysql` and `redis`

---

## Useful Commands

-   View Laravel logs:

```bash
docker-compose logs -f app
```

-   Access the application container:

```bash
docker exec -it laravel_api_products bash
```

-   Run Artisan commands:

```bash
docker exec -it laravel_api_products php artisan migrate
```

-   Stop all containers:

```bash
docker-compose down
```

---

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

---

## License

MIT License © [Your Name]

---

## Contact

-   Email: bhhenriquefma@gmail.com
-   LinkedIn: https://www.linkedin.com/in/henrique-fernandes-machado-de-araujo/
