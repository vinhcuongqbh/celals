<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRole;

class UserRoleController extends Controller
{
    public function roleQuery()
    {
        //Hiển thị danh sách Tài khoản đang sử dụng
        $user_roles = UserRole::where('role_status', 1)->get();

        return $user_roles;
    }

    public function index()
    {
        //Hiển thị danh sách Tài khoản đang sử dụng
        $userRoles = $this->roleQuery();

        return view('admin.center.index', ['userRoles' => $userRoles]);
    }
}
