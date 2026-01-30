<?php

namespace App\Services;

use App\Models\WeaknessAnalysis;
use Illuminate\Support\Facades\DB;

class WeaknessAnalysisService
{
    public function updateWeaknessAnalysis(int $userId, int $examPackageId, string $knowledgePoint, bool $isCorrect): void
    {
        $analysis = WeaknessAnalysis::firstOrCreate(
            [
                'user_id' => $userId,
                'exam_package_id' => $examPackageId,
                'knowledge_point' => $knowledgePoint
            ]
        );

        $analysis->total_attempts++;
        if ($isCorrect) {
            $analysis->correct_attempts++;
        }
        
        $analysis->accuracy_rate = ($analysis->correct_attempts / $analysis->total_attempts) * 100;
        
        // 判断弱点等级
        $analysis->weakness_level = match(true) {
            $analysis->accuracy_rate >= 80 => 'strong',
            $analysis->accuracy_rate >= 60 => 'normal',
            $analysis->accuracy_rate >= 40 => 'weak',
            default => 'critical'
        };
        
        $analysis->save();
    }

    public function getWeakKnowledgePoints(int $userId, int $examPackageId, int $limit = 5): array
    {
        return WeaknessAnalysis::where('user_id', $userId)
            ->where('exam_package_id', $examPackageId)
            ->whereIn('weakness_level', ['weak', 'critical'])
            ->orderBy('accuracy_rate', 'asc')
            ->limit($limit)
            ->pluck('knowledge_point')
            ->toArray();
    }

    public function getWeaknessReport(int $userId, int $examPackageId): array
    {
        $analysis = WeaknessAnalysis::where('user_id', $userId)
            ->where('exam_package_id', $examPackageId)
            ->get();

        return [
            'total_knowledge_points' => $analysis->count(),
            'weak_points' => $analysis->where('weakness_level', 'weak')->count(),
            'critical_points' => $analysis->where('weakness_level', 'critical')->count(),
            'overall_accuracy' => $analysis->avg('accuracy_rate'),
            'details' => $analysis->map(fn($item) => [
                'knowledge_point' => $item->knowledge_point,
                'accuracy_rate' => $item->accuracy_rate,
                'weakness_level' => $item->weakness_level,
                'total_attempts' => $item->total_attempts
            ])
        ];
    }
}
