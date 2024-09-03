<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Center;
use App\Models\ListeningBlock;
use App\Models\StudentListeningBlock;
use App\Models\UserRole;

class UserController extends Controller
{
    // DANH SÁCH USER
    public function index()
    {
        $users = User::all();

        return view('admin.user.index', ['users' => $users]);
    }


    // TẠO MỚI USER
    public function create()
    {
        $centers = Center::where('center_status', 1)->get();
        $userRoles = UserRole::where('role_status', 1)->get();

        return view('admin.user.create', [
            'userRoles' => $userRoles,
            'centers' => $centers,
        ]);
    }

    // LƯU THÔNG TIN USER
    public function store(Request $request)
    {
        // Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'name' => 'required',
            'user_name' => 'required|unique:App\Models\User,user_name',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        // Tạo mới user
        $user = new User;
        $user->name = ucwords($request->name);
        $user->user_name = strtolower($request->user_name);
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->tel = $request->tel;
        $user->email = $request->email;
        $user->center_id = $request->center_id;
        $user->role_id = $request->role_id;
        $user->user_status = 1;
        $user->save();

        // Tạo Listening Block cho Student
        if ($user->role_id == 5) {
            $first_block = ListeningBlock::first();
            $student_listening_block = new StudentListeningBlock();
            $student_listening_block->student_id = $user->user_id;
            $student_listening_block->listening_block_id = $first_block->block_id;
            $student_listening_block->save();
        }

        return redirect()->route('user.show', ['id' => $user->user_id])->with('msg_success', 'Tạo mới thành công');
    }

    // HIỂN THỊ THÔNG TIN USER
    public function show($id)
    {
        $user = User::find($id);

        return view('admin.user.show', ['user' => $user,]);
    }

    // SỬA THÔNG TIN USER
    public function edit($id)
    {
        $centers = Center::where('center_status', 1)->get();
        $userRoles = UserRole::where('role_status', 1)->get();

        $user = User::find($id);

        return view('admin.user.edit', [
            'user' => $user,
            'userRoles' => $userRoles,
            'centers' => $centers,
        ]);
    }

    // CẬP NHẬT THÔNG TIN USER
    public function update(Request $request, $id)
    {
        // Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'name' => 'required',
            'role_id' => 'required',
        ]);

        // Tìm thông tin user
        $user = User::find($id);

        // Cập nhật thông tin user        
        $user->name = ucwords($request->name);
        $user->address = $request->address;
        $user->tel = $request->tel;
        $user->email = $request->email;
        $user->center_id = $request->center_id;
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('user.show', ['id' => $user->user_id])->with('msg_success', 'Cập nhật thành công');
    }


    // KHÓA TÀI KHOẢN USER
    public function destroy($id)
    {
        $user = User::find($id);
        $user->user_status = 0;
        $user->save();

        return back()->with('msg_success', 'Khóa tài khoản thành công');
    }


    // MỞ LẠI TÀI KHOẢN USER
    public function restore($id)
    {
        $user = User::find($id);
        $user->user_status = 1;
        $user->save();

        return back()->with('msg_success', 'Mở lại tài khoản thành công');;
    }

    // CẤP LẠI MẬT MÃ
    public function resetpass(Request $request, $id)
    {
        // Tìm thông tin user
        $user = User::find($id);

        // Cập nhật thông tin user        
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.show', ['id' => $user->user_id])->with('msg_success', 'Cấp lại mật mã thành công');;
    }

    // THOÁT TÀI KHOẢN
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
