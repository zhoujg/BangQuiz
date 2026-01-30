<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weakness_analysis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('exam_package_id')->constrained()->onDelete('cascade');
            $table->string('knowledge_point');
            $table->integer('total_attempts')->default(0);
            $table->integer('correct_attempts')->default(0);
            $table->float('accuracy_rate')->default(0); // 正确率
            $table->enum('weakness_level', ['strong', 'normal', 'weak', 'critical'])->default('normal');
            $table->timestamps();
            
            $table->unique(['user_id', 'exam_package_id', 'knowledge_point'], 'weakness_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weakness_analysis');
    }
};
