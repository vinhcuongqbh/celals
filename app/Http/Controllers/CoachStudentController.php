<?php

namespace App\Http\Controllers;

use App\Models\CoachQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CoachStudentController extends Controller
{
    public function coach_phongvan(Request $request)
    {
        $students = User::where('role_id', 5)->get();
        if ($request->student_id <> null && $request->student_id <> Cookie::get('selected_student')) $selected_student = $request->student_id;
        else $selected_student = Cookie::get('selected_student'); 

        Cookie::queue('selected_student', $selected_student, 60);
        $coach_questions = CoachQuestion::where('coach_type', 1)
            ->leftjoin('coach_types', 'coach_types.id', 'coach_questions.coach_type')
            ->leftjoin('coach_subjects', 'coach_subjects.id', 'coach_questions.coach_subject')
            ->select('coach_questions.*', 'coach_types.type_name', 'coach_subjects.subject_name')
            ->get();

        return view(
            'admin.class.coaching.coach_student.coach_phongvan',
            [
                'students' => $students,
                'selected_student' => $selected_student,
                'coach_questions' => $coach_questions
            ]
        );
    }


    public function coach_chude(Request $request)
    {
        $students = User::where('role_id', 5)->get();
        if ($request->student_id <> null && $request->student_id <> Cookie::get('selected_student')) $selected_student = $request->student_id;
        else $selected_student = Cookie::get('selected_student'); 

        Cookie::queue('selected_student', $selected_student, 60);

        $coach_questions = CoachQuestion::where('coach_type', 2)
            ->leftjoin('coach_types', 'coach_types.id', 'coach_questions.coach_type')
            ->leftjoin('coach_subjects', 'coach_subjects.id', 'coach_questions.coach_subject')
            ->select('coach_questions.*', 'coach_types.type_name', 'coach_subjects.subject_name')
            ->get();

        return view(
            'admin.class.coaching.coach_student.coach_chude',
            [
                'students' => $students,
                'selected_student' => $selected_student,
                'coach_questions' => $coach_questions
            ]
        );
    }
}
