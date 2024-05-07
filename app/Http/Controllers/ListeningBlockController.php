<?php

namespace App\Http\Controllers;

use App\Models\ListeningBlock;
use App\Models\ListeningLesson;
use App\Models\ListeningTest;
use Illuminate\Http\Request;

class ListeningBlockController extends Controller
{
    public function blockList()
    {
        $blocks = ListeningBlock::all();

        return view('admin.class.listening.block_list', ['blocks' => $blocks]);
    }

    public function  blockCreate()
    {
        $lessons = ListeningLesson::all();
        $tests = ListeningTest::all();

        return view('admin.class.listening.block_create', [
            'lessons' => $lessons,
            'tests' => $tests
        ]);
    }

    public function  blockStore(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'block_name' => 'required',
        ]);

        $question_list = "";
        for ($i = 1; $i <= 10; $i++) {
            if (isset($request->{'stt_' . $i})) {
                $question_list = $question_list . $request->{'type_id_' . $i} . $request->{'stt_' . $i} . ";";
            }
        }
        $question_list = substr($question_list, 0, strlen($question_list)-1);

        $block = new ListeningBlock();
        $block->block_id = uniqid();
        $block->block_name = $request->block_name;
        $block->question_list = $question_list;
        $block->save();

        return redirect()->route('listening.block_show', ['id' => $block->block_id]);
    }

    public function blockShow($id)
    {
        $block = ListeningBlock::where('block_id', $id)->first();

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

        return view('admin.class.listening.block_show', ['block' => $block, 'collection' => $collection]);
    }
}
