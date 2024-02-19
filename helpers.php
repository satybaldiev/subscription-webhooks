<?php

use Axel\SubscriptionWebhooks\Enum\DeviceTypes;

if (!function_exists('decodePayload')) {
    /**
     * @throws ReflectionException
     */
    function decodePayload(string $payload, string $type) : mixed
    {
        if (!in_array($type, DeviceTypes::getAll())) {
            return throw new Exception("INVALID DEVICE TYPE");
        }
        $data = null;
        switch ($type) {
            case DeviceTypes::APPLE:
                $tokenParts = explode(".", $payload);
                $data = base64_decode($tokenParts[1]);
                break;
            case DeviceTypes::GOOGLE:
                $data = base64_decode($payload);
                break;
        }

        return json_decode($data);
    }
}
