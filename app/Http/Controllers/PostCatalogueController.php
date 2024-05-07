<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostCatalogue;

class PostCatalogueController extends Controller
{
    public function PostCatalogueQuery()
    {
        //Hiển thị danh sách Tài khoản đang sử dụng
        $postCatalogue = postCatalogue::where('post_catalogue_status', 1)->get();

        return $postCatalogue;
    }
}
