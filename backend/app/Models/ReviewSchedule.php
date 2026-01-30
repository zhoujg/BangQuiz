<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewSchedule extends Model
{
    protected $table = 'review_schedule';
    
    protected $fillable = [
        'user_id', 'question_id', 'repetition',
        'easiness_factor', 'interval', 'next_review_at'
    ];

    protected $casts = [
        'next_review_at' => 'datetime',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
