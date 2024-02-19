<?php

namespace Axel\SubscriptionWebhooks\Jobs;

use Axel\SubscriptionWebhooks\Helpers\Apple\NotificationPayload as NotificationApplePayload;
use Axel\SubscriptionWebhooks\Helpers\Google\NotificationPayload as NotificationGooglePayload;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public NotificationApplePayload|NotificationGooglePayload $payload;

    public function __construct(NotificationApplePayload|NotificationGooglePayload $payload)
    {
        $this->payload = $payload;
    }
}
