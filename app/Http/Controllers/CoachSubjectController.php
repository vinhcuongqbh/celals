<?php

namespace App\Http\Controllers;

use App\Models\CoachSubject;
use Illuminate\Http\Request;

class CoachSubjectController extends Controller
{
    // Danh sách chủ đề coaching
    public function index()
    {
        $coach_subjects = CoachSubject::all();

        return view('admin.class.coaching.coach_subject.index', [
            'coach_subjects' => $coach_subjects
        ]);
    }

    // Tạo chủ đề coaching
    public function create()
    {
        return view('admin.class.coaching.coach_subject.create');
    }

    // Lưu chủ đề coaching
    public function store(Request $request)
    {
        $request->validate(['subject_name' => ['required', 'string',]]);

        $coach_subject = new CoachSubject();
        $coach_subject->subject_name = $request->subject_name;
        $coach_subject->save();

        return redirect()->route('coach_subject.index')->with('msg_success', 'Đã tạo Chủ đề thành công');
    }

    // Hiển thị chủ đề coaching
    public function show(string $id)
    {
        //
    }

    // Sửa chủ đề coaching
    public function edit(CoachSubject $coach_subject)
    {
        return view('admin.class.coaching.coach_subject.edit', [
            'coach_subject' => $coach_subject
        ]);
    }

    // Cập nhật chủ đề coaching
    public function update(Request $request, CoachSubject $coach_subject)
    {
        $request->validate(['subject_name' => ['required', 'string',]]);

        $coach_subject->subject_name = $request->subject_name;
        $coach_subject->save();

        return redirect()->route('coach_subject.index')->with('msg_success', 'Đã cập nhật Chủ đề thành công');
    }
}
