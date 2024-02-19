<?php

namespace Axel\SubscriptionWebhooks\Helpers\Google;


use Axel\SubscriptionWebhooks\Enum\DeviceTypes;
use Axel\SubscriptionWebhooks\Helpers\BaseJsonClass;

class SubscriptionNotification extends BaseJsonClass
{
    private string $version;
    private mixed $notificationType;
    private string $purchaseToken;
    private string $subscriptionId;

    public static function parse($subscriptionNotification): self
    {
        $instance                   = new self();
        $instance->version          = $subscriptionNotification->version;
        $instance->notificationType = $subscriptionNotification->notificationType;
        $instance->purchaseToken    = $subscriptionNotification->purchaseToken;
        $instance->subscriptionId   = $subscriptionNotification->subscriptionId;

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

    public function getSubscriptionId(): string {
        return $this->subscriptionId;
    }
}
