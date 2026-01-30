<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LearningOutcome extends Model
{
    protected $fillable = [
        'learning_unit_id', 'outcome_code', 'description',
        'bloom_level', 'klp_references', 'sort_order'
    ];

    protected $casts = [
        'klp_references' => 'array',
    ];

    public function learningUnit(): BelongsTo
    {
        return $this->belongsTo(LearningUnit::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function userProgress(): HasMany
    {
        return $this->hasMany(UserLearningProgress::class);
    }
}
