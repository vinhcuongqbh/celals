<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\PracticeTest;
use App\Models\PracticeTestPublic;
use App\Models\TestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PracticeTestController extends Controller
{
    public function index()
    {
        $tests = PracticeTest::orderby('created_at', 'DESC')->get();

        return view('admin.class.practice_test.list', ['tests' => $tests]);
    }


    public function create()
    {
        $test_types = TestType::all();
        $levels = Level::all();
        return view('admin.class.practice_test.create', ['test_types' => $test_types, 'levels' => $levels]);
    }


    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'level_id' => 'required',
            'subject' => 'required',
            'test_type_id' => 'required',
        ]);


        $test = PracticeTest::create([
            'test_id' => uniqid(),
            'level_id' => $request->level_id,
            'subject' => $request->subject,
            'test_type_id' => $request->test_type_id,
            'test_form' => $request->test_form,
            'test_duration' => $request->test_duration,
            'question' => $request->question,
            'suggested_answer' => $request->suggested_answer,
            'creator_id' => Auth::user()->user_id
        ]);

        return redirect()->route('practice_test.show', ['practice_test' => $test->test_id]);
    }


    public function show($id)
    {
        $test = PracticeTest::where('test_id', $id)->first();

        return view(
            'admin.class.practice_test.show',
            [
                'test' => $test
            ]
        );
    }

    public function edit($id)
    {
        $test = PracticeTest::where('test_id', $id)->first();

        $test_types = TestType::all();
        $levels = Level::all();

        return view(
            'admin.class.practice_test.edit',
            [
                'test' => $test,
                'test_types' => $test_types,
                'levels' => $levels
            ]
        );
    }


    public function update($id, Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'level_id' => 'required',
            'subject' => 'required',
            'test_type_id' => 'required',
        ]);


        $test = PracticeTest::where('test_id', $id)->first();
        $test->level_id = $request->level_id;
        $test->subject = $request->subject;
        $test->test_type_id = $request->test_type_id;
        $test->test_form = $request->test_form;
        $test->test_duration = $request->test_duration;
        $test->question = $request->question;
        $test->suggested_answer = $request->suggested_answer;
        $test->creator_id = Auth::user()->user_id;
        $test->save();

        return redirect()->route('practice_test.show', ['practice_test' => $test->test_id]);
    }


    public function public($practice_test_id)
    {
        $public_date = uniqid();
        $public_test = new PracticeTestPublic();
        $public_test->public_test_id = $practice_test_id."_".$public_date;
        $public_test->practice_test_id = $practice_test_id;
        $public_test->creator_id = Auth::user()->user_id;
        $public_test->save();

        return redirect()->route('public_text.show', $public_test->public_test_id);
    }

}
