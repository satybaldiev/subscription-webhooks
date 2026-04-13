<?php

namespace Axel\SubscriptionWebhooks\Tests\Feature;

use Axel\SubscriptionWebhooks\Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

class WebhookFailureTest extends TestCase
{
    public function test_it_returns_an_error_and_logs_the_exception_when_the_job_class_is_missing(): void
    {
        Queue::fake();

        $response = $this->postJson('/webhooks/server/android', [
            'message' => [
                'messageId' => 'message-failure-1',
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

        $response->assertStatus(500);
        $response->assertJson([
            'error' => 'Could not process webhook because the configured job `subscription_renewed` does not exist.',
        ]);

        Queue::assertNothingPushed();

        $record = DB::table('subscription_notifications')->where('type', 'subscription_renewed')->first();

        $this->assertNotNull($record);
        $this->assertSame(
            'Could not process webhook because the configured job `subscription_renewed` does not exist.',
            $record->exception
        );
    }
}
