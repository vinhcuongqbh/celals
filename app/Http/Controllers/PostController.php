<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //Hiển thị danh sách bài biết
        $posts = Post::where('post_status', '<>', 0 )->get();

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
            'post_content' => 'required',
            'post_catalogue_id' => 'required',
        ]);

        //Tạo Nhân viên mới
        $post = new Post;
        $post->post_title = $request->post_title;
        $post->post_content = $request->post_content;
        //$post->post_img = $request->post_img;
        $post->post_catalogue_id = $request->post_catalogue_id;
        $post->created_at = Carbon::now();
        $post->save();

        echo $post->post_title;

        //return redirect()->route('post.show', ['id' => $post->post_id]);
    }



    public function show($id)
    {      
        $post = Post::where('post_id', $id)->first();

        return view('admin.post.show', ['post' => $post,]);
    }



    public function search(Request $request)
    {

    }
}
