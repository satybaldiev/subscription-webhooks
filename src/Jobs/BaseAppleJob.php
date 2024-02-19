<?php

namespace Axel\SubscriptionWebhooks\Jobs;


use Axel\SubscriptionWebhooks\Helpers\Apple\NotificationPayload;

class BaseAppleJob extends BaseJob
{
    public function __construct(NotificationPayload $payload)
    {
        parent::__construct($payload);
    }
}
