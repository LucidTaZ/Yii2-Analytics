Yii2 Analytics
==============

Yii2 bindings for LucidTaZ/Analytics.

USAGE
-----

Include the package using Composer:

```
composer require "lucidtaz/yii2-analytics"
```

Then configure `web.php` and `console.php` to include the module:

```php
$config = [
    ...
    'bootstrap' => ['analytics'],
    'modules' => [
        'analytics' => [
            'class' => 'lucidtaz\analytics\yii2\Module',
            'db' => /* optional db specification */,
        ],
        ...
    ],
    ...
];
```

Create the tables, during installation, by running the migration:

```
php yii migrate --migrationPath=@vendor/lucidtaz/yii2-analytics/src/migrations
```
