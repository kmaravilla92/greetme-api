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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('card_template_id');
            $table->enum('type', [
                'individual',
                'group',
            ]);
            $table->string('receiver_name');
            $table->string('receiver_email');
            $table->unsignedInteger('user_id');
            $table->enum('status', [
                'active',
                'inactive',
            ]);
            $table->dateTime('scheduled_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
