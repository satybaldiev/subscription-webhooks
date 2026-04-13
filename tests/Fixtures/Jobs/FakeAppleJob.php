<?php

namespace Axel\SubscriptionWebhooks\Tests\Fixtures\Jobs;

use Axel\SubscriptionWebhooks\Jobs\BaseAppleJob;

class FakeAppleJob extends BaseAppleJob
{
    public function handle(): void
    {
    }
}
