<?php

namespace App\Http\Controllers;

use App\Models\ListeningTest;
use App\Models\ListeningTestDetail;
use App\Models\StudentListeningTest;
use App\Models\TestType;
use Illuminate\Http\Request;
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
                'test_types' => $test_types
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
    }
}
