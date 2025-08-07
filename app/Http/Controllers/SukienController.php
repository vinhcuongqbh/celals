<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SukienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function suKien()
    {
        $posts = Post::where('post_catalogue_id', 2)
            ->where('post_status', 1)
            ->orderBy('created_at', 'DESC')
            ->get();        
        
        return view('front-end.su-kien', ['posts' => $posts]);
    }

    public function suKienChiTiet($id)
    {
        $post = Post::findOrFail($id);

        // Nếu slug không khớp thì redirect 301 về đúng link
        if ($slug !== Str::slug($post->post_title)) {
            return redirect()->route('posts.show', [
                'id' => $post->id,
                'slug' => Str::slug($post->post_title)
            ], 301);
        }
        
        return view('front-end.su-kien-chi-tiet', ['post' => $post]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
