<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\PostCatalogue;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Logger\ConsoleLogger;

class PostController extends Controller
{
    public function index()
    {
        //Hiển thị danh sách bài biết
        $posts = Post::leftjoin('post_catalogues', 'post_catalogues.post_catalogue_id', 'posts.post_catalogue_id')
            ->leftjoin('users', 'users.user_id', 'posts.post_author_id')
            ->select('posts.*', 'post_catalogues.post_catalogue_name', 'users.name')
            ->orderby('created_at', 'desc')
            ->get();

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
        $post->post_status = 0;
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
                $img->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('../public/storage/File/' . $imgName . '.' . $extension);
                $path = "/File/" . $imgName . "." . $extension;
            }
            $post->post_img = $path;
        }
        $post->save();

        return redirect()->route('post.edit', ['id' => $post->post_id])->with('message', __('storedPost'));
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
        $post->post_status = 0;
        $post->updated_at = Carbon::now();

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

        return redirect()->route('post.edit', ['id' => $post->post_id])->with('message', __('updatedPost'));
    }


    //Đăng bài viết
    public function public($id)
    {
        $post = Post::where('post_id', $id)->first();
        $post->post_status = 1;
        $post->save();

        return back()->with('message', __('publicedPost'));
    }


    //Ẩn bài viết
    public function unpublic($id)
    {
        $post = Post::where('post_id', $id)->first();
        $post->post_status = 0;
        $post->save();

        return back()->with('message', __('unpublicedPost'));
    }

    //Xóa bài viết
    public function destroy($id)
    {
        $post = Post::where('post_id', $id)->first();
        $post->delete();

        return back()->with('message', __('destroyedPost'));
    }


    public function search(Request $request)
    {
    }
}
