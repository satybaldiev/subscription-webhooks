<?php

namespace Axel\SubscriptionWebhooks\Helpers\Apple;


use Axel\SubscriptionWebhooks\Enum\DeviceTypes;
use Axel\SubscriptionWebhooks\Helpers\BaseJsonClass;
use Illuminate\Http\Request;

class NotificationPayload extends BaseJsonClass
{
    private                  $notificationType;
    private                  $subType;
    private                  $notificationUUID;
    private NotificationData $data;
    private                  $payload;
    private                  $version;

    public static function parse(Request $request): self
    {
        $payload                    = decodePayload($request->get('signedPayload'), DeviceTypes::APPLE);
        $instance                   = new self();
        $instance->payload          = $request->getContent();
        $instance->notificationType = $payload->notificationType;
        $instance->subType          = $payload->subtype ?? null;
        $instance->notificationUUID = $payload->notificationUUID;
        $instance->version          = $payload->version;
        $instance->data             = NotificationData::parse($payload->data);

        return $instance;

    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
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
     * @return NotificationData
     */
    public function getData(): NotificationData
    {
        return $this->data;
    }
}
