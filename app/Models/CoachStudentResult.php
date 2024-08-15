<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachStudentResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'question_id',        
        'point',
        'pass',
        'result'
    ];
}
