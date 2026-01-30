<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExamPackage;
use App\Models\Exam;
use App\Models\LearningUnit;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * 获取所有测验包
     */
    public function getPackages()
    {
        $packages = ExamPackage::where('is_active', true)
            ->withCount('exams')
            ->get();
        
        return response()->json($packages);
    }

    /**
     * 获取指定测验包下的所有测验
     */
    public function getExams(int $packageId)
    {
        $exams = Exam::where('exam_package_id', $packageId)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        
        return response()->json($exams);
    }

    /**
     * 获取学习单元（简化版 - 无需用户认证）
     */
    public function getLearningUnits(Request $request)
    {
        $packageId = $request->input('package_id');
        
        if (!$packageId) {
            return response()->json(['error' => '请提供 package_id 参数'], 400);
        }
        
        $units = LearningUnit::where('exam_package_id', $packageId)
            ->with('learningOutcomes')
            ->orderBy('sort_order')
            ->get();
        
        // 为每个单元添加默认进度（因为没有用户系统）
        $units->each(function($unit) {
            $unit->progress = 0;
            $unit->outcomes_count = $unit->learningOutcomes->count();
            
            // 为每个学习成果添加默认掌握度
            $unit->learningOutcomes->each(function($outcome) {
                $outcome->mastery_level = 0;
            });
        });
        
        return response()->json($units);
    }

    /**
     * 获取指定学习单元的题目
     */
    public function getUnitQuestions(int $unitId)
    {
        $unit = LearningUnit::with(['learningOutcomes.questions'])->find($unitId);
        
        if (!$unit) {
            return response()->json(['error' => '学习单元不存在'], 404);
        }
        
        // 收集所有题目
        $questions = collect();
        foreach ($unit->learningOutcomes as $outcome) {
            $questions = $questions->merge($outcome->questions);
        }
        
        return response()->json($questions);
    }
}
