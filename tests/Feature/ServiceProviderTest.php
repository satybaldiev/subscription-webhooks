<?php

namespace Axel\SubscriptionWebhooks\Tests\Feature;

use Axel\SubscriptionWebhooks\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    public function test_it_registers_expected_routes(): void
    {
        $routes = collect($this->app['router']->getRoutes()->getRoutesByMethod()['POST']);

        $this->assertTrue($routes->has('webhooks/server/ios'));
        $this->assertTrue($routes->has('webhooks/server/android'));
    }

    public function test_it_merges_default_configuration(): void
    {
        $this->assertSame([], config('subscription-webhooks.jobs.apple'));
        $this->assertSame([], config('subscription-webhooks.jobs.android'));
    }
}
