<?php

namespace App\Http\Controllers;

use App\Models\CoachQuestion;
use App\Models\CoachSubject;
use App\Models\CoachType;
use Illuminate\Http\Request;

class CoachQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coach_questions = CoachQuestion::leftjoin('coach_types', 'coach_types.id', 'coach_questions.coach_type')
            ->leftjoin('coach_subjects', 'coach_subjects.id', 'coach_questions.coach_subject')
            ->select('coach_questions.*', 'coach_types.type_name', 'coach_subjects.subject_name')
            ->get();

        return view('admin.class.coaching.coach_question.index',
        [
            'coach_questions' => $coach_questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coach_types = CoachType::all();
        $coach_subjects = CoachSubject::all();

        return view('admin.class.coaching.coach_question.create', 
        [
            'coach_types' => $coach_types,
            'coach_subjects' => $coach_subjects
        ]);        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'coach_type' => 'required',
            'coach_subject' => 'required',
            'question' => 'required',            
        ]);

        $coach_question = new CoachQuestion();
        $coach_question->coach_type = $request->coach_type;
        $coach_question->coach_subject = $request->coach_subject;
        $coach_question->question = $request->question;
        $coach_question->suggest_answer = $request->suggest_answer;
        $coach_question->save();

        return redirect()->route('coach_question.index')->with('msg_success','Đã tạo Câu hỏi thành công');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CoachQuestion $coach_question)
    {
        $coach_types = CoachType::all();
        $coach_subjects = CoachSubject::all();

        return view('admin.class.coaching.coach_question.edit', 
        [
            'coach_types' => $coach_types,
            'coach_subjects' => $coach_subjects,
            'coach_question' => $coach_question
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CoachQuestion $coach_question)
    {
        $request->validate([
            'coach_type' => 'required',
            'coach_subject' => 'required',
            'question' => 'required',            
        ]);

        
        $coach_question->coach_type = $request->coach_type;
        $coach_question->coach_subject = $request->coach_subject;
        $coach_question->question = $request->question;
        $coach_question->suggest_answer = $request->suggest_answer;
        $coach_question->save();

        return redirect()->route('coach_question.index')->with('msg_success','Đã cập nhật Câu hỏi thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
