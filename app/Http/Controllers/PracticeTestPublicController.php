<?php

namespace App\Http\Controllers;

use App\Models\PracticeTest;
use App\Models\PracticeTestPublic;
use App\Models\StudentPracticeTest;
use Illuminate\Http\Request;

class PracticeTestPublicController extends Controller
{
    public function index()
    {
        $public_test = PracticeTestPublic::get();

        return view('admin.class.practice_test.public_test_list', ['tests' => $public_test]);
    }


    public function show($test_id)
    {
        $student_test_list = StudentPracticeTest::where('public_test_id', $test_id)->get();
        $public_test = PracticeTestPublic::where('public_test_id', $test_id)->first();

        return view(
            'admin.class.practice_test.public_test_show',
            [
                'test' => $public_test,
                'student_test_list' => $student_test_list
            ]
        );
    }


    public function testing($test_id)
    {
        $public_test = PracticeTestPublic::where('public_test_id', $test_id)->first();

        $practice_test = PracticeTest::where('test_id', $public_test->practice_test_id)->first();

        return view(
            'front-end.public_test_create',
            [
                'practice_test' => $practice_test,
                'public_test' => $public_test
            ]
        );
    }

    public function store($test_id, Request $request)
    {
        $result = new StudentPracticeTest();
        $result->student_name = $request->name;
        $result->student_age = $request->age;
        $result->student_tel = $request->tel;
        $result->public_test_id = $test_id;
        $result->answer = $request->answer;
        $result->save();

        return back()->with('msg_success', 'Đã nộp bài thành công');
    }


    public function edit($test_id, $student_id, Request $request)
    {
        echo "hahaha";
    }
}
