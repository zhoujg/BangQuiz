<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LearningUnit;
use App\Models\LearningOutcome;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    /**
     * 获取学习进度（简化版 - 无需用户认证）
     */
    public function getLearningProgress(int $packageId, Request $request)
    {
        // 获取该包下所有学习单元和学习成果
        $units = LearningUnit::where('exam_package_id', $packageId)
            ->with('learningOutcomes')
            ->get();

        $totalOutcomes = 0;
        foreach ($units as $unit) {
            $totalOutcomes += $unit->learningOutcomes->count();
        }

        // 由于没有用户系统，返回默认进度
        return response()->json([
            'exam_package_id' => $packageId,
            'overall_progress' => 0,
            'total_outcomes' => $totalOutcomes,
            'completed_outcomes' => 0,
            'in_progress_outcomes' => 0,
            'not_started_outcomes' => $totalOutcomes,
            'units' => $units->map(function($unit) {
                return [
                    'id' => $unit->id,
                    'title' => $unit->title,
                    'outcomes_count' => $unit->learningOutcomes->count()
                ];
            })
        ]);
    }

    /**
     * 获取弱点分析（简化版）
     */
    public function getWeaknessReport(Request $request)
    {
        $packageId = $request->input('package_id');
        
        // 由于没有用户系统，返回空数据
        return response()->json([
            'exam_package_id' => $packageId,
            'weak_points' => [],
            'message' => '需要登录后才能查看个人弱点分析'
        ]);
    }

    /**
     * 获取通过率预测（简化版）
     */
    public function getPassPrediction(Request $request)
    {
        $packageId = $request->input('package_id');
        
        // 由于没有用户系统，返回默认数据
        return response()->json([
            'exam_package_id' => $packageId,
            'pass_probability' => 0,
            'questions_needed' => 100,
            'message' => '需要登录后才能查看个人通过率预测'
        ]);
    }

    /**
     * 获取待复习题目（简化版）
     */
    public function getDueReviews(Request $request)
    {
        $packageId = $request->input('package_id');
        
        // 由于没有用户系统，返回空数据
        return response()->json([
            'exam_package_id' => $packageId,
            'questions' => [],
            'message' => '需要登录后才能使用复习功能'
        ]);
    }

    /**
     * 获取用户统计（简化版）
     */
    public function getUserStats(Request $request)
    {
        // 由于没有用户系统，返回默认数据
        return response()->json([
            'totalQuestions' => 0,
            'accuracy' => 0,
            'studyDays' => 0,
            'passProbability' => 0,
            'message' => '需要登录后才能查看个人统计'
        ]);
    }
}
