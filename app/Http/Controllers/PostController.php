<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\PostCatalogue;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{
    public function index()
    {
        //Hiển thị danh sách bài biết
        $posts = Post::where('post_status', '<>', 0)->get();

        return view('admin.post.index', ['posts' => $posts]);
    }


    public function create()
    {
        $postCatalogues = (new PostCatalogueController)->postCatalogueQuery();

        return view('admin.post.create', [
            'postCatalogues' => $postCatalogues,
        ]);
    }


    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'post_title' => 'required',
            'post_catalogue_id' => 'required',
        ]);

        //Tạo Bài viết mới
        $post = new Post;
        $post->post_title = $request->post_title;
        $post->post_content = $request->post_content;
        $post->post_catalogue_id = $request->post_catalogue_id;
        $post->post_author_id = Auth::id();
        $post->created_at = Carbon::now();
        //Xử lý file tải lên
        if ($request->hasFile('post_img')) {
            $image = $request->post_img;
            $allowedfileExtension = ['jpg', 'jpeg', 'png', 'bmp'];
            $extension = $image->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $imgName = Auth::user()->id . uniqid();
                $img = Image::make($image->path());
                $img->resize(2000, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('../public/storage/File/' . $imgName . '.' . $extension);
                $path = "/storage/File/" . $imgName . "." . $extension;
            }
            $post->post_img = $path;
        }        
        $post->save();

        return redirect()->route('post.edit', ['id' => $post->post_id]);
    }


    public function show($id)
    {
        $post = Post::where('post_id', $id)->first();

        return view('admin.post.show', ['post' => $post]);
    }

    public function edit($id)
    {
        $post = Post::where('post_id', $id)->first();
        $postCatalogues = PostCatalogue::all();

        return view('admin.post.edit', ['post' => $post, 'postCatalogues' => $postCatalogues]);
    }

    public function update(Request $request, $id)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'post_title' => 'required',
            'post_catalogue_id' => 'required',
        ]);

        //Tìm thông tin Bài viết
        $post = Post::where('post_id', $id)->first();
        //Cập nhật thông tin Bài viết
        $post->post_title = $request->post_title;
        $post->post_content = $request->post_content;
        $post->post_catalogue_id = $request->post_catalogue_id;
        $post->post_author_id = Auth::id();
        $post->updated_at = Carbon::now();
        //Xử lý file tải lên
        if ($request->hasFile('post_img')) {
            $image = $request->post_img;
            $allowedfileExtension = ['jpg', 'jpeg', 'png', 'bmp'];
            $extension = $image->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $imgName = Auth::user()->id . uniqid();
                $img = Image::make($image->path());
                $img->resize(2000, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('../public/storage/File/' . $imgName . '.' . $extension);
                $path = "/storage/File/" . $imgName . "." . $extension;
            }
            $post->post_img = $path;
        }
        $post->save();

        return redirect()->route('post.edit', ['id' => $post->post_id]);
    }



    public function search(Request $request)
    {
    }
}
