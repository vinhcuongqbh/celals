<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\ListeningLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListeningLessonController extends Controller
{
    public function lessonList()
    {
        $lesson = ListeningLesson::leftjoin('levels', 'levels.level_id', 'listening_lessons.level_id')
            ->select('listening_lessons.*', 'levels.level_name')
            ->get();

        return view('admin.class.listening.lesson_list', ['lesson' => $lesson]);
    }

    public function lessonCreate()
    {
        $levels = Level::all();

        return view('admin.class.listening.lesson_create', ['levels' => $levels]);
    }

    public function lessonStore(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'level_id' => 'required',
            'subject' => 'required',
            'link_audio' => 'required',
        ]);

        //Tạo Bài nghe mới
        $lesson = new ListeningLesson();
        $lesson->lesson_id = uniqid();
        $lesson->level_id = $request->level_id;
        $lesson->subject = $request->subject;
        //Xử lý link audio
        if (!empty($request->file('link_audio'))) {
            $file = Storage::putFile('/public/File/Audio', $request->file('link_audio'));
            $path = Storage::url($file);
            $lesson->link_audio = $path;
        }        
        $lesson->question = $request->question;
        $lesson->answer = $request->answer;
        //Xử lý link đáp án
        if (!empty($request->file('link_answer'))) {
            $file = Storage::putFile('/public/File/Img', $request->file('link_answer'));
            $path = Storage::url($file);
            $lesson->link_answer = $path;
        }
        $lesson->save();

        return redirect()->route('listening.lesson_show', ['id' => $lesson->lesson_id])->with('msg_success','Đã tạo mới Bài nghe thành công');
    }


    public function lessonShow($id)
    {
        $lesson = ListeningLesson::where('lesson_id', $id)
                  ->leftjoin('levels','levels.level_id', 'listening_lessons.level_id')
                  ->select('listening_lessons.*', 'levels.level_name')
                  ->first();

        return view('admin.class.listening.lesson_show', ['lesson' => $lesson]);
    }


    public function lessonEdit($id)
    {

        $lesson = ListeningLesson::where('lesson_id', $id)->first();
        $levels = Level::all();

        return view('admin.class.listening.lesson_edit', ['lesson' => $lesson, 'levels' => $levels]);
    }

    public function lessonUpdate($id, Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'level_id' => 'required',
            'subject' => 'required',
        ]);

        //Tạo Bài nghe mới
        $lesson = ListeningLesson::where('lesson_id', $id)->first();
        $lesson->level_id = $request->level_id;
        $lesson->subject = $request->subject;

        //Xử lý link audio
        if (!empty($request->file('link_audio'))) {
            //Xóa file audio cũ
            Storage::delete($lesson->link_audio);
            
            $file = Storage::putFile('/public/File/Audio', $request->file('link_audio'));
            $path = Storage::url($file);
            $lesson->link_audio = $path;
        }        
        $lesson->question = $request->question;
        $lesson->answer = $request->answer;
        //Xử lý link câu trả lời
        if (!empty($request->file('link_answer'))) {
            //Xóa file ảnh cũ
            Storage::delete($lesson->link_answer);

            $file = Storage::putFile('/public/File/Img', $request->file('link_answer'));
            $path = Storage::url($file);
            $lesson->link_answer = $path;
        }        
        $lesson->save();

        return redirect()->route('listening.lesson_show', ['id' => $lesson->lesson_id]);
    }
}
