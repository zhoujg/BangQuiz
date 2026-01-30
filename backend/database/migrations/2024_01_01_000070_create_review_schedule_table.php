<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('review_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->integer('repetition')->default(0); // 重复次数
            $table->float('easiness_factor')->default(2.5); // SM-2算法难度因子
            $table->integer('interval')->default(1); // 复习间隔(天)
            $table->timestamp('next_review_at'); // 下次复习时间
            $table->timestamps();
            
            $table->unique(['user_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review_schedule');
    }
};
