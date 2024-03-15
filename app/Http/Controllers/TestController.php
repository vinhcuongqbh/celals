<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Test;
use App\Models\Topic;
use App\Models\Vocabulary;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function create()
    {
        $level = Level::all();
        $topic = Topic::orderBy('topic_name', 'ASC')->get();
        $word = null;

        return view(
            'admin.class.test.create',
            [
                'level' => $level,
                'topic' => $topic,
                'topic2' => $topic,
                'topic3' => $topic,
                'word' => $word
            ]
        );
    }

    public function search(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'level_id' => 'required',
            'topic_id_1' => 'required',
        ]);

        if ($request->select == 'manual_select') {
            $word = Vocabulary::where('vocabularies.level_id', $request->level_id)
                ->where('vocabularies.topic_id', $request->topic_id_1)
                ->orwhere('vocabularies.topic_id', $request->topic_id_2)
                ->orwhere('vocabularies.topic_id', $request->topic_id_3)
                ->leftjoin('word_types', 'word_types.word_type_id', 'vocabularies.word_type_id')
                ->leftjoin('topics', 'topics.topic_id', 'vocabularies.topic_id')
                ->select('vocabularies.*', 'word_types.word_type_name', 'topics.topic_name')
                ->get();
        } elseif ($request->select == 'automatic_select') {
            $word = Vocabulary::where('vocabularies.level_id', $request->level_id)
                ->where('vocabularies.topic_id', $request->topic_id_1)
                ->orwhere('vocabularies.topic_id', $request->topic_id_2)
                ->orwhere('vocabularies.topic_id', $request->topic_id_3)
                ->leftjoin('word_types', 'word_types.word_type_id', 'vocabularies.word_type_id')
                ->leftjoin('topics', 'topics.topic_id', 'vocabularies.topic_id')
                ->select('vocabularies.*', 'word_types.word_type_name', 'topics.topic_name')
                ->inRandomOrder()
                ->limit(20)
                ->get();
        }

        $level = Level::all();
        $topic = Topic::orderBy('topic_name', 'ASC')->get();


        return view(
            'admin.class.test.create',
            [
                'word' => $word,
                'level' => $level,
                'level_id_selected' => $request->level_id,
                'topic' => $topic,
                'topic_id_1_selected' => $request->topic_id_1,
                'topic2' => $topic,
                'topic_id_2_selected' => $request->topic_id_2,
                'topic3' => $topic,
                'topic_id_3_selected' => $request->topic_id_3,
                'select_mode' => $request->select,
            ]
        );
    }

    public function store(Request $request)
    {
        //Lấy thông tin các từ vựng được chọn
        $word_selected_id = $request->word_selected_id;
        $test_id = uniqid();
        $topic_id = $request->topic_id_1_selected . "," . $request->topic_id_2_selected . "," . $request->topic_id_3_selected;

        //Nếu có từ vựng được chọn để xuất kho
        if (isset($word_selected_id)) {
            //Tạo Bài kiểm tra
            $test = new Test();
            $test->test_id = $test_id;
            $test->level_id = $request->level_id_selected;
            $test->topic_id = $topic_id;
            $test->word_selected_id = implode(",", $word_selected_id);
            $test->studing_link = "/test/". $test_id."/studing";
            $test->testing_link = "/test/". $test_id."/testing";
            $test->creator_id = Auth::user()->user_id;
            $test->save();

            return redirect()->route('test.show', ['id' => $test_id]);
        } else {
            return back()->with('msg_error', 'Không có từ vựng nào được lựa chọn');
        }
    }


    public function show($id)
    {
        //Lấy thông tin đề kiểm tra        
        $test = Test::where('test_id', $id)->first();
        //Lấy thông tin cấp độ
        $level = Level::where('level_id', $test->level_id)->first();

        //Lấy thông tin các chủ đề được chọn
        $topic_id = explode(",", $test->topic_id);
        $topic = collect([]);
        foreach ($topic_id as $topic_id) {
            $topic_selected = Topic::where('topic_id', $topic_id)->first();
            $topic->push($topic_selected);
        }

        //Lấy thông tin các từ vựng được chọn
        $word_selected_id_array = explode(",", $test->word_selected_id);
        $word = collect([]);
        foreach ($word_selected_id_array as $word_id) {
            $word_selected = Vocabulary::where('word_id', $word_id)
                ->leftjoin('word_types', 'word_types.word_type_id', 'vocabularies.word_type_id')
                ->leftjoin('topics', 'topics.topic_id', 'vocabularies.topic_id')
                ->select('vocabularies.*', 'word_types.word_type_name', 'topics.topic_name')->first();
            $word->push($word_selected);
        }

        return view(
            'admin.class.test.show',
            [
                'test' => $test,
                'level' => $level,
                'topic' => $topic,
                'word' => $word,
            ]
        )->with('msg_success', 'Tạo Bài Kiểm tra thành công');
    }


    public function studing($id)
    {
        //Lấy thông tin đề kiểm tra        
        $test = Test::where('test_id', $id)->first();
        //Lấy thông tin cấp độ
        $level = Level::where('level_id', $test->level_id)->first();

        //Lấy thông tin các chủ đề được chọn
        $topic_id = explode(",", $test->topic_id);
        $topic = collect([]);
        foreach ($topic_id as $topic_id) {
            $topic_selected = Topic::where('topic_id', $topic_id)->first();
            $topic->push($topic_selected);
        }

        //Lấy thông tin các từ vựng được chọn
        $word_selected_id_array = explode(",", $test->word_selected_id);
        $word = collect([]);
        foreach ($word_selected_id_array as $word_id) {
            $word_selected = Vocabulary::where('word_id', $word_id)
                ->leftjoin('word_types', 'word_types.word_type_id', 'vocabularies.word_type_id')
                ->leftjoin('topics', 'topics.topic_id', 'vocabularies.topic_id')
                ->select('vocabularies.*', 'word_types.word_type_name', 'topics.topic_name')->first();
            $word->push($word_selected);
        }

        return view(
            'front-end.studing',
            [
                'test' => $test,
                'level' => $level,
                'topic' => $topic,
                'word' => $word,
            ]
            );
    }
}
