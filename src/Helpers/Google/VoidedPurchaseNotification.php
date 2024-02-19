<?php

namespace Axel\SubscriptionWebhooks\Helpers\Google;


use Axel\SubscriptionWebhooks\Enum\DeviceTypes;
use Axel\SubscriptionWebhooks\Helpers\BaseJsonClass;

class VoidedPurchaseNotification extends BaseJsonClass
{
    private string $orderId;
    private string $purchaseToken;
    private mixed $productType;

    public static function parse($voidedPurchaseNotification): self
    {
        $instance                = new self();
        $instance->orderId       = $voidedPurchaseNotification->orderId;
        $instance->purchaseToken = $voidedPurchaseNotification->purchaseToken;
        $instance->productType   = $voidedPurchaseNotification->productType;

        return $instance;
    }

    public function getOrderId(): string {
        return $this->orderId;
    }

    public function getPurchaseToken(): string {
        return $this->purchaseToken;
    }

    public function getProductType(): mixed {
        return $this->productType;
    }
}
