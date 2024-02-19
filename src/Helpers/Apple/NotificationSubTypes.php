<?php

namespace Axel\SubscriptionWebhooks\Helpers\Apple;

class NotificationSubTypes
{
    const INITIAL_BUY          = 'INITIAL_BUY';
    const RESUBSCRIBE          = 'RESUBSCRIBE';
    const DOWNGRADE            = 'DOWNGRADE';
    const UPGRADE              = 'UPGRADE';
    const AUTO_RENEW_ENABLED   = 'AUTO_RENEW_ENABLED';
    const AUTO_RENEW_DISABLED  = 'AUTO_RENEW_DISABLED';
    const VOLUNTARY            = 'VOLUNTARY';
    const BILLING_RETRY        = 'BILLING_RETRY';
    const PRICE_INCREASE       = 'PRICE_INCREASE';
    const PRODUCT_NOT_FOR_SALE = 'PRODUCT_NOT_FOR_SALE';
    const GRACE_PERIOD         = 'GRACE_PERIOD';
    const BILLING_RECOVERY     = 'BILLING_RECOVERY';
    const PENDING              = 'PENDING';
    const ACCEPTED             = 'ACCEPTED';
}
