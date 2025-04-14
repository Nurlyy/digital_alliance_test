# Простой API-проект для управления задачами.

# База данных: MySQL, можно поменять в .env а так же phpunit.xml для тестов.


# -- Установка --

# Устанавливаем зависимости
composer install

# Копируем и настраиваем окружение
cp .env.example .env
php artisan key:generate

# Выполняем миграции
php artisan migrate

# Запускаем тесты
php artisan test --filter=TaskPriorityTest