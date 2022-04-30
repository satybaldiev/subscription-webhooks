<?php

namespace Axel\SubscriptionWebhooks\Helpers;

use Axel\SubscriptionWebhooks\Exceptions\WebhookFailed;
use Illuminate\Http\Request;

class NotificationPayload extends BaseJsonClass
{
    private $notificationType;
    private $subType;
    private $notificationUUID;
    private $data;
    private $payload;

    public static function parse(Request $request): NotificationPayload
    {
        $payload                    = decodePayload($request->get('signedPayload'));
        $instance                   = new self();
        $instance->payload          = $request->getContent();
        $instance->notificationType = $payload->notificationType;
        $instance->subType          = $payload->subtype ?? null;
        $instance->notificationUUID = $payload->notificationUUID;
        $instance->data             = NotificationData::parse($payload->data);
        return $instance;

    }

    /**
     * @return mixed
     */
    public function getNotificationType()
    {
        return $this->notificationType;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @return mixed
     */
    public function getSubType()
    {
        return $this->subType;
    }

    /**
     * @return mixed
     */
    public function getNotificationUUID()
    {
        return $this->notificationUUID;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
