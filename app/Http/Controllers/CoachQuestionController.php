<?php

namespace App\Http\Controllers;

use App\Models\CoachQuestion;
use App\Models\CoachSubject;
use App\Models\CoachType;
use Illuminate\Http\Request;

class CoachQuestionController extends Controller
{
    // Danh sách câu hỏi coaching
    public function index()
    {
        $coach_questions = CoachQuestion::orderby('coach_type_id')->get();

        return view('admin.class.coaching.coach_question.index', ['coach_questions' => $coach_questions]);
    }

    // Tạo câu hỏi coaching
    public function create()
    {
        $coach_types = CoachType::all();
        $coach_subjects = CoachSubject::all();

        return view('admin.class.coaching.coach_question.create', ['coach_types' => $coach_types, 'coach_subjects' => $coach_subjects]);
    }

    // Lưu câu hỏi coaching
    public function store(Request $request)
    {
        $request->validate([
            'coach_type_id' => 'required',
            'question' => 'required',
        ]);

        $coach_question = CoachQuestion::create($request->all());

        return redirect()->route('coach_question.edit', $coach_question->id)->with('msg_success', 'Đã tạo Câu hỏi thành công');
    }

    // Hiển thị câu hỏi coaching
    public function show(string $id)
    {
        //
    }

    // Sửa câu hỏi coaching
    public function edit(CoachQuestion $coach_question)
    {
        $coach_types = CoachType::all();
        $coach_subjects = CoachSubject::all();

        return view(
            'admin.class.coaching.coach_question.edit',
            [
                'coach_types' => $coach_types,
                'coach_subjects' => $coach_subjects,
                'coach_question' => $coach_question
            ]
        );
    }

    // Cập nhật câu hỏi coaching
    public function update(Request $request, CoachQuestion $coach_question)
    {
        $request->validate([
            'coach_type_id' => 'required',
            'question' => 'required',
        ]);

        $coach_question->update($request->all());

        return redirect()->route('coach_question.edit', $coach_question->id)->with('msg_success', 'Đã cập nhật Câu hỏi thành công');
    }   
}
