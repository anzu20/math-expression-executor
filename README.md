# Исполнитель математических выражений

### Установка

#### Через Composer
Выполните команду

`composer require --dev anzu20/math-expression-executor`

Или добавьте 

`"anzu20/math-expression-executor": "*"`

в секцию require вашего файла `composer.json`

#### Вручную
Скачайте архив проекта и поместите содержимое каталога lib в ваш проект
Подключте автозагрузку

`require __DIR__ . '/autoload.php'; `


### Использование
Библиотека работает по нескольким принципам:
1. Выражение содержит только бинарные операции + - * /
2. Выражение содержит только однозначные числа
3. Выражение не содержит унарных операций (например, -1)

Пример использования:
```php
$expr = new RPNExecutor();
$expr->calculate('2+2+2');
```
