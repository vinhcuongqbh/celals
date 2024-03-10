<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Topic;
use App\Models\Vocabulary;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function create() {
        $level = Level::all();
        $topic = Topic::orderBy('topic_name', 'ASC')->get();
        $word = null;

        return view('admin.class.test.create',
        [
            'level' => $level,
            'topic' => $topic,
            'topic2' => $topic,
            'topic3' => $topic,
            'word' => $word
        ]);
    }

    public function search(Request $request) {
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
            ->leftjoin('word_types','word_types.word_type_id', 'vocabularies.word_type_id')
            ->leftjoin('topics','topics.topic_id', 'vocabularies.topic_id')
            ->select('vocabularies.*','word_types.word_type_name','topics.topic_name')
            ->get();            
        } elseif ($request->select == 'automatic_select') {
            $word = Vocabulary::where('vocabularies.level_id', $request->level_id)
            ->where('vocabularies.topic_id', $request->topic_id_1)
            ->orwhere('vocabularies.topic_id', $request->topic_id_2)
            ->orwhere('vocabularies.topic_id', $request->topic_id_3)
            ->leftjoin('word_types','word_types.word_type_id', 'vocabularies.word_type_id')
            ->leftjoin('topics','topics.topic_id', 'vocabularies.topic_id')
            ->select('vocabularies.*','word_types.word_type_name','topics.topic_name')
            ->inRandomOrder()
            ->limit(20)
            ->get(); 
        }

        $level = Level::all();
        $topic = Topic::orderBy('topic_name', 'ASC')->get();
        
        
        return view('admin.class.test.create',
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
        ]);
    }

    public function store(Request $request) {
        //Lấy thông tin các từ vựng được chọn
        $word_selected_id = $request->word_selected_id;        
        
        //Nếu có từ vựng được chọn để xuất kho
        if (isset($word_selected_id)) {
            foreach ($word_selected_id as $word) {
               
            }
        } else {
            return back()->with('msg_error', 'Không có từ vựng nào được lựa chọn');
        }
    }
}
