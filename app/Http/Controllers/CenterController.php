<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;

class CenterController extends Controller
{
    public function centerQuery()
    {
        //Hiển thị danh sách Tài khoản đang sử dụng
        $centers = Center::where('center_status', 1)->get();

        return $centers;
    }

    public function index()
    {
        //Hiển thị danh sách Tài khoản đang sử dụng
        $centers = $this->centerQuery();

        return view('admin.center.index', ['centers' => $centers]);
    }
}
