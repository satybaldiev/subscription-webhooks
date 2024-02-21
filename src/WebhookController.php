<?php
namespace Axel\SubscriptionWebhooks;
use Axel\SubscriptionWebhooks\Enum\DeviceTypes;
use Axel\SubscriptionWebhooks\Exceptions\WebhookFailed;
use Axel\SubscriptionWebhooks\Helpers\Apple\NotificationPayload;
use Axel\SubscriptionWebhooks\Helpers\Google\NotificationPayload as GoogleNotificationPayload;
use Axel\SubscriptionWebhooks\Helpers\Apple\NotificationTypes;
use Axel\SubscriptionWebhooks\Helpers\Google\NotificationTypes as GoogleNotificationTypes;
use Axel\SubscriptionWebhooks\Models\SubscriptionNotification;
use Illuminate\Http\Request;

class WebhookController
{
    public function ios(Request $request){
        $jobKey = null;
        $log = null;
        try {
            $payload = NotificationPayload::parse($request);
            $jobKey = NotificationTypes::{$payload->getNotificationType()}();

            $log = SubscriptionNotification::storeNotification(DeviceTypes::APPLE, $jobKey, $request->getContent());

            $jobClass = config("subscription-webhooks.jobs." . DeviceTypes::APPLE . ".{$jobKey}", null);
            if (is_null($jobClass) || !class_exists($jobClass)) {
                throw WebhookFailed::jobClassDoesNotExist($jobKey);
            }
            $job = new $jobClass($payload);
            dispatch($job);
            return response()->json();
        }
        catch (\Exception $exception){
            if ($log){
                $log->exception = $exception->getMessage();
                $log->save();
            }
            else{
                SubscriptionNotification::storeException(DeviceTypes::APPLE, $jobKey ?? 'unknown', $request->getContent(),$exception->getMessage());
            }
            throw $exception;
        }


    }
    public function android(Request $request) {
        $jobKey = null;
        $log = null;
        try {
            $payload = GoogleNotificationPayload::parse($request);

            if (!$payload->getData()->getSubscriptionNotification()) {
                throw WebhookFailed::notificationTypeDoesNotExist($payload->getNotificationType());
            }

            $jobKey = GoogleNotificationTypes::JOBS[$payload->getData()->getSubscriptionNotification()->getNotificationType()];
            $log = SubscriptionNotification::storeNotification(DeviceTypes::ANDROID, $jobKey, $request->getContent());

            $jobClass = config("subscription-webhooks.jobs." . DeviceTypes::ANDROID . ".{$jobKey}", null);
            if (is_null($jobClass) || !class_exists($jobClass)) {
                throw WebhookFailed::jobClassDoesNotExist($jobKey);
            }
            $job = new $jobClass($payload);
            dispatch($job);
            return response()->json();
        }
        catch (\Exception $exception){
            if ($log){
                $log->exception = $exception->getMessage();
                $log->save();
            }
            else{
                SubscriptionNotification::storeException(DeviceTypes::ANDROID, $jobKey ?? 'unknown', $request->getContent(), $exception->getMessage());
            }
            throw $exception;
        }
    }


}
