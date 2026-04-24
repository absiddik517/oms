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
        Schema::create('recipientables', function (Blueprint $table) {
            $table->id();

            $table->foreignId('recipient_id')
                ->constrained('recipients')
                ->onDelete('cascade');

            $table->morphs('recipientable');

            $table->enum('type', ['to', 'cc']);

            $table->timestamps();

            $table->index(['recipientable_type', 'recipientable_id', 'type']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipientables');
    }
};
