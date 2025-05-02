## Title

- React&Docker&PHPUnit&GithubAction

<img width="1433" alt="image" src="https://github.com/user-attachments/assets/77b768ce-6072-4033-b904-543755b8cb27">


##  Tech stack used in this demo
- React
- Docker
- PHPUnit
- Laravel
- GithubCI

## ENV
- DB_CONNECTION=mysql
- DB_HOST=db
- DB_PORT=3306
- DB_DATABASE=laravel
- DB_USERNAME=root
- DB_PASSWORD=root1234
- VITE_APP_NAME="${APP_NAME}"
- VITE_ENABLED=true

## How to use it
- docker compose up -d

## How to run commands inside the db container
docker exec -it laravel-app php artisan migrate
