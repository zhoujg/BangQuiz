<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamPackage extends Model
{
    protected $fillable = ['name', 'code', 'description', 'cover_image', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }
}
