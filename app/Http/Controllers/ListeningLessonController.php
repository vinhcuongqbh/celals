<?php

namespace App\Http\Controllers;

use App\Models\ListeningLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListeningLessonController extends Controller
{
    public function lessonList()
    {
        $lesson = ListeningLesson::all();

        return view('admin.class.listening.lesson_list', ['lesson' => $lesson]);
    }

    public function lessonCreate()
    {
        return view('admin.class.listening.lesson_create');
    }

    public function lessonStore(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'subject' => 'required',
            'link_audio' => 'required',
        ]);

        //Tạo Bài nghe mới
        $lesson = new ListeningLesson();
        $lesson->lesson_id = uniqid();
        $lesson->subject = $request->subject;
        //Xử lý link audio
        if (!empty($request->file('link_audio'))) {
            $file = Storage::putFile('/public/File/Audio', $request->file('link_audio'));
            $path = Storage::url($file);
        }
        $lesson->link_audio = $path;
        $lesson->answer = $request->answer;
        //Xử lý link đáp án
        if (!empty($request->file('link_answer'))) {
            $file = Storage::putFile('/public/File/Img', $request->file('link_answer'));
            $path = Storage::url($file);
        }
        $lesson->link_answer = $path;
        $lesson->save();

        return redirect()->route('listening.lesson_show', ['id' => $lesson->lesson_id]);
    }


    public function lessonShow($id)
    {
        $lesson = ListeningLesson::where('lesson_id', $id)->first();
        return view('admin.class.listening.lesson_show', ['lesson' => $lesson]);
    }


    public function lessonEdit($id)
    {
        $lesson = ListeningLesson::where('lesson_id', $id)->first();
        return view('admin.class.listening.lesson_edit', ['lesson' => $lesson]);
    }

    public function lessonUpdate($id, Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'subject' => 'required',
        ]);

        //Tạo Bài nghe mới
        $lesson = ListeningLesson::where('lesson_id', $id)->first();
        $lesson->subject = $request->subject;

        //Xử lý link audio
        if (!empty($request->file('link_audio'))) {
            //Xóa file audio cũ
            Storage::delete($lesson->link_audio);
            
            $file = Storage::putFile('/public/File/Audio', $request->file('link_audio'));
            $path = Storage::url($file);
            $lesson->link_audio = $path;
        }        
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
