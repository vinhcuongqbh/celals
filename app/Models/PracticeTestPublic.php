<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class PracticeTestPublic extends Model
{
    use HasFactory;

    public function practice_test(): BelongsTo
    {
        return $this->belongsTo(PracticeTest::class, 'practice_test_id', 'test_id')->withDefault();
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'user_id')->withDefault();
    }
}
