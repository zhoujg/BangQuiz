<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLearningProgress extends Model
{
    protected $table = 'user_learning_progress';
    
    protected $fillable = [
        'user_id', 'learning_outcome_id', 'mastery_level',
        'questions_attempted', 'questions_correct', 'last_practiced_at'
    ];

    protected $casts = [
        'last_practiced_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function learningOutcome(): BelongsTo
    {
        return $this->belongsTo(LearningOutcome::class);
    }

    public function updateMasteryLevel(): void
    {
        if ($this->questions_attempted > 0) {
            $this->mastery_level = ($this->questions_correct / $this->questions_attempted) * 100;
            $this->save();
        }
    }
}
