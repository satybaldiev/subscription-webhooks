<?php

namespace Axel\SubscriptionWebhooks\Tests\Feature;

use Axel\SubscriptionWebhooks\Helpers\Apple\NotificationPayload as AppleNotificationPayload;
use Axel\SubscriptionWebhooks\Helpers\Google\NotificationPayload as GoogleNotificationPayload;
use Axel\SubscriptionWebhooks\Tests\Fixtures\Jobs\FakeAppleJob;
use Axel\SubscriptionWebhooks\Tests\Fixtures\Jobs\FakeGoogleJob;
use Axel\SubscriptionWebhooks\Tests\TestCase;
use Illuminate\Support\Facades\Queue;

class QueuedWebhookDispatchTest extends TestCase
{
    public function test_it_queues_the_configured_android_job_for_subscription_notifications(): void
    {
        Queue::fake();

        config()->set('subscription-webhooks.jobs.android.subscription_renewed', FakeGoogleJob::class);

        $response = $this->postJson('/webhooks/server/android', [
            'message' => [
                'messageId' => 'message-android-1',
                'data' => base64_encode(json_encode([
                    'version' => '1.0',
                    'packageName' => 'com.example.app',
                    'eventTimeMillis' => '1710000000000',
                    'subscriptionNotification' => [
                        'version' => '1.0',
                        'notificationType' => 2,
                        'purchaseToken' => 'purchase-token',
                        'subscriptionId' => 'monthly-plan',
                    ],
                ], JSON_THROW_ON_ERROR)),
            ],
        ]);

        $response->assertOk();

        Queue::assertPushed(FakeGoogleJob::class, function (FakeGoogleJob $job): bool {
            return $job->payload instanceof GoogleNotificationPayload
                && $job->payload->getData()->getSubscriptionNotification()->getSubscriptionId() === 'monthly-plan';
        });

        $this->assertDatabaseHas('subscription_notifications', [
            'source' => 'android',
            'type' => 'subscription_renewed',
        ]);
    }

    public function test_it_queues_the_configured_apple_job_for_subscription_notifications(): void
    {
        Queue::fake();

        config()->set('subscription-webhooks.jobs.apple.subscribed', FakeAppleJob::class);

        $response = $this->postJson('/webhooks/server/ios', [
            'signedPayload' => $this->makeAppleJwt([
                'notificationType' => 'SUBSCRIBED',
                'notificationUUID' => 'notification-uuid-1',
                'version' => '2.0',
                'data' => [
                    'bundleId' => 'com.example.app',
                    'bundleVersion' => '1',
                    'environment' => 'Sandbox',
                    'signedTransactionInfo' => $this->makeAppleJwt([
                        'transactionId' => 'transaction-1',
                        'originalTransactionId' => 'original-transaction-1',
                        'bundleId' => 'com.example.app',
                        'productId' => 'monthly-plan',
                        'purchaseDate' => 1710000000000,
                        'originalPurchaseDate' => 1710000000000,
                        'expiresDate' => 1712592000000,
                        'quantity' => 1,
                        'type' => 'Auto-Renewable Subscription',
                        'environment' => 'Sandbox',
                        'signedDate' => 1710000000000,
                        'webOrderLineItemId' => 'line-item-1',
                    ]),
                    'signedRenewalInfo' => $this->makeAppleJwt([
                        'originalTransactionId' => 'original-transaction-1',
                        'autoRenewProductId' => 'monthly-plan',
                        'productId' => 'monthly-plan',
                        'autoRenewStatus' => 1,
                        'signedDate' => 1710000000000,
                        'environment' => 'Sandbox',
                    ]),
                ],
            ]),
        ]);

        $response->assertOk();

        Queue::assertPushed(FakeAppleJob::class, function (FakeAppleJob $job): bool {
            return $job->payload instanceof AppleNotificationPayload
                && $job->payload->getNotificationType() === 'SUBSCRIBED'
                && $job->payload->getData()->getTransactionInfo()->getProductId() === 'monthly-plan';
        });

        $this->assertDatabaseHas('subscription_notifications', [
            'source' => 'apple',
            'type' => 'subscribed',
        ]);
    }

    private function makeAppleJwt(array $payload): string
    {
        return implode('.', [
            base64_encode(json_encode(['alg' => 'none', 'typ' => 'JWT'], JSON_THROW_ON_ERROR)),
            base64_encode(json_encode($payload, JSON_THROW_ON_ERROR)),
            'signature',
        ]);
    }
}
