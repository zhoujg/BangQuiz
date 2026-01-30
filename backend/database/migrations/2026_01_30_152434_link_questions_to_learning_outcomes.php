<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 根据 knowledge_point 将题目关联到学习成果
        // 假设题目的 knowledge_point 包含 "Unit X" 信息
        
        // 获取所有学习单元及其学习成果
        $units = DB::table('learning_units')->get();
        
        foreach ($units as $unit) {
            // 获取该单元的第一个学习成果
            $firstOutcome = DB::table('learning_outcomes')
                ->where('learning_unit_id', $unit->id)
                ->orderBy('sort_order')
                ->first();
            
            if ($firstOutcome) {
                // 根据 knowledge_point 匹配题目
                // 例如: "Unit 1 - Concepts" 匹配到 Unit 1
                DB::table('questions')
                    ->where('knowledge_point', 'like', "Unit {$unit->id}%")
                    ->update(['learning_outcome_id' => $firstOutcome->id]);
            }
        }
    }

    public function down(): void
    {
        // 清除关联
        DB::table('questions')->update(['learning_outcome_id' => null]);
    }
};
