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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('airline');
            $table->string('airline_code', 5);
            $table->integer('flight_number');
            $table->string('origin', 3);
            $table->string('destination', 3);
            $table->integer('available_seats');
            $table->decimal('price', 10, 2);
            $table->dateTime('departure');
            $table->dateTime('arrival');
            $table->string('duration');
            $table->json('operational_days');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
