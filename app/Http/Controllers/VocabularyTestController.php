<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Level;
use App\Models\Topic;
use App\Models\Vocabulary;
use App\Models\VocabularyTest;
use App\Models\VocabularyTestResult;
use App\Models\VocabularyTestResultDetail;
use Illuminate\Support\Facades\Auth;

class VocabularyTestController extends Controller
{
    public function testCreate()
    {
        $level = Level::all();
        $topic = Topic::orderBy('topic_name', 'ASC')->get();
        $word = null;

        return view(
            'admin.class.vocabulary.test_create',
            [
                'level' => $level,
                'topic' => $topic,
                'topic2' => $topic,
                'topic3' => $topic,
                'word' => $word
            ]
        );
    }

    public function testList()
    {
        $test = VocabularyTest::where('creator_id', Auth::user()->user_id)
        ->leftjoin('levels','levels.level_id', 'vocabulary_tests.level_id')
        ->select('vocabulary_tests.*', 'levels.level_name')
        ->orderby('vocabulary_tests.created_at', 'DESC')
        ->get();

        return view(
            'admin.class.vocabulary.test_list',
            [
                'test' => $test,
            ]
        );
    }

    public function testSearch(Request $request)
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
                ->get();
        }

        $level = Level::all();
        $topic = Topic::orderBy('topic_name', 'ASC')->get();


        return view(
            'admin.class.vocabulary.test_create',
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

    public function testStore(Request $request)
    {
        //Lấy thông tin các từ vựng được chọn
        $word_selected_id = $request->word_selected_id;
        $test_id = uniqid();
        $topic_id = $request->topic_id_1_selected . "," . $request->topic_id_2_selected . "," . $request->topic_id_3_selected;

        //Nếu có từ vựng được chọn để xuất kho
        if (isset($word_selected_id)) {
            //Tạo Bài kiểm tra
            $test = new VocabularyTest();
            $test->test_id = $test_id;
            $test->level_id = $request->level_id_selected;
            $test->topic_id = $topic_id;
            $test->word_selected_id = implode(",", $word_selected_id);
            $test->creator_id = Auth::user()->user_id;
            $test->save();

            return redirect()->route('vocabulary.test_show', ['id' => $test_id]);
        } else {
            return back()->with('msg_error', 'Không có từ vựng nào được lựa chọn');
        }
    }


    public function testShow($id)
    {
        //Lấy thông tin đề kiểm tra        
        $test = VocabularyTest::where('test_id', $id)->first();
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
            'admin.class.vocabulary.test_show',
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
        $test = VocabularyTest::where('test_id', $id)->first();
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


    public function testing($id)
    {
        //Lấy thông tin đề kiểm tra        
        $test = VocabularyTest::where('test_id', $id)->first();
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

        //Trộn thứ tự ngẫu nhiên danh sách từ vựng
        $word = $word->shuffle();

        return view(
            'front-end.testing',
            [
                'test' => $test,
                'test_id' => $id,
                'level' => $level,
                'topic' => $topic,
                'word' => $word,
                'word2' => $word,
            ]
        );
    }


    public function testingStore(Request $request)
    {

        $word_id_array = explode(",", $request->word_id_array);
        $test_answer_id = uniqid();

        foreach ($word_id_array as $value) {
            $test_result_detail = new VocabularyTestResultDetail();
            $result = Vocabulary::where('word_id', $value)->first();
            if (isset($result)) {
                $test_result_detail->test_answer_id = $test_answer_id;
                $test_result_detail->word_id = $result->word_id;
                $test_result_detail->word_meaning = $result->word_meaning;
                $test_result_detail->word = $result->word;
                if ((trim(strtolower($result->word))) == (trim(strtolower($_POST['w' . $result->word_id])))) {
                    $test_result_detail->point = 1;
                } else {
                    $test_result_detail->point = 0;
                }
                $test_result_detail->answer = trim(strtolower($_POST['w' . $result->word_id]), " ");
                $test_result_detail->save();
            }
        }

        $total_question = $test_result_detail->where('test_answer_id', $test_answer_id)->count();
        $right_answer = $test_result_detail->where('test_answer_id', $test_answer_id)->where('point', 1)->get()->count();

        $test_result = new VocabularyTestResult();
        $test_result->test_id = $request->test_id;
        $test_result->test_answer_id = $test_answer_id;
        $test_result->name = $request->name;
        $test_result->age = $request->age;
        $test_result->tel = $request->tel;
        $test_result->total_question = $total_question;
        $test_result->right_answer = $right_answer;

        if ((($right_answer / $total_question) * 100) >= 80) {
            $test_result->pass = true;
        } else {
            $test_result->pass = false;
        }
        $test_result->save();

        return redirect()->route('test.result.show', ['id' => $test_answer_id]);
    }

    public function testingShow($id)
    {
        $test_result = VocabularyTestResult::where('test_answer_id', $id)->first();
        $test = VocabularyTest::where('test_id', $test_result->test_id)->first();

        $test_result_detail = VocabularyTestResultDetail::where('test_answer_id', $id)->get();

        return view(
            'front-end.result',
            [
                'test' => $test,
                'test_result' => $test_result,
                'word' => $test_result_detail,
            ]
        );
    }


    public function ranking($id)
    {
        $test = VocabularyTest::where('test_id', $id)->first();
        $ranking = VocabularyTestResult::where('test_id', $id)->orderby('right_answer', 'DESC')->get();

        return view(
            'front-end.ranking',
            [
                'test' => $test,
                'ranking' => $ranking,
            ]
        );
    }
}
