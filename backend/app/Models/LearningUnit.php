<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LearningUnit extends Model
{
    protected $fillable = [
        'exam_package_id', 'unit_number', 'title', 'purpose',
        'certification_level', 'sort_order'
    ];

    public function examPackage(): BelongsTo
    {
        return $this->belongsTo(ExamPackage::class);
    }

    public function learningOutcomes(): HasMany
    {
        return $this->hasMany(LearningOutcome::class);
    }
}
