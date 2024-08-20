<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PracticeTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'level_id',
        'subject',
        'test_type_id',
        'test_form',
        'test_duration',
        'question',
        'suggested_answer',
        'creator_id'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id')->withDefault();
    }

    public function test_type(): BelongsTo
    {
        return $this->belongsTo(TestType::class, 'test_type_id')->withDefault();
    }
}
