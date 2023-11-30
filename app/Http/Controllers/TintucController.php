<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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

    public function tinTucChiTiet($id)
    {
        $post = Post::where('post_id', $id)            
            ->first();        
        
        return view('front-end.tin-tuc-chi-tiet', ['post' => $post]);
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
