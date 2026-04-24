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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->string('file_name')->nullable();
            $table->string('file_type')->nullable(); // pdf, image, doc
            $table->unsignedBigInteger('file_size')->nullable(); // bytes

            $table->string('disk')->default('public'); // storage disk

            $table->foreignId('uploaded_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->index('file_type');
            $table->timestamps();
        });


        Schema::create('attachables', function (Blueprint $table) {
            $table->id();

            $table->foreignId('attachment_id')
                ->constrained('attachments')
                ->cascadeOnDelete();

            // polymorphic relation
            $table->morphs('attachable');

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
        Schema::dropIfExists('attachables');
    }
};
