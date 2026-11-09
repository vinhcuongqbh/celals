<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\ListeningLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\BunnyStorageService;
use Illuminate\Support\Facades\Log;

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

    // public function lessonStore(Request $request)
    // {
    //     //Kiểm tra thông tin đầu vào
    //     $validated = $request->validate([
    //         'level_id' => 'required',
    //         'subject' => 'required',
    //         'link_audio' => 'required',
    //     ]);

    //     //Tạo Bài nghe mới
    //     $lesson = new ListeningLesson();
    //     $lesson->lesson_id = uniqid();
    //     $lesson->level_id = $request->level_id;
    //     $lesson->subject = $request->subject;
    //     //Xử lý link audio
    //     if (!empty($request->file('link_audio'))) {
    //         $file = Storage::putFile('/public/File/Audio', $request->file('link_audio'));
    //         $path = Storage::url($file);
    //         $lesson->link_audio = $path;
    //     }        
    //     $lesson->question = $request->question;
    //     $lesson->answer = $request->answer;
    //     //Xử lý link đáp án
    //     if (!empty($request->file('link_answer'))) {
    //         $file = Storage::putFile('/public/File/Img', $request->file('link_answer'));
    //         $path = Storage::url($file);
    //         $lesson->link_answer = $path;
    //     }
    //     $lesson->save();

    //     return redirect()->route('listening.lesson_show', ['id' => $lesson->lesson_id])->with('msg_success','Đã tạo mới Bài nghe thành công');
    // }

    public function lessonStore(Request $request)
    {
        $request->validate([
            'level_id'    => 'required',
            'subject'     => 'required',
            'link_audio'  => 'required|file|mimes:mp3,wav,m4a,ogg|max:51200',
            'link_answer' => 'nullable|file|image|max:10240',
        ]);

        // Upload file trực tiếp lên Bunny.net Storage
        $uploadToBunny = function ($uploadedFile, $folder) {
            if (!$uploadedFile) {
                return null;
            }

            $zone = config('services.bunny.storage_zone');
            $password = config('services.bunny.storage_password');
            $region = config('services.bunny.storage_region');
            $cdnUrl = rtrim(config('services.bunny.cdn_url'), '/');

            // Tên file duy nhất, tránh trùng tên khi upload
            $extension = strtolower($uploadedFile->getClientOriginalExtension());
            $filename = Str::uuid()->toString() . '.' . $extension;

            // Endpoint mặc định hoặc endpoint theo vùng chính
            $storageHost = $region === 'storage'
                ? 'storage.bunnycdn.com'
                : $region . '.storage.bunnycdn.com';

            $storagePath = 'listening_lessons/' . $folder . '/' . $filename;

            $response = Http::withHeaders([
                'AccessKey' => $password,
                'Content-Type' => 'application/octet-stream',
            ])->withBody(
                file_get_contents($uploadedFile->getRealPath()),
                'application/octet-stream'
            )->put(
                'https://' . $storageHost . '/' . $zone . '/' . $storagePath
            );

            if (!$response->successful()) {
                throw new \RuntimeException(
                    'Bunny.net upload thất bại: HTTP ' . $response->status()
                );
            }

            // Lưu URL CDN vào database, không lưu URL API upload
            return $cdnUrl . '/' . $storagePath;
        };

        $lesson = new ListeningLesson();
        $lesson->lesson_id = uniqid();
        $lesson->level_id = $request->level_id;
        $lesson->subject = $request->subject;

        $lesson->link_audio = $uploadToBunny(
            $request->file('link_audio'),
            ''
        );

        $lesson->question = $request->question;
        $lesson->answer = $request->answer;

        $lesson->save();

        return redirect()
            ->route('listening.lesson_show', [
                'id' => $lesson->lesson_id
            ])
            ->with('msg_success', 'Đã tạo mới Bài nghe thành công');
    }

    public function lessonShow($id)
    {
        $lesson = ListeningLesson::where('lesson_id', $id)
            ->leftjoin('levels', 'levels.level_id', 'listening_lessons.level_id')
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

    // public function lessonUpdate($id, Request $request)
    // {
    //     //Kiểm tra thông tin đầu vào
    //     $validated = $request->validate([
    //         'level_id' => 'required',
    //         'subject' => 'required',
    //     ]);

    //     //Tìm Bài nghe
    //     $lesson = ListeningLesson::where('lesson_id', $id)->first();
    //     $lesson->level_id = $request->level_id;
    //     $lesson->subject = $request->subject;

    //     //Xử lý link audio
    //     if (!empty($request->file('link_audio'))) {
    //         //Xóa file audio cũ
    //         Storage::delete($lesson->link_audio);

    //         $file = Storage::putFile('/public/File/Audio', $request->file('link_audio'));
    //         $path = Storage::url($file);
    //         $lesson->link_audio = $path;
    //     }
    //     $lesson->question = $request->question;
    //     $lesson->answer = $request->answer;
    //     //Xử lý link câu trả lời
    //     if (!empty($request->file('link_answer'))) {
    //         //Xóa file ảnh cũ
    //         Storage::delete($lesson->link_answer);

    //         $file = Storage::putFile('/public/File/Img', $request->file('link_answer'));
    //         $path = Storage::url($file);
    //         $lesson->link_answer = $path;
    //     }
    //     $lesson->save();

    //     return redirect()->route('listening.lesson_show', ['id' => $lesson->lesson_id]);
    // }

    public function lessonUpdate(
        $id,
        Request $request,
        BunnyStorageService $bunny
    ) {
        // Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'level_id' => 'required',
            'subject'  => 'required',
        ]);

        // Tìm bài nghe
        $lesson = ListeningLesson::where('lesson_id', $id)->firstOrFail();

        $lesson->level_id = $request->level_id;
        $lesson->subject = $request->subject;

        // Hàm upload file lên Bunny.net
        $uploadToBunny = function ($uploadedFile, $folder) {
            if (!$uploadedFile) {
                return null;
            }

            $zone = config('services.bunny.storage_zone');
            $password = config('services.bunny.storage_password');
            $region = config('services.bunny.storage_region');
            $cdnUrl = rtrim(config('services.bunny.cdn_url'), '/');

            // Tên file duy nhất, tránh trùng tên khi upload
            $extension = strtolower($uploadedFile->getClientOriginalExtension());
            $filename = Str::uuid()->toString() . '.' . $extension;

            // Endpoint mặc định hoặc endpoint theo vùng chính
            $storageHost = $region === 'storage'
                ? 'storage.bunnycdn.com'
                : $region . '.storage.bunnycdn.com';

            $storagePath = 'listening_lessons/' . $folder . '/' . $filename;

            $response = Http::withHeaders([
                'AccessKey' => $password,
                'Content-Type' => 'application/octet-stream',
            ])->withBody(
                file_get_contents($uploadedFile->getRealPath()),
                'application/octet-stream'
            )->put(
                'https://' . $storageHost . '/' . $zone . '/' . $storagePath
            );

            if (!$response->successful()) {
                throw new \RuntimeException(
                    'Bunny.net upload thất bại: HTTP ' . $response->status()
                );
            }

            // Lưu URL CDN vào database, không lưu URL API upload
            return $cdnUrl . '/' . $storagePath;
        };

        // Cập nhật audio
        if ($request->hasFile('link_audio')) {
            $oldAudio = $lesson->link_audio;

            $newAudio = $uploadToBunny(
                $request->file('link_audio'),
                ''
            );

            $lesson->link_audio = $newAudio;
        }

        $lesson->question = $request->question;
        $lesson->answer = $request->answer;

        // Lưu dữ liệu mới trước
        $lesson->save();

        // Xóa file cũ sau khi lưu thành công
        foreach ([$oldAudio ?? null, $oldAnswer ?? null] as $oldUrl) {
            if (!$oldUrl) {
                continue;
            }

            try {
                $bunny->deleteByCdnUrl($oldUrl);
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error(
                    'Không xóa được file cũ trên Bunny.net',
                    [
                        'url' => $oldUrl,
                        'error' => $e->getMessage(),
                    ]
                );
            }
        }

        return redirect()->route(
            'listening.lesson_show',
            ['id' => $lesson->lesson_id]
        );
    }
}
