<?php

namespace App\Http\Controllers;

use App\Models\CoachQuestion;
use App\Models\CoachStudentResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CoachStudentController extends Controller
{
    public function coach_student($coach_type_id, Request $request)
    {
        // Lấy danh sách học viên
        $students = User::where('role_id', 5)->get();

        // Học viên được chọn + Set cookie cho học viên được chọn
        if ($request->student_id <> null && $request->student_id <> Cookie::get('selected_student')) $selected_student = $request->student_id;
        else $selected_student = Cookie::get('selected_student');
        Cookie::queue('selected_student', $selected_student, 300);

        
        // Lấy câu hỏi thuộc lĩnh vực coach
        $coach_questions = CoachQuestion::where('coach_questions.coach_type_id', $coach_type_id)
            ->leftjoin('coach_student_results', function ($join) use ($selected_student) {
                $join->on('coach_student_results.question_id', 'coach_questions.id')
                    ->where('coach_student_results.user_id', $selected_student);
            })
            ->select('coach_questions.*', 'coach_student_results.point', 'coach_student_results.pass')
            ->orderby('coach_student_results.pass')
            ->get();

        return view(
            'admin.class.coaching.coach_student.coach_type',
            [
                'students' => $students,
                'selected_student' => $selected_student,
                'coach_questions' => $coach_questions,
                'coach_type_id' =>$coach_type_id
            ]
        );
    }


    public function student_result_update($user_id, $coach_type_id, Request $request)
    {
        $questions = CoachQuestion::where('coach_type_id', $coach_type_id)->orderby('id', 'ASC')->get();

        foreach ($questions as $question) {
            $point = floatval($request->input('question' . $question->id));
            ($point >= 8) ? $pass = "Đạt" : $pass = "Chưa đạt";

            $result = CoachStudentResult::updateOrCreate(
                ['user_id' => $user_id, 'question_id' => $question->id],
                ['point' => $point, 'pass' => $pass]
            );
        }

        return back()->with('msg_success', 'Đã cập nhật thành công');
    }
}
