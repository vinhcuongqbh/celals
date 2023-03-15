<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserReferral;

class UserReferralController extends Controller
{
    public function index()
    {
        $userRef = UserReferral::all();        

        return view('admin.referral.index', ['userRef' => $userRef]);
    }
}
