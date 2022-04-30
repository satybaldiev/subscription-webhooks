<?php

namespace Axel\SubscriptionWebhooks\Helpers;

use JsonSerializable;

class BaseJsonClass implements JsonSerializable
{
    public function jsonSerialize(): array
    {
        $json = [];
        foreach($this as $key => $value) {
            $json[$key] = $value;
        }
        return $json;
    }
}