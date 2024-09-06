## Installation and Setup

### Prerequisites

- **Docker** (for Laravel Sail setup)
- **PHP** ^8.2 (for local setup)
- **Composer** (for local setup)
- **MySQL** (for local setup)

### Docker Setup with Laravel Sail

1. **Clone the repository**:
    ```bash
    git clone https://github.com/Vencelg/creepy-bikes-be.git
    cd creepy-bikes-be
    ```

2. **Copy the `.env.example` file to `.env`**:
    ```bash
    cp .env.example .env
    ```
3. **Install composer dependencies**:
    ```bash
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
    ````

4. **Create Storage/framework folders if not present**:
    ```bash
    cd storage/
    mkdir -p framework/{sessions,views,cache}
    chmod -R 775 framework
    cd ..
    ````

5. **Start the docker containers**:
    ```bash
    ./vendor/bin/sail up -d
    ```

6. **Generate an application key**:
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

7. **Run database migrations and seeders**:
    - Sometimes the first migration attempt fails, so you have to run it twice.
    ```bash
    ./vendor/bin/sail artisan migrate:fresh --seed
    ```

8. **Access the application**:
   - Visit `http://localhost:80/places` for bike stop list.
   - Visit `http://localhost:80/places/:id` for bike stop detail.
    
9. **Start the scheduler**:
   - Used for automatic data updating
   ```bash
   ./vendor/bin/sail artisan schedule:work
   ```
    
### Local Setup

1. **Clone the repository**:
    ```bash
    git clone https://github.com/Vencelg/creepy-bikes-be.git
    cd creepy-bikes-be
    ```

2. **Copy the `.env.example` file to `.env`**:
    ```bash
    cp .env.example .env
    ```

3. **Install PHP dependencies**:
    ```bash
    composer install
    ```

4. **Create Storage/framework folders if not present**:
    ```bash
    cd storage/
    mkdir -p framework/{sessions,views,cache}
    chmod -R 775 framework
    cd ..
    ````

5. **Generate an application key**:
    ```bash
    php artisan key:generate
    ```

6. **Run database migrations and seeders**:
    - Sometimes the first migration attempt fails, so you have to run it twice.
    ```bash
    php artisan migrate --seed
    ```

7. **Start the development server**:
    ```bash
    php artisan serve
    ```

8. **Access the API**:
   - Visit `http://localhost:8000/places` for bike stop list.
   - Visit `http://localhost:8000/places/:id` for bike stop detail.

9. **Start the scheduler**:
    - Used for automatic data updating
   ```bash
   php artisan schedule:work
   ```
   
## Informace o scheduleru
    Způsob automatické aktualizace jsem udělal přes DB seeder a Laravel scheduler.
    Díky příkazu migrate --seed se spustí databnase/seeders/DatabaseSeeder.php, kde je metoda
    na naplnění DB daty. Dále se scheduler postará o aktualizaci dat, tím, že smaže obsah tabulky places
    a nahradí ho novými daty. Tento proces se opakuje každých 10 minut díky příkazu artisan schedule:work
