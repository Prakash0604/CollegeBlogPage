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
        Schema::create('event_management', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Name of the event (e.g., "Sports Week")
            $table->string('type'); // Type of event (e.g., sports, tour, etc.)
            $table->text('description')->nullable(); // Description of the event
            $table->date('start_date'); // Event start date
            $table->date('end_date'); // Event end date
            $table->string('location')->nullable(); // Event location (e.g., stadium, park)
            $table->json('additional_info')->nullable(); // Additional dynamic event data (e.g., teams, itinerary)
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_management');
    }
};
