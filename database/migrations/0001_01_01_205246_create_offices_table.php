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
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->json('ministry_name');
            $table->json('office_name');
            $table->json('upazila')->nullable();
            $table->json('district');
            $table->string('ministry_code');
            $table->string('office_level_code')->default('00');
            $table->string('geo_code')->nullable();
            $table->string('ddo_code')->nullable();
            $table->integer('section')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};
