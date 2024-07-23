<?php

namespace App\Http\Controllers;

use App\Models\CoachSubject;
use Illuminate\Http\Request;

class CoachSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coach_subjects = CoachSubject::all();

        return view('admin.class.coaching.coach_subject.index', ['coach_subjects' => $coach_subjects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.class.coaching.coach_subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => [
                'required',
                'string',
            ]
        ]);

        $coach_subject = new CoachSubject();
        $coach_subject->subject_name = $request->subject_name;
        $coach_subject->save();

        return redirect()->route('coach_subject.index')->with('msg_success','Đã tạo Chủ đề thành công');
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
    public function edit(CoachSubject $coach_subject)
    {
        return view('admin.class.coaching.coach_subject.edit', [
            'coach_subject' => $coach_subject
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CoachSubject $coach_subject)
    {
        $request->validate([
            'subject_name' => [
                'required',
                'string',
            ]
        ]);

        $coach_subject->subject_name = $request->subject_name;
        $coach_subject->save();

        return redirect()->route('coach_subject.index')->with('msg_success','Đã cập nhật Chủ đề thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
