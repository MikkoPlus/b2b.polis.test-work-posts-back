## Backend (Laravel API)

Этот модуль отвечает за REST API для работы со статьями и комментариями.

### Используемые технологии

- **Ядро**: Laravel 12 (PHP 8.2+)
- **База данных**: MySQL 8
- **ORM**: Eloquent
- **Статический анализ**: PHPStan + Larastan
- **Тестирование**: PHPUnit / `php artisan test`

### Основные сущности

- `Article`
    - `id`
    - `title`
    - `content`
    - `author_name`
    - временные метки `created_at`, `updated_at`
- `Comment`
    - `id`
    - `article_id`
    - `author_name`
    - `content`
    - временные метки `created_at`, `updated_at`

### API роуты

Базовый префикс для всех роутов: `/api`.

- **GET `/api/articles`**
    - Описание: получить список статей.
    - Ответ: массив статей без поля `updated_at`, упорядоченных по дате создания (новые сверху), ограничение по количеству (например, 20).

- **GET `/api/articles/{id}`**
    - Описание: получить одну статью и её комментарии.
    - Ответ JSON:
        - `article` — объект статьи без `comments` и `updated_at`.
        - `comments` — массив комментариев к статье без `updated_at`.

- **POST `/api/articles`**
    - Описание: создать новую статью.
    - Тело запроса (JSON):
        - `title`: string, required, max:255
        - `content`: string, required
        - `author_name`: string, required, max:255
    - Ответ: созданная статья (HTTP 201).

- **POST `/api/articles/{id}/comments`**
    - Описание: добавить комментарий к статье.
    - Тело запроса (JSON):
        - `author_name`: string, required, max:255
        - `content`: string, required
    - Ответ: созданный комментарий (HTTP 201).

### Проверка качества и тесты

```bash
vendor/bin/phpstan analyse
php artisan test
```
