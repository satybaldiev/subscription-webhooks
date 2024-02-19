<?php

namespace Axel\SubscriptionWebhooks\Helpers\Google;


use Axel\SubscriptionWebhooks\Enum\DeviceTypes;
use Axel\SubscriptionWebhooks\Helpers\BaseJsonClass;

class NotificationData extends BaseJsonClass
{
    private string $version;
    private string $packageName;
    private mixed $eventTimeMillis;
    private OneTimeProductNotification|null $oneTimeProductNotification;
    private SubscriptionNotification|null $subscriptionNotification;
    private VoidedPurchaseNotification|null $voidedPurchaseNotification;
    private TestNotification|null $testNotification;

    public static function parse($data) : self
    {
        $data                      = decodePayload($data, DeviceTypes::GOOGLE);
        $instance                  = new self();
        $instance->version         = $data->version;
        $instance->packageName     = $data->packageName;
        $instance->eventTimeMillis = $data->eventTimeMillis;
        $instance->oneTimeProductNotification = isset($data->oneTimeProductNotification) ? OneTimeProductNotification::parse($data->oneTimeProductNotification) : null;
        $instance->subscriptionNotification   = isset($data->subscriptionNotification) ? SubscriptionNotification::parse($data->subscriptionNotification) : null;
        $instance->voidedPurchaseNotification = isset($data->voidedPurchaseNotification) ? VoidedPurchaseNotification::parse($data->voidedPurchaseNotification) : null;
        $instance->testNotification           = isset($data->testNotification) ? TestNotification::parse($data->testNotification) : null;

        return $instance;
    }

    public function getVersion(): string {
        return $this->version;
    }

    public function getPackageName(): string {
        return $this->packageName;
    }

    public function getEventTimeMillis(): mixed {
        return $this->eventTimeMillis;
    }

    public function getSubscriptionNotification(): SubscriptionNotification|null {
        return $this->subscriptionNotification;
    }

    public function getOneTimeProductNotification(): OneTimeProductNotification|null {
        return $this->oneTimeProductNotification;
    }

    public function getVoidedPurchaseNotification(): VoidedPurchaseNotification|null {
        return $this->voidedPurchaseNotification;
    }

    public function getTestNotification(): TestNotification|null {
        return $this->testNotification;
    }

}
