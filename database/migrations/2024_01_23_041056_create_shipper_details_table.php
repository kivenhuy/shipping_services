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
        Schema::create('shipper_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('vehicle')->nullable();
            $table->string('license_plates')->nullable();
            $table->string('vehicle_image')->nullable();
            $table->string('driver_license')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipper_details');
    }
};
