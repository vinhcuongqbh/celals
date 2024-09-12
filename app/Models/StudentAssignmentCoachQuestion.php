<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class StudentAssignmentCoachQuestion extends Model
{
    use HasFactory;

    public function question(): HasOne
    {
        return $this->hasOne(CoachQuestion::class, 'id', 'question_id')->withDefault();
    }

    public function coach_subject(): HasOneThrough
    {
        return $this->hasOneThrough(
            CoachSubject::class,
            CoachQuestion::class,
            'id', // Foreign key on the cars table...
            'id', // Foreign key on the owners table...
            'question_id', // Local key on the mechanics table...
            'coach_subject_id' // Local key on the cars table...
        )->withDefault();
    }
}
