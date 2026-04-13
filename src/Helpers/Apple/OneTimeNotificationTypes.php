<?php

namespace Axel\SubscriptionWebhooks\Helpers\Apple;

use Axel\SubscriptionWebhooks\Helpers\StaticEnum;

class OneTimeNotificationTypes extends StaticEnum
{
    const ONE_TIME_CHARGE     = 'one_time_charge';
    const CONSUMPTION_REQUEST = 'consumption_request';
    const REFUND              = 'REFUND';
}
