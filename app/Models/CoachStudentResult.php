<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachStudentResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'question_id',     
        'coach_type_id',   
        'teacher_id',
        'point',
        'pass',
        'result'
    ];
}
