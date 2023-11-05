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
        Schema::create('card_signs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('card_id');
            $table->unsignedInteger('user_id');
            $table->string('message')->nullable();
            $table->string('custom_name')->nullable();
            $table->unsignedInteger('font_family_id');
            $table->enum('status', [
                'active',
                'inactive',
            ]);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_signs');
    }
};
