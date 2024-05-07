<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class GioiThieuController extends Controller
{    
    public function gioiThieu()
    {
        $post = Post::where('post_catalogue_id', 1)
            ->where('post_status', 1)
            ->orderBy('created_at', 'ASC')
            ->first();
        
        return view('front-end.gioi-thieu', ['post' => $post]);
    }
}
