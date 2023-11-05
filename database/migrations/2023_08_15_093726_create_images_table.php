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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('path');
            $table->string('alt_text');
            $table->unsignedInteger('width');
            $table->unsignedInteger('height');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('parent_id');
            $table->unsignedInteger('imageable_id');
            $table->string('imageable_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
