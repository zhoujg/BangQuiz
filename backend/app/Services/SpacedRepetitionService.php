<?php

namespace App\Services;

use App\Models\ReviewSchedule;
use Carbon\Carbon;

class SpacedRepetitionService
{
    // SM-2算法实现
    public function updateSchedule(int $userId, int $questionId, int $quality): void
    {
        $schedule = ReviewSchedule::firstOrCreate(
            ['user_id' => $userId, 'question_id' => $questionId]
        );

        if ($quality >= 3) {
            if ($schedule->repetition == 0) {
                $schedule->interval = 1;
            } elseif ($schedule->repetition == 1) {
                $schedule->interval = 6;
            } else {
                $schedule->interval = round($schedule->interval * $schedule->easiness_factor);
            }
            $schedule->repetition++;
        } else {
            $schedule->repetition = 0;
            $schedule->interval = 1;
        }

        $schedule->easiness_factor = max(1.3, 
            $schedule->easiness_factor + (0.1 - (5 - $quality) * (0.08 + (5 - $quality) * 0.02))
        );

        $schedule->next_review_at = Carbon::now()->addDays($schedule->interval);
        $schedule->save();
    }

    public function getDueQuestions(int $userId, int $examPackageId): array
    {
        return ReviewSchedule::where('user_id', $userId)
            ->where('next_review_at', '<=', now())
            ->whereHas('question.exam', fn($q) => $q->where('exam_package_id', $examPackageId))
            ->with('question')
            ->get()
            ->pluck('question')
            ->toArray();
    }
}
