# Тестовое задание для разработчика на PHP
Для этого задания было использовано урезанная версия фреймворка Laravel с базовой поддержкой Http, Routing, Request.

## Зависимости

[composer.json](composer.json)

- PHP 8.2
- Laravel Framework 10
- Laravel Pint 1
- PHPUnit 10
- Faker 1.23

## Директории
[App](/app) - основная логика/решение находится в этой директории

[Core](/core) - Базовые классы и классы самого фреймворка лежат здесь

[Tests](/tests) - Были добавлены feature тесты

[Docker](/docker) - Базовый образ для сборки и запуска приложения через докер

## Решение

1. **Валидация запроса** была перенесена в класс [OperationRequest](/app/Http/Requests/V1/OperationRequest.php)
2. **Логика отправки сообщений** и формирования ответа перенесена в класс [OperationHandler](/app/Handlers/V1/OperationHandler.php)
3. **Ответ запроса** в виде ресурса была перенесена в класс [OperationResource](/app/Http/Resources/V1/OperationResource.php)

## Запуск приложения

Запускаем через [docker-compose](docker-compose.yml)
```shell
docker-compose up -d
```

## Линтеры

- Laravel Pint ([pint.json](pint.json))
```shell
vendor/bin/pint.json --config pint.json
```

- PHPUnit Tests
```shell
vendor/bin/phpunit
```

## Тестовый запрос

```http request
POST http://localhost/api/v1/operate
Content-Type: application/json

{
  "data": {
    "resellerId": 1,
    "notificationType": 2,
    "clientId": 1,
    "creatorId": 1,
    "expertId": 1,
    "differences": {
      "from": 1,
      "to": 2
    },
    "complaintId": 1,
    "complaintNumber": "111",
    "consumptionId": 1,
    "consumptionNumber": "111",
    "agreementNumber": "222",
    "date": "2020-01-01"
  }
}
```

Пример ответа:

```json
{
  "message": "Notifications are successfully sent",
  "data": {
    "notificationEmployeeByEmail": true,
    "notificationClientByEmail": true,
    "notificationClientBySms": {
      "isSent": true,
      "message": null
    }
  }
}
```
