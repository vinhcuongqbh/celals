<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\UserRoleController;
use App\Models\ListeningBlock;
use App\Models\StudentListeningBlock;

class UserController extends Controller
{
    public function userQuery()
    {
        //Hiển thị danh sách Tài khoản đang sử dụng
        $users = User::leftjoin('user_roles', 'user_roles.role_id', 'users.role_id')
            ->leftjoin('centers', 'centers.center_id', 'users.center_id')
            //->where('users.user_status', 1)
            ->select('users.*', 'user_roles.role_name', 'centers.center_name')
            ->orderBy('users.user_id', 'asc')
            ->get();

        return $users;
    }


    public function index()
    {
        //Hiển thị danh sách Tài khoản đang sử dụng
        $users = $this->userQuery();

        return view('admin.user.index', ['users' => $users]);
    }


    public function create()
    {
        $centers = (new CenterController)->centerQuery();
        $userRoles = (new UserRoleController)->roleQuery();

        return view('admin.user.create', [
            'userRoles' => $userRoles,
            'centers' => $centers,
        ]);
    }


    public function store(Request $request)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'name' => 'required',
            'user_name' => 'required|unique:App\Models\User,user_name',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        //Tạo Nhân viên mới
        $user = new User;
        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->tel = $request->tel;
        $user->email = $request->email;
        $user->center_id = $request->center_id;
        $user->role_id = $request->role_id;
        $user->user_status = 1;
        $user->created_at = Carbon::now();
        $user->save();

        //Tạo Listening Block cho Student
        if ($user->role_id == 5) {
            $first_block = ListeningBlock::first();
            $student_listening_block = new StudentListeningBlock();
            $student_listening_block->student_id = $user->user_id;
            $student_listening_block->listening_block_id = $first_block->block_id;
            $student_listening_block->save();
        }

        return redirect()->route('user.show', ['id' => $user->user_id]);
    }


    public function show($id)
    {
        $user = User::where('user_id', $id)
            ->where('users.user_status', 1)
            ->leftjoin('user_roles', 'user_roles.role_id', 'users.role_id')
            ->leftjoin('centers', 'centers.center_id', 'users.center_id')
            ->select('users.*', 'user_roles.role_name', 'centers.center_name')
            ->first();

        return view('admin.user.show', ['user' => $user,]);
    }


    public function edit($id)
    {
        $centers = (new CenterController)->centerQuery();
        $userRoles = (new UserRoleController)->roleQuery();

        $user = User::where('user_id', $id)->first();

        return view('admin.user.edit', [
            'user' => $user,
            'userRoles' => $userRoles,
            'centers' => $centers,
        ]);
    }


    public function update(Request $request, $id)
    {
        //Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'name' => 'required',
            'role_id' => 'required',
        ]);

        //Tìm thông tin Nhân viên
        $user = User::where('user_id', $id)->first();

        //Cập nhật thông tin Nhân viên        
        $user->name = $request->name;
        $user->address = $request->address;
        $user->tel = $request->tel;
        $user->email = $request->email;
        $user->center_id = $request->center_id;
        $user->role_id = $request->role_id;
        $user->updated_at = Carbon::now();
        $user->save();

        return redirect()->route('user.show', ['id' => $user->user_id]);
    }


    //Khóa tài khoản Nhân viên
    public function destroy($id)
    {
        $user = User::where('user_id', $id)->first();
        $user->user_status = 0;
        $user->save();

        return back();
    }


    //Mở lại tài khoản Nhân viên
    public function restore($id)
    {
        $user = User::where('user_id', $id)->first();
        $user->user_status = 1;
        $user->save();

        return back();
    }

    // Cấp lại mật mã cho tài khoản
    public function resetpass(Request $request, $id)
    {
        //Tìm thông tin Nhân viên
        $user = User::where('user_id', $id)->first();

        //Cập nhật thông tin Nhân viên        
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.show', ['id' => $user->user_id]);
    }

    // Tìm kiếm nhân viên
    public function search(Request $request)
    {

        $user = User::leftjoin('moz_roles', 'moz_roles.roleId', 'moz_users.roleId')
            ->leftjoin('asahi_center', 'asahi_center.centerId', 'moz_users.centerId')
            ->select('moz_users.*', 'moz_roles.roleName', 'asahi_center.centerName')
            ->orderBy('userId', 'desc');

        if (isset($request->userID)) $user->where('userId', $request->userID);
        if (isset($request->userName)) $user->where('name', 'LIKE', '%' . $request->userName . '%');
        if (isset($request->centerID)) $user->where('asahi_center.centerId', $request->centerID);
        if (isset($request->centerName)) $user->where('centerName', 'LIKE', '%' . $request->centerName . '%');

        $user = $user->get();

        if (Auth::user()->roleId != 3) return view('admin.user.result', ['users' => $user]);
    }


    //Thoát tài khoản 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
