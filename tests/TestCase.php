<?php

namespace Axel\SubscriptionWebhooks\Tests;

use Axel\SubscriptionWebhooks\NotificationServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            NotificationServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('subscription_notifications');
        Schema::create('subscription_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('source');
            $table->string('type');
            $table->text('payload')->nullable();
            $table->text('exception')->nullable();
            $table->timestamps();
        });
    }
}
