<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_provider_id')
                ->constrained('subscription_providers')
                ->onDelete('cascade');
            $table->string('name'); // Event name (e.g., subscription_started)
            $table->string('category'); // Will be cast to enum in the model
            $table->integer('notification_type'); // Google notification type (1,2,3, etc.)
            $table->boolean('in_trial')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_events');
    }
};
