    <p align="center">
        <h1 align="center">Fastlogs symfony</h1>
        <br>
    </p>

Требования
------------

PHP 5.6+, установленные расширения json и curl.

Установка
---------------

Требуется symfony/monolog-bundle ^3.0.0!!

1. Добавить в composer.json репозиторий:
```bash
{
    ....
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/King-Bird-Studio/fastlogs-sdk-php.git"
        },
        {
            "type": "vcs",
            "url": "https://github.com/King-Bird-Studio/fastlogs-sdk-symfony.git"
        }
    ],
    .....
}
```
2. Подключить к проекту:
```bash
composer require fastlogs/symfony-bundle:dev-master
```

3. Создать фаил конигурации config/packages/fastlogs.yaml

4. Добавить в созданный файл конфигурацию
```bash
fastlogs:
  slug: you slug Fastlogs
  channel: ["!event"]
  level: error
```

Использование
------------

Если нужно залогировать только в сервис:

```php
use  fastlogs\FastlogsBundle\Fastlogs;

$data = [123, 456, 'sldfkjsf'];
$this->fastlogs->add($data);
```

Если нужно писать в отдельный лог:

```php
use  fastlogs\FastlogsBundle\Fastlogs;

$data = [123, 456, 'sldfkjsf'];
$this->fastlogs->add($data, 'jQpUFtifBZ');
```
