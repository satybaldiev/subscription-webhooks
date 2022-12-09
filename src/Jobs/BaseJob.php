<?php

namespace Axel\SubscriptionWebhooks\Jobs;

use Axel\SubscriptionWebhooks\Helpers\NotificationData;
use Axel\SubscriptionWebhooks\Helpers\NotificationPayload;
use Axel\SubscriptionWebhooks\Helpers\RenewalInfo;
use Axel\SubscriptionWebhooks\Helpers\TransactionInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public NotificationPayload $payload;

    public function __construct(NotificationPayload $payload)
    {
        $this->payload = $payload;
    }
}
