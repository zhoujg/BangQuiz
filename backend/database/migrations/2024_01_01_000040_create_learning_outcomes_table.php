<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_outcomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_unit_id')->constrained()->onDelete('cascade');
            $table->string('outcome_code'); // 1.1, 1.2, 2.1
            $table->text('description'); // "Describe what an enterprise is"
            $table->enum('bloom_level', ['remembering', 'understanding', 'applying']);
            $table->json('klp_references')->nullable(); // [{"doc": "S0", "section": "§1.1"}]
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_outcomes');
    }
};
