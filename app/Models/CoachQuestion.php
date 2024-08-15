<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoachQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'coach_type_id',
        'coach_subject_id',        
        'question',
        'suggest_answer',
    ];

    public function coach_type(): BelongsTo
    {
        return $this->BelongsTo(CoachType::class)->withDefault();
    }

    public function coach_subject(): BelongsTo
    {
        return $this->BelongsTo(CoachSubject::class)->withDefault();
    }
}
