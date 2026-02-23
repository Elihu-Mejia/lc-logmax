# 🪵 LC-Logmax

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)

A robust Laravel application for logging and Pokemon management.

##  Pokemon Management

To set up the database schema and populate it with Pokemon data.

1.  **Run Migrations**
    ```bash
    php artisan migrate
    ```

2.  **Import Pokemon**
    Fetch and store Pokemon data from PokeAPI into the local database:
    ```bash
    php artisan pokemon:store
    ```

---

## 🧪 Running Tests

Ensure your application is stable by running the test suite.

### Run All Tests
```bash
php artisan test
```

### Run with Coverage
```bash
docker-compose exec app php artisan test --coverage
```

---

## 📡 API Endpoints

Here is a list of the primary endpoints available in the application.

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `GET` | `/api/pokemon` | List Pokemon. Supports `limit`, `offset`, `type`, `name`. |
| `GET` | `/api/pokemon/{type}` | Filter Pokemon by type (e.g., `fire`). |
| `GET` | `/api/pokemon/details` | List Pokemon with full details (paginated). |
| `GET` | `/api/pokemon/{name}/details` | Retrieve details for a specific Pokemon. |
| `GET` | `/health` | Health check endpoint |

> **Note:** Access the application frontend at http://localhost:8000.