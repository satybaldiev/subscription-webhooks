<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('subscription_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('source');
            $table->string('type');
            $table->text('payload')->nullable();
            $table->text('exception')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscription_notifications');
    }
}
