<?php

namespace Axel\SubscriptionWebhooks\Helpers\Google;


use Axel\SubscriptionWebhooks\Enum\DeviceTypes;
use Axel\SubscriptionWebhooks\Helpers\BaseJsonClass;

class TestNotification extends BaseJsonClass
{
    private string $version;

    public static function parse($testNotification): self
    {
        $instance          = new self();
        $instance->version = $testNotification->version;

        return $instance;
    }

    public function getVersion(): string {
        return $this->version;
    }
}
