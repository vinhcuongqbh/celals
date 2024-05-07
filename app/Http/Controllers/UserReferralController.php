<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\ReferralStatus;
use App\Models\UserReferral;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserReferralController extends Controller
{
    public function customer(Request $request)
    {
        if (isset($request->date_start)) {
            $date_start = Carbon::parse($request->date_start)->startOfDay();
        } else {
            $date_start = Carbon::now()->startOfMonth()->startOfDay();
        }
        if (isset($request->date_end)) {
            $date_end = Carbon::parse($request->date_end)->endOfDay();
        } else {
            $date_end = Carbon::now()->endOfDay();
        }

        if (Auth::user()->role_id == 1) {
            $userRefs = UserReferral::whereBetween('user_referrals.created_at', [$date_start, $date_end])
                ->leftjoin('users', 'users.user_id', 'user_referrals.user_id')
                ->leftjoin('referral_statuses', 'referral_statuses.ref_status_id', 'user_referrals.ref_status_id')
                ->select('user_referrals.*', 'users.name', 'referral_statuses.ref_status_name')
                ->orderby('ref_status_id', 'asc')
                ->orderby('created_at', 'desc')
                ->get();
        } else {
            $userRefs = UserReferral::whereBetween('user_referrals.created_at', [$date_start, $date_end])
                ->where('user_referrals.user_id', Auth::user()->user_id)
                ->leftjoin('users', 'users.user_id', 'user_referrals.user_id')
                ->leftjoin('referral_statuses', 'referral_statuses.ref_status_id', 'user_referrals.ref_status_id')
                ->select('user_referrals.*', 'users.name', 'referral_statuses.ref_status_name')
                ->orderby('ref_status_id', 'asc')
                ->orderby('created_at', 'desc')
                ->get();
        }

        return view(
            'admin.referral.customer',
            [
                'userRefs' => $userRefs,
                'date_start' => $date_start->toDateString(),
                'date_end' => $date_end->toDateString()
            ]
        );
    }



    public function referrer(Request $request)
    {
        if (isset($request->date_start)) {
            $date_start = Carbon::parse($request->date_start)->startOfDay();
        } else {
            $date_start = Carbon::now()->startOfMonth()->startOfDay();
        }
        if (isset($request->date_end)) {
            $date_end = Carbon::parse($request->date_end)->endOfDay();
        } else {
            $date_end = Carbon::now()->endOfDay();
        }


        if (Auth::user()->role_id == 1) {
            $userRefs = UserReferral::groupBy('user_id')
                ->whereBetween('user_referrals.created_at', [$date_start, $date_end])
                ->select('user_id', DB::raw('count(*) as total'))
                ->orderby('created_at', 'desc')
                ->get();
        } else {
            $userRefs = UserReferral::groupBy('user_id')
                ->whereBetween('created_at', [$date_start, $date_end])
                ->where('user_id', Auth::user()->user_id)
                ->select('user_id', DB::raw('count(*) as total'))
                ->orderby('created_at', 'desc')
                ->get();
        }

        $users = User::where('role_id', '!=', 1)->get();
        foreach ($userRefs as $userRef) {
            foreach ($users as $user) {
                if ($userRef->user_id == $user->user_id) $userRef->name = $user->name;
            }

            $acceptedCustomer = UserReferral::where('user_id', $userRef->user_id)
                ->where('ref_status_id', 3)
                ->whereBetween('user_referrals.created_at', [$date_start, $date_end])
                ->count();

            $userRef->acceptedCustomer = $acceptedCustomer;
            $userRef->acceptedRatio = round((($userRef->acceptedCustomer / $userRef->total) * 100), 2);
        }

        return view(
            'admin.referral.referrer',
            [
                'userRefs' => $userRefs,
                'date_start' => $date_start->toDateString(),
                'date_end' => $date_end->toDateString()
            ]
        );
    }
   


    public function setReferral($id)
    {
        Cookie::queue('referral', $id, 7 * 24 * 60);

        $link = substr(url()->current(), 0, strpos(url()->current(), "ref"));

        return Redirect::to($link);
    }

    public function setReferral2($any, $id)
    {
        Cookie::queue('referral', $id, 7 * 24 * 60);

        $link = substr(url()->current(), 0, strpos(url()->current(), "ref"));

        return Redirect::to($link);
    }


    public function register(Request $request)
    {
        $user = User::where('user_id', Cookie::get('referral'))->first();

        $userRef = new UserReferral();
        if (isset($user)) $userRef->user_id = $user->user_id;
        $userRef->advise_type_id = $request->advise_type_id;
        $userRef->student_name = $request->student_name;
        $userRef->student_age = $request->student_age;
        $userRef->student_email = $request->student_email;
        $userRef->student_tel = $request->student_tel;
        $userRef->student_school = $request->student_school;
        $userRef->ref_status_id = 1;
        $userRef->created_at = Carbon::now();
        $userRef->save();

        return redirect()->route('dang-ky')->with('message', 'Chúc mừng Bạn đã đăng ký thành công.');
    }


    public function show($id)
    {
        $userRef = UserReferral::where('user_referrals.id', $id)
            ->leftjoin('users', 'users.user_id', 'user_referrals.user_id')
            ->select('user_referrals.*', 'users.name')
            ->first();

        $refStatuses = ReferralStatus::all();

        return view(
            'admin.referral.show',
            [
                'userRef' => $userRef,
                'refStatuses' => $refStatuses
            ]
        );
    }


    public function update($id, Request $request)
    {
        $userRef = UserReferral::find($id);
        $userRef->ref_status_id = $request->ref_status_id;
        $userRef->save();

        return back();
    }
}
