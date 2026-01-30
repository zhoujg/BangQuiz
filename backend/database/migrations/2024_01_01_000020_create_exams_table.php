<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_package_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('learning_unit_id')->nullable();
            $table->string('title');
            $table->enum('exam_type', ['practice', 'mock', 'final'])->default('practice');
            $table->text('description')->nullable();
            $table->integer('question_count')->default(0);
            $table->integer('time_limit')->nullable()->comment('时间限制(分钟)');
            $table->integer('pass_score')->default(60)->comment('及格分数');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
