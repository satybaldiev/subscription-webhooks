<?php

namespace Axel\SubscriptionWebhooks\Helpers\Google;


use Axel\SubscriptionWebhooks\Helpers\BaseJsonClass;

class OneTimeProductNotification extends BaseJsonClass
{
    private string $version;
    private mixed $notificationType;
    private string $purchaseToken;
    private string $sku;

    public static function parse($oneTimeProductNotification): self
    {
        $instance                   = new self();
        $instance->version          = $oneTimeProductNotification->version;
        $instance->notificationType = $oneTimeProductNotification->notificationType;
        $instance->purchaseToken    = $oneTimeProductNotification->purchaseToken;
        $instance->sku              = $oneTimeProductNotification->sku;

        return $instance;
    }

    public function getVersion(): string {
        return $this->version;
    }

    public function getNotificationType(): mixed {
        return $this->notificationType;
    }

    public function getPurchaseToken(): string {
        return $this->purchaseToken;
    }

    public function getSku(): string {
        return $this->sku;
    }
}
