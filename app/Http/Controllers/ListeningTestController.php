<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\ListeningTest;
use App\Models\ListeningTestDetail;
use App\Models\TestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListeningTestController extends Controller
{
    // List
    public function testList()
    {
        $tests = ListeningTest::all();

        return view('admin.class.listening.test_list', ['tests' => $tests]);
    }

    // Create
    public function testCreate()
    {
        $test_types = TestType::all();
        $levels = Level::all();
        return view('admin.class.listening.test_create', 
        [
            'test_types' => $test_types, 
            'levels' => $levels
        ]);
    }

    // Store
    public function testStore(Request $request)
    {
        // Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'subject' => 'required',
            'level_id' => 'required',            
            'test_type_id' => 'required',
        ]);

        // Lưu thông tin
        $test = new ListeningTest();
        $test->test_id = uniqid();
        $test->subject = $request->subject;
        $test->question = $request->question;
        $test->suggested_answer = $request->suggested_answer;          
        $test->level_id = $request->level_id;        
        $test->test_type_id = $request->test_type_id;
        $test->test_form = $request->test_form;
        $test->test_duration = $request->test_duration;              
        $test->save();        

        return redirect()->route('listening.test_show', ['id' => $test->test_id]);
    }

    // Show
    public function testShow($id)
    {
        $test = ListeningTest::where('test_id', $id)->first();

        return view('admin.class.listening.test_show',
            [
                'test' => $test,
            ]
        );
    }

    // Edit
    public function testEdit($id)
    {
        $test = ListeningTest::where('test_id', $id)->first();
        $test_types = TestType::all();
        $levels = Level::all();

        return view(
            'admin.class.listening.test_edit',
            [
                'test' => $test, 
                'test_types' => $test_types, 
                'levels' => $levels
            ]
        );
    }

    // Update  
    public function testUpdate($id, Request $request)
    {
        // Kiểm tra thông tin đầu vào
        $validated = $request->validate([            
            'subject' => 'required',
            'level_id' => 'required',
            'test_type_id' => 'required',
        ]);

        // Lưu thông tin
        $test = ListeningTest::where('test_id', $id)->first(); 
        $test->subject = $request->subject;
        $test->question = $request->question;
        $test->suggested_answer = $request->suggested_answer;         
        $test->level_id = $request->level_id;        
        $test->test_type_id = $request->test_type_id;
        $test->test_form = $request->test_form;
        $test->test_duration = $request->test_duration;
        $test->save();   

        return redirect()->route('listening.test_show', ['id' => $test->test_id]);
    }
}
