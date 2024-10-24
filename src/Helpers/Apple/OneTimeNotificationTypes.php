<?php

namespace Axel\SubscriptionWebhooks\Helpers\Apple;

use BenSampo\Enum\Enum;

class OneTimeNotificationTypes extends Enum
{
    const ONE_TIME_CHARGE     = 'one_time_charge';
    const CONSUMPTION_REQUEST = 'consumption_request';
    const REFUND              = 'REFUND';
}
