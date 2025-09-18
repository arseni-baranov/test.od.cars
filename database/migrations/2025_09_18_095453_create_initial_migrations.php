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
        // positions
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // users
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('position_id')->constrained()->cascadeOnDelete();
        });

        // comfort categories
        Schema::create('comfort_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Первая, вторая и т.д.
            $table->timestamps();
        });

        // drivers
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // cars
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->foreignId('comfort_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('driver_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        // car_reservations
        Schema::create('car_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->timestamps();
        });

        // position_comfort_category (many-to-many)
        Schema::create('position_comfort_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->constrained()->cascadeOnDelete();
            $table->foreignId('comfort_category_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // car_reservations
        Schema::dropIfExists('car_reservations');

        // position_comfort_category (many-to-many)
        Schema::dropIfExists('position_comfort_category');

        // cars
        Schema::dropIfExists('cars');

        // users
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('position_id');
        });

        // positions
        Schema::dropIfExists('positions');

        // comfort categories
        Schema::dropIfExists('comfort_categories');

        // comfort categories
        Schema::dropIfExists('drivers');
    }
};
