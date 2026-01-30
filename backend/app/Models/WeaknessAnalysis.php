<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeaknessAnalysis extends Model
{
    protected $table = 'weakness_analysis';
    
    protected $fillable = [
        'user_id', 'exam_package_id', 'knowledge_point',
        'total_attempts', 'correct_attempts', 'accuracy_rate', 'weakness_level'
    ];
}
