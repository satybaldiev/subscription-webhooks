<?php

namespace Axel\SubscriptionWebhooks\Helpers\Google;


use Axel\SubscriptionWebhooks\Helpers\BaseJsonClass;
use Illuminate\Http\Request;

class NotificationPayload extends BaseJsonClass
{
    private string $messageId;
    private array $attributes;
    private string $payload;
    private NotificationData $data;

    public static function parse(Request $request): self
    {
        $payload              = collect($request->get('message'));
        $instance             = new self();
        $instance->payload    = $request->getContent();
        $instance->messageId  = $payload['messageId'];
        $instance->attributes = $payload['attributes'] ?? [];
        $instance->data       = NotificationData::parse($payload['data']);

        return $instance;

    }

    public function getMessageId(): string
    {
        return $this->messageId;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getPayload(): string
    {
        return $this->payload;
    }

    public function getData(): NotificationData
    {
        return $this->data;
    }

    public function getNotificationType(): string {
        $notificationType = $this->data->getTestNotification();
        if ($this->data->getVoidedPurchaseNotification()) {
            $notificationType = $this->data->getVoidedPurchaseNotification();
        }
        else if ($this->data->getOneTimeProductNotification()) {
            $notificationType = $this->data->getOneTimeProductNotification();
        }

        return !$notificationType ? 'unknown notification class' : get_class($notificationType);
    }
}
