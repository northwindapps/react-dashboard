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
- docker compose up --build    

## How to run commands inside the db container
docker exec -it laravel-app php artisan migrate:fresh
docker exec -it laravel-app php artisan db:seed --class=UserSeeder
docker exec -it laravel-app php artisan db:seed --class=TeacherSeeder
docker exec -it laravel-app php artisan db:seed --class=StudentSeeder
docker exec -it laravel-app php artisan db:seed --class=ServiceSeeder
docker exec -it laravel-app php artisan db:seed --class=PaymentSeeder
docker exec -it laravel-app php artisan db:seed --class=LessonSeeder
docker exec -it laravel-app php artisan db:seed --class=LessonStudentSeeder
docker exec -it laravel-app php artisan db:seed --class=AppointmentSeeder
<!-- docker exec -it laravel-app php artisan migrate:fresh --seed -->

### How to add a new migration file
php artisan make:migration add_userid_status_index_to_payments_table --table=payments

#### How to rollback a migration file
docker exec -it laravel-app ls -l database/migrations

docker exec -it laravel-app php artisan migrate:rollback --path=database/migrations/2025_05_02_024139_create_payments_table.php

##### Laravel Passport
curl -H "Authorization: Bearer YOUR_ACCESS_TOKEN" http://localhost:8080/api/user

##### Commands
read the log:
docker exec -it laravel-app tail -n 40 storage/logs/laravel.log
