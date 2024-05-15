<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\ListeningTest;
use App\Models\ListeningTestDetail;
use App\Models\StudentListeningTest;
use App\Models\TestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentListeningTestController extends Controller
{
    public function  testCreate($id)
    {
        $test = ListeningTest::where('test_id', $id)->first();
        $test_details = ListeningTestDetail::where('test_id', $id)->get();
        $test_types = TestType::all();

        return view(
            'admin.class.listening.student_test_create',
            [
                'test' => $test,
                'test_details' => $test_details,
                'test_types' => $test_types,
            ]
        );
    }

    public function  testStore(Request $request)
    {
        $test_result = new StudentListeningTest();
        $test_result->test_id = $request->test_id;
        $test_result->student_id = $request->student_id;
        $test_result->student_answer = $request->student_answer;
        //Xử lý link
        if (!empty($request->file('link_answer'))) {
            $file = Storage::putFile('/public/File/Student', $request->file('link_answer'));
            $path = Storage::url($file);
            $test_result->link_answer = $path;
        }
        $test_result->save();

        return redirect()->route('listening.student_block_show')->with('msg_success', 'Đã gửi bài làm thành công');
    }


    public function historyList()
    {
        $tests = StudentListeningTest::where('student_id', Auth::user()->user_id)
            ->leftjoin('users', 'users.user_id', 'student_listening_tests.student_id')
            ->leftjoin('listening_tests', 'listening_tests.test_id', 'student_listening_tests.test_id')
            ->leftjoin('levels', 'levels.level_id', 'listening_tests.level_id')
            ->select('student_listening_tests.*', 'users.name', 'listening_tests.subject', 'levels.level_name')
            ->get();

        return view('admin.class.listening.student_history_study', ['tests' => $tests]);
    }


    public function historyShow($id)
    {
        $student_answer = StudentListeningTest::where('id', $id)->first();
        $test_id = $student_answer->test_id;

        $test = ListeningTest::where('test_id', $test_id)
            ->leftjoin('levels', 'levels.level_id', 'listening_tests.level_id')
            ->leftjoin('test_types', 'test_types.test_type_id', 'listening_tests.test_type_id')
            ->select('listening_tests.*', 'levels.level_name', 'test_types.test_type_name')
            ->first();    

        $test_details = ListeningTestDetail::where('test_id', $test_id)->get();
        $test_types = TestType::all();
        $levels = Level::all();

        return view(
            'admin.class.listening.student_history_show',
            [
                'test' => $test, 
                'test_details' => $test_details,
                'test_types' => $test_types, 
                'levels' => $levels,
                'student_answer' => $student_answer
            ]
        );
    }
}
