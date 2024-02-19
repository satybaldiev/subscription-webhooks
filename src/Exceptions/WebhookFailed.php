<?php

namespace Axel\SubscriptionWebhooks\Exceptions;

use Exception;

class WebhookFailed extends Exception
{

    public static function invalidPayload()
    {
        return new static("invalid payload", 501);
    }

    public static function jobClassDoesNotExist(string $jobClass)
    {
        return new static("Could not process webhook because the configured job `$jobClass` does not exist.", 501);
    }

    public static function notificationTypeDoesNotExist(string $notificationClass)
    {
        return new static("Could not process webhook because the configured job `$notificationClass` does not exist.", 501);
    }

    public function render($request)
    {
        return response(['error' => $this->getMessage()], 500);
    }
}
