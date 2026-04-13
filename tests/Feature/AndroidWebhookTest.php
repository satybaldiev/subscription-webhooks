<?php

namespace Axel\SubscriptionWebhooks\Tests\Feature;

use Axel\SubscriptionWebhooks\Tests\TestCase;
use Illuminate\Support\Facades\DB;

class AndroidWebhookTest extends TestCase
{
    public function test_it_accepts_test_notifications_and_logs_them(): void
    {
        $encodedNotification = base64_encode(json_encode([
            'version' => '1.0',
            'packageName' => 'com.example.app',
            'eventTimeMillis' => '1710000000000',
            'testNotification' => [
                'version' => '1.0',
            ],
        ], JSON_THROW_ON_ERROR));

        $response = $this->postJson('/webhooks/server/android', [
            'message' => [
                'messageId' => 'message-1',
                'data' => $encodedNotification,
            ],
        ]);

        $response->assertOk();

        $this->assertDatabaseHas('subscription_notifications', [
            'source' => 'android',
            'type' => 'test',
        ]);

        $record = DB::table('subscription_notifications')->first();

        $this->assertNotNull($record);
        $this->assertStringContainsString('message-1', $record->payload);
    }
}
