<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

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
        $post = Post::where('post_id', $id)            
            ->first();        
        
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
