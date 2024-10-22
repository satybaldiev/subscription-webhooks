<?php

namespace Axel\SubscriptionWebhooks\Helpers\Google;
use BenSampo\Enum\Enum;

class OneTimeNotificationTypes extends Enum
{
    const JOBS = [
        1 => 'one_time_product_purchased',
        2 => 'one_time_product_canceled',
    ];
}
