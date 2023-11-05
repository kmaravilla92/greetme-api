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
        Schema::create('card_template_parts', function (Blueprint $table) {
            $table->id();
            $table->enum('name', [
                'cover_image',
                'cover_back_image',
                'inside_image',
                'inside_note',
                'back_image',
                'back_note',
            ]);
            $table->unsignedInteger('image_id');
            $table->enum('status', [
                'active',
                'inactive',
            ]);
            $table->unsignedInteger('card_template_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_template_parts');
    }
};
