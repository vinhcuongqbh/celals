<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    //Lấy danh sách Phòng/Đội dựa trên Đơn vị
    public function topicList(Request $request)
    {
        $data['topic'] = Topic::where('level_id', $request->level_id)->orderby('topic_name', 'ASC')
            ->get(['topic_id', 'topic_name']);

        return response()->json($data);
    }
}
