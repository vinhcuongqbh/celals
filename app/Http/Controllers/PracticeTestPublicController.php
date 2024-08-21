<?php

namespace App\Http\Controllers;

use App\Models\PracticeTestPublic;
use Illuminate\Http\Request;

class PracticeTestPublicController extends Controller
{
    public function index()
    {
        $public_test = PracticeTestPublic::get();

        return view('admin.class.practice_test.public_test_list', ['tests' => $public_test]);
    }


}
