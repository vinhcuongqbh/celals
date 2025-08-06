<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class TintucController extends Controller
{
    public function tinTuc()
    {
        $posts = Post::where('post_catalogue_id', 3)
            ->where('post_status', 1)
            ->orderBy('created_at', 'DESC')
            ->get();        
        
        return view('front-end.tin-tuc', ['posts' => $posts]);
    }

    public function tinTucChiTiet($slug, $id)
    {   
        $post = Post::findOrFail($id);

        // Nếu slug không khớp thì redirect 301 về đúng link
        if ($slug !== Str::slug($post->post_title)) {
            return redirect()->route('posts.show', [
                'id' => $post->id,
                'slug' => Str::slug($post->post_title)
            ], 301);
        }
        
        return view('front-end.tin-tuc-chi-tiet', compact('post'));
    }
}
