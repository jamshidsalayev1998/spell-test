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
        Schema::create('spell_test_result_mistakes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('spell_test_result_id');
            $table->integer('spell_word_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spell_test_result_mistakes');
    }
};
