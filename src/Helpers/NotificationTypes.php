<?php

namespace Axel\SubscriptionWebhooks\Helpers;
use BenSampo\Enum\Enum;

class NotificationTypes extends Enum
{
    const CONSUMPTION_REQUEST       = 'consumption_request';
    const DID_CHANGE_RENEWAL_PREF   = 'did_change_renewal_pref';
    const DID_CHANGE_RENEWAL_STATUS = 'did_change_renewal_status';
    const DID_FAIL_TO_RENEW         = 'did_fail_to_renew';
    const DID_RENEW                 = 'did_renew';
    const EXPIRED                   = 'expired';
    const GRACE_PERIOD_EXPIRED      = 'grace_period_expired';
    const OFFER_REDEEMED            = 'offer_redeemed';
    const PRICE_INCREASE            = 'price_increase';
    const REFUND                    = 'refund';
    const REFUND_DECLINED           = 'refund_declined';
    const RENEWAL_EXTENDED          = 'renewal_extended';
    const REVOKE                    = 'revoke';
    const SUBSCRIBED                = 'subscribed';
    const TEST                      = 'test';
}