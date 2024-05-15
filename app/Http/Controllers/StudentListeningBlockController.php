<?php

namespace App\Http\Controllers;

use App\Models\ListeningBlock;
use App\Models\ListeningLesson;
use App\Models\ListeningTest;
use App\Models\ListeningTestDetail;
use App\Models\StudentListeningBlock;
use App\Models\StudentListeningTest;
use App\Models\TestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use MicrosoftAzure\Storage\Blob\Models\Block;

class StudentListeningBlockController extends Controller
{
    public function blockShow()
    {
        $student_listening_block = StudentListeningBlock::where('student_id', Auth::user()->user_id)->first();
        $current_block_id = $student_listening_block->listening_block_id;
        $block = ListeningBlock::where('block_id', $current_block_id)->first();
        $question_list = $block->question_list;
        $question_list = explode(";", $block->question_list);

        $collection = collect();

        foreach ($question_list as $ql) {
            $type_id = substr($ql, 0, 1);
            $question_id = substr($ql, 1, strlen($ql) - 1);
            if ($type_id == "L") {
                $question = ListeningLesson::where('id', $question_id)->first();
                if (isset($question)) $question_id = $question->lesson_id;
            } elseif ($type_id == "T") {
                $question = ListeningTest::where('id', $question_id)->first();
                if (isset($question)) $question_id = $question->test_id;
            }
            if (isset($question)) {
                $collection->push([
                    'type_id' => $type_id,
                    'question_id' => $question_id,
                    'subject' => $question->subject,
                ]);
            }
        }

        return view('admin.class.listening.student_block_show', ['block' => $block, 'collection' => $collection]);
    }


    public function  historyStudy()
    {
        $test_list = StudentListeningTest::where('student_id', Auth::user()->user_id)
            ->leftjoin('listening_tests', 'listening_test.test_id', 'student_listening_tests.test_id')    
            ->select('student_listening_tests.*','listening_tests.test_subject')
            ->get();

        return view(
            'admin.class.listening.student_history_study',
            [
                'test_list' => $test_list,
            ]
        );
    }


    public function  lessonShow($id)
    {
        $lesson = ListeningLesson::where('lesson_id', $id)->first();

        return view('admin.class.listening.student_lesson_show', ['lesson' => $lesson]);
    }
}
