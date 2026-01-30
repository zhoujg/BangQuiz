<?php

namespace App\Services;

use App\Models\UserAnswer;
use App\Models\WeaknessAnalysis;

class PassRatePredictionService
{
    public function predictPassRate(int $userId, int $examPackageId): array
    {
        // 获取用户答题数据
        $totalAnswers = UserAnswer::where('user_id', $userId)
            ->whereHas('question.exam', fn($q) => $q->where('exam_package_id', $examPackageId))
            ->count();

        if ($totalAnswers < 50) {
            return [
                'pass_probability' => null,
                'message' => '需要至少完成50题才能进行预测',
                'completed' => $totalAnswers
            ];
        }

        // 计算整体正确率
        $correctAnswers = UserAnswer::where('user_id', $userId)
            ->where('is_correct', true)
            ->whereHas('question.exam', fn($q) => $q->where('exam_package_id', $examPackageId))
            ->count();

        $overallAccuracy = ($correctAnswers / $totalAnswers) * 100;

        // 获取弱点分析
        $weaknessData = WeaknessAnalysis::where('user_id', $userId)
            ->where('exam_package_id', $examPackageId)
            ->get();

        $criticalWeakness = $weaknessData->where('weakness_level', 'critical')->count();
        $weakPoints = $weaknessData->where('weakness_level', 'weak')->count();

        // 预测算法
        $passProbability = $overallAccuracy;
        $passProbability -= ($criticalWeakness * 5); // 严重弱点扣分
        $passProbability -= ($weakPoints * 2); // 一般弱点扣分

        $passProbability = max(0, min(100, $passProbability));

        return [
            'pass_probability' => round($passProbability, 2),
            'overall_accuracy' => round($overallAccuracy, 2),
            'total_questions_completed' => $totalAnswers,
            'critical_weaknesses' => $criticalWeakness,
            'weak_points' => $weakPoints,
            'recommendation' => $this->getRecommendation($passProbability, $criticalWeakness)
        ];
    }

    private function getRecommendation(float $probability, int $criticalWeakness): string
    {
        if ($probability >= 80) {
            return '通过概率很高，建议继续保持并复习弱点';
        } elseif ($probability >= 60) {
            return '有一定通过可能，建议重点攻克弱点知识';
        } else {
            return '通过概率较低，建议系统复习基础知识';
        }
    }
}
