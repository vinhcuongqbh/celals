<?php

namespace App\Http\Controllers;

use App\Models\ListeningTest;
use App\Models\ListeningTestDetail;
use App\Models\TestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListeningTestController extends Controller
{
    public function testList()
    {
        $tests = ListeningTest::all();

        return view('admin.class.listening.test_list', ['tests' => $tests]);
    }


    public function testCreate()
    {
        $test_types = TestType::all();
        return view('admin.class.listening.test_create', ['test_types' => $test_types]);
    }


    public function testStore(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'subject' => 'required',
            'test_type_id' => 'required',
            'test_form' => 'required',
            'test_duration' => 'required',
        ]);


        $test = new ListeningTest();
        $test->test_id = uniqid();
        $test->subject = $request->subject;
        $test->test_type_id = $request->test_type_id;
        $test->test_form = $request->test_form;
        $test->test_duration = $request->test_duration;
        if (isset($request->question)) $test->question = $request->question;
        //Xử lý link
        if (!empty($request->file('link_question'))) {
            $file = Storage::putFile('/public/File/Img', $request->file('link_question'));
            $path = Storage::url($file);
            $test->link_question = $path;
        }
        $test->save();
        for ($i = 1; $i <= 10; $i++) {
            if (!empty($request->file('link_audio_' . $i))) {
                $file = Storage::putFile('/public/File/Audio', $request->file('link_audio_' . $i));
                $path = Storage::url($file);
                $test_detail = new ListeningTestDetail();
                $test_detail->test_id = $test->test_id;
                $test_detail->link_audio = $path;
                //Lưu file âm thanh
                $test_detail->save();
            }
        }

        return redirect()->route('listening.test_show', ['id' => $test->test_id]);
    }


    public function testShow($id)
    {
        $test = ListeningTest::where('test_id', $id)
            ->leftjoin('test_types','test_types.test_type_id', 'listening_tests.test_type_id')
            ->get('listening_tests.*', 'test_types.test_type_name')
            ->first();

        $test_details = ListeningTestDetail::where('test_id', $id)->get();

        $test_types = TestType::all();


        return view('admin.class.listening.test_show', 
        [
            'test' => $test,
            'test_details' => $test_details,
            'test_types' => $test_types
        ]);
    }
}
