<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\ListeningBlock;
use App\Models\ListeningLesson;
use App\Models\ListeningTest;
use App\Models\StudentListeningBlock;
use App\Models\StudentListeningTest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ListeningBlockController extends Controller
{
    public function blockList()
    {
        $blocks = ListeningBlock::all();

        return view('admin.class.listening.block_list', ['blocks' => $blocks]);
    }

    public function  blockCreate(Request $request)
    {
        if (isset($request->level_id)) {
            $lessons = ListeningLesson::where('level_id', $request->level_id)->get();
            $tests = ListeningTest::where('level_id', $request->level_id)->get();
        } else {
            $lessons = null;
            $tests = null;
        }
        $levels = Level::all();

        return view('admin.class.listening.block_create', [
            'lessons' => $lessons,
            'tests' => $tests,
            'levels' => $levels,
            'level_id_selected' => $request->level_id,
        ]);
    }


    public function  blockStore(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'level_id' => 'required',
            'block_name' => 'required',
        ]);

        $question_list = "";
        for ($i = 1; $i <= 10; $i++) {
            if (isset($request->{'stt_' . $i})) {
                $question_list = $question_list . $request->{'type_id_' . $i} . $request->{'stt_' . $i} . ";";
            }
        }
        $question_list = substr($question_list, 0, strlen($question_list) - 1);

        $block = new ListeningBlock();
        $block->block_id = uniqid();
        $block->level_id = $request->level_id;
        $block->block_name = $request->block_name;
        $block->question_list = $question_list;
        $block->save();

        return redirect()->route('listening.block_show', ['id' => $block->block_id]);
    }


    public function blockShow($id)
    {
        $block = ListeningBlock::where('block_id', $id)
            ->leftjoin('levels', 'levels.level_id', 'listening_blocks.level_id')
            ->select('listening_blocks.*', 'levels.level_name')
            ->first();

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


    public function  blockEdit($id, Request $request)
    {
        $block = ListeningBlock::where('block_id', $id)->first();

        $question_list = explode(";", $block->question_list);

        $collection = collect();

        foreach ($question_list as $ql) {
            $type_id = substr($ql, 0, 1);
            $question_id = substr($ql, 1, strlen($ql) - 1);
            $collection->push([
                'type_id' => $type_id,
                'question_id' => $question_id,
            ]);
        }


        if (isset($request->level_id)) {
            $lessons = ListeningLesson::where('level_id', $request->level_id)->get();
            $tests = ListeningTest::where('level_id', $request->level_id)->get();
        } else {
            $lessons = ListeningLesson::where('level_id', $block->level_id)->get();
            $tests = ListeningTest::where('level_id', $block->level_id)->get();
        }

        $levels = Level::all();

        return view('admin.class.listening.block_edit', [
            'block' => $block,
            'lessons' => $lessons,
            'tests' => $tests,
            'levels' => $levels,
            'level_id_selected' => $request->level_id,
            'collection' => $collection,
        ]);
    }


    public function  blockUpdate($id, Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'level_id' => 'required',
            'block_name' => 'required',
        ]);

        $question_list = "";
        for ($i = 1; $i <= 10; $i++) {
            if (isset($request->{'stt_' . $i})) {
                $question_list = $question_list . $request->{'type_id_' . $i} . $request->{'stt_' . $i} . ";";
            }
        }
        $question_list = substr($question_list, 0, strlen($question_list) - 1);

        $block = ListeningBlock::where('block_id', $id)->first();
        $block->level_id = $request->level_id;
        $block->block_name = $request->block_name;
        $block->question_list = $question_list;
        $block->save();

        return redirect()->route('listening.block_show', ['id' => $block->block_id]);
    }


    public function studentList()
    {
        $students = User::where('users.role_id', 5)
            ->where('users.user_status', 1)
            ->leftjoin('student_listening_blocks', 'student_listening_blocks.student_id', 'users.user_id')
            ->leftjoin('listening_blocks', 'listening_blocks.block_id', 'student_listening_blocks.listening_block_id')
            ->select('users.*', 'student_listening_blocks.listening_block_id', 'listening_blocks.block_name')
            ->get();

        return view('admin.class.student_list', ['students' => $students]);
    }


    public function changeBlock($id)
    {
        $student_block = StudentListeningBlock::where('student_id', $id)->first();
        $block = ListeningBlock::all();
        $collection = $block->getIterator();

        foreach ($collection as $cl) {
            if ($collection->current()->block_id == $student_block->listening_block_id) {
                $collection->next();
                if ($collection->current() <>null) $next_block = $collection->current()->block_id;
            }
        }

        if (isset($next_block)) {
            $student_block->listening_block_id = $next_block;
            $student_block->save();
            return redirect()->route('listening.student_list')->with('msg_success', 'Đã Đổi Block thành công');;
        } else {
            return redirect()->route('listening.student_list')->with('msg_error', 'Đã đến Block cuối cùng');;
        }
    }
}
