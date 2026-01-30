<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_package_id')->constrained()->onDelete('cascade');
            $table->string('unit_number'); // Unit 1, Unit 2
            $table->string('title'); // Concepts, Definitions
            $table->text('purpose')->nullable();
            $table->enum('certification_level', ['level1', 'level2']);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_units');
    }
};
