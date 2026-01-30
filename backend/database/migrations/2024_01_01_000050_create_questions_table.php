<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained()->onDelete('cascade');
            $table->foreignId('learning_outcome_id')->nullable()->constrained()->onDelete('set null');
            $table->text('content');
            $table->json('options'); // ["A": "选项1", "B": "选项2"]
            $table->string('correct_answer'); // "A" or "A,B"
            $table->text('explanation'); // 详细解析
            $table->string('knowledge_point'); // 知识点标签
            $table->enum('difficulty', ['easy', 'medium', 'hard']);
            $table->enum('bloom_level', ['remembering', 'understanding', 'applying'])->nullable();
            $table->text('scenario')->nullable(); // 真实场景案例
            $table->json('klp_references')->nullable(); // [{"doc": "S0", "section": "§1.1"}]
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
