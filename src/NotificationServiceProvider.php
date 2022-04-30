<?php
namespace Axel\SubscriptionWebhooks;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/subscription-webhooks.php' => config_path('subscription-webhooks.php'),
            ], 'config');
        }
        if (!$this->migrationExists('create_subscription_notifications_table')) {
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__.'/../database/migrations/create_subscription_notifications_table.php' => database_path("migrations/{$timestamp}_create_subscription_notifications_table.php"),
            ], 'migrations');
        }

        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    protected function migrationExists($mgr)
    {
        $path = database_path('migrations/');
        $files = scandir($path);
        $pos = false;
        foreach ($files as &$value) {
            $pos = strpos($value, $mgr);
            if($pos !== false) return true;
        }
        return false;
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/subscription-webhooks.php', 'subscription-webhooks');
    }
}
