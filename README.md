После клонирования проекта
1) Скопируйте .env.example в .env и пропишите подключение к БД
2) composer install
3) php artisan migrate
4) php artisan db:seed --class=SantaSeeder

Для запроса санты и информации о его подопечном используется GET /api/santas/{santa}

В рамках выполнения задачния были созданы классы
database/migrations/2014_10_12_000000_create_santas_table.php
database/seeders/SantaSeeder.php
app/Models/Santa.php
app/Http/Controllers/SantaController.php
app/Http/Resources/SantaResource.php
