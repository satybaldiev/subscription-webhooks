<?php

namespace Axel\SubscriptionWebhooks\Tests\Fixtures\Jobs;

use Axel\SubscriptionWebhooks\Jobs\BaseGoogleJob;

class FakeGoogleJob extends BaseGoogleJob
{
    public function handle(): void
    {
    }
}
