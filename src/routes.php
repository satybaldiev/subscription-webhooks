<?php

use Illuminate\Support\Facades\Route;

Route::post('/webhooks/server/ios', [\Axel\SubscriptionWebhooks\WebhookController::class,'ios']);
Route::post('/webhooks/server/android', [\Axel\SubscriptionWebhooks\WebhookController::class,'android']);
