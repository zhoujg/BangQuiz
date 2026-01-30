<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_learning_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('learning_outcome_id')->constrained()->onDelete('cascade');
            $table->float('mastery_level')->default(0); // 0-100
            $table->integer('questions_attempted')->default(0);
            $table->integer('questions_correct')->default(0);
            $table->timestamp('last_practiced_at')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'learning_outcome_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_learning_progress');
    }
};
