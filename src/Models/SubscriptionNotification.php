<?php

namespace Axel\SubscriptionWebhooks\Models;

use Axel\SubscriptionWebhooks\Helpers\NotificationPayload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SubscriptionNotification extends Model
{
    public $guarded = [];

    protected $casts = [
        'payload' => 'array',
    ];

    public static function storeNotification($source,string $notificationType, string $notificationPayload)
    {

        if (Schema::hasTable('subscription_notifications')) {
            return self::create(
                [
                    'source'    => $source,
                    'type'    => $notificationType,
                    'payload' => $notificationPayload,
                ]
            );
        }
    }
    public static function storeException($source,string $notificationType, string $notificationPayload, $exception)
    {

        if (Schema::hasTable('subscription_notifications')) {
            return self::create(
                [
                    'source'    => $source,
                    'type'    => $notificationType,
                    'payload' => $notificationPayload,
                    'exception' => $exception,
                ]
            );
        }
    }
}
