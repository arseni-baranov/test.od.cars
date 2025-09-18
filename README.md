# 🚀 Laravel Docker Project — Развёртывание

## Шаг 1. Клонирование репозитория

```bash
git clone git@github.com:arseni-baranov/test.od.cars.git
cd test.od.cars.git
```

## Шаг 2. Настройка окружения

```bash
cp .env.example .env
```

При необходимости настройте UID и GID в .env:

```bash
id -u  # UID
id -g  # GID
```

## Шаг 4. Установка зависимостей Laravel

```bash
docker compose -f compose.dev.yaml exec workspace bash
composer install
npm install
npm run dev
```

## Шаг 5. Применение миграций

```bash
docker compose -f compose.dev.yaml exec workspace php artisan migrate
```

## Шаг 6. Доступ к приложению

Откройте браузер и перейдите по адресу:
http://localhost

