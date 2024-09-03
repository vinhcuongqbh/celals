<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\PostCatalogue;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // DANH SÁCH BÀI VIẾT
    public function index()
    {
        $posts = Post::orderby('created_at', 'desc')->get();

        return view('admin.post.index', ['posts' => $posts]);
    }

    // TẠO MỚI BÀI VIẾT
    public function create()
    {
        $postCatalogues = PostCatalogue::all();

        return view('admin.post.create', [
            'postCatalogues' => $postCatalogues,
        ]);
    }

    // LƯU BÀI VIẾT
    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'post_title' => 'required',
            'post_catalogue_id' => 'required',
        ]);

        //Tạo mới BÀI VIẾT
        $post = new Post;
        $post->post_title = $request->post_title;
        $post->post_content = $request->post_content;
        $post->post_catalogue_id = $request->post_catalogue_id;
        $post->post_author_id = Auth::id();
        $post->post_status = 0;

        //Xử lý file tải lên
        if ($request->hasFile('post_img')) {
            $image = $request->post_img;
            $allowedfileExtension = ['jpg', 'jpeg', 'png', 'bmp'];
            $extension = $image->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $imgName = Auth::user()->id . uniqid();
                $img = Image::make($image->path());
                $img->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('../public/storage/File/' . $imgName . '.' . $extension);
                $path = "/File/" . $imgName . "." . $extension;
            }
            $post->post_img = $path;
        }
        $post->save();

        return redirect()->route('post.edit', ['id' => $post->post_id])->with('msg_success', 'Tạo mới thành công');
    }

    // HIỂN THỊ BÀI VIẾT
    public function show($id)
    {
        $post = Post::find($id);

        return view('admin.post.show', ['post' => $post]);
    }

    // SỬA BÀI VIẾT
    public function edit($id)
    {
        $post = Post::find($id);
        $postCatalogues = PostCatalogue::all();

        return view('admin.post.edit', ['post' => $post, 'postCatalogues' => $postCatalogues]);
    }

    // CẬP NHẬT BÀI VIẾT
    public function update(Request $request, $id)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'post_title' => 'required',
            'post_catalogue_id' => 'required',
        ]);

        //Cập nhật thông tin Bài viết
        $post = Post::find($id);
        $post->post_title = $request->post_title;
        $post->post_content = $request->post_content;
        $post->post_catalogue_id = $request->post_catalogue_id;
        $post->post_author_id = Auth::id();
        $post->post_status = 0;

        //Xử lý file tải lên
        if ($request->hasFile('post_img')) {
            if (Storage::disk('public')->exists($post->post_img)) {
                Storage::disk('public')->delete($post->post_img);
            }
            $image = $request->post_img;
            $allowedfileExtension = ['jpg', 'jpeg', 'png', 'bmp'];
            $extension = $image->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $imgName = Auth::user()->id . uniqid();
                $img = Image::make($image->path());
                $img->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('../public/storage/File/' . $imgName . '.' . $extension);
                $path = "/File/" . $imgName . "." . $extension;
            }
            $post->post_img = $path;
        }
        $post->save();

        return redirect()->route('post.edit', ['id' => $post->post_id])->with('msg_success', 'Cập nhật thành công');
    }


    // ĐĂNG BÀI VIẾT
    public function public($id)
    {
        $post = Post::find($id);
        $post->post_status = 1;
        $post->save();

        return back()->with('msg_success', 'Đăng bài thành công');
    }

    // ẨN BÀI VIẾT
    public function unpublic($id)
    {
        $post = Post::find($id);
        $post->post_status = 0;
        $post->save();

        return back()->with('msg_success', 'Gỡ bài thành công');
    }

    // XÓA BÀI VIẾT
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return back()->with('msg_success', 'Xóa bài thành công');
    }
}
