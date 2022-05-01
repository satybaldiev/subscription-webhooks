# Handle Appstore and Android server notifications

## Installation
You can install this package via composer

```bash
composer require axel/subscription-webhooks 
 ```

The service provider will register itself.
Publish the config and migration files with:

```bash
php artisan vendor:publish 
 ```
This is the config that will be published.
```php
return [

    'jobs' => [
        'apple'=>[
            // 'initial_buy' => \App\Jobs\AppstoreNotifications\HandleInitialBuy::class,
        ],
        'android'=>[
            // 'initial_buy' => \App\Jobs\AppstoreNotifications\HandleInitialBuy::class,
        ]
    ],
];
```
You should run migrate next to create the subscription_notifications table:

```bash
php artisan migrate
```

This packages registers a POST routes for Appstore and Android notifications to the WebhooksController of this package

## Usage
When there is an change in one of the subscriptions Apple will send a POST request to a configured endpoint.

[comment]: <> ([Follow this guide to configure the endpoint:]&#40;https://help.apple.com/app-store-connect/#/dev0067a330b&#41;)

This package will send a 200 response if you configured the right Job for the right Notification Type otherwise it will send a 500 back to Apple.
Apple will retry a couple of times more. The incoming payload is stored in the apple_notifications table.

### Handling incoming notifications via Jobs
You should extend AnyJobFile from BaseJob
```php
<?php

namespace App\Jobs\AppstoreNotifications;
use Axel\SubscriptionWebhooks\Jobs\BaseJob;

class AnyJobFile extends BaseJob
{
    public function handle()
    {
        // Do something that matches your business logic with $this->payload
    }
}
```

## Security

If you discover any security related issues, please email satybaldiev@gmail.com
## Credits

- [Daan Geurts](https://github.com/DaanGeurts)
- [Eduar Bastidas](https://github.com/mreduar)
- [All Contributors](../../contributors)

A big thanks to [App Vise](https://github.com/app-vise) laravel-appstore-notifications which was a huge inspiration and starting point for this package. Even README file was copied from them
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
