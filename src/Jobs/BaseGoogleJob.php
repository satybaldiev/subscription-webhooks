<?php

namespace Axel\SubscriptionWebhooks\Jobs;


use Axel\SubscriptionWebhooks\Helpers\Google\NotificationPayload;

class BaseGoogleJob extends BaseJob
{
    public function __construct(NotificationPayload $payload)
    {
        parent::__construct($payload);
    }
}
