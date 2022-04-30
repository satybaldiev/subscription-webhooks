<?php
namespace Axel\SubscriptionWebhooks;
use Axel\SubscriptionWebhooks\Exceptions\WebhookFailed;
use Axel\SubscriptionWebhooks\Helpers\NotificationPayload;
use Axel\SubscriptionWebhooks\Helpers\NotificationTypes;
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

            $log = SubscriptionNotification::storeNotification('apple',$jobKey, $request->getContent());

            $jobClass = config("subscription-webhooks.jobs.apple.{$jobKey}", null);
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
                SubscriptionNotification::storeException('apple',$jobKey ?? 'unknown', $request->getContent(),$exception->getMessage());
            }
            throw $exception;
        }


    }
    public function android(Request $request){

    }


}
