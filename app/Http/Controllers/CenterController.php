<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CenterController extends Controller
{
    public function index()
    {
        // Hiển thị danh sách Trung tâm đang sử dụng
        $centers = Center::all();

        return view('admin.center.index', ['centers' => $centers]);
    }


    // TẠO MỚI CENTER
    public function create()
    {
        return view('admin.center.create');
    }

    // LƯU THÔNG TIN CENTER
    public function store(Request $request)
    {
        // Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'center_name' => 'required|unique:App\Models\Center,center_name',
        ]);

        // Tạo mới center
        $center = new Center;
        //Xử lý file tải lên
        if ($request->hasFile('link_logo')) {
            if (!empty($center->link_logo) && Storage::disk('public')->exists(str_replace('/storage/', '', $center->link_logo))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $center->link_logo));
            }

            $image = $request->file('link_logo');
            $extension = strtolower($image->getClientOriginalExtension());
            $allowed = ['jpg', 'jpeg', 'png', 'bmp'];

            if (in_array($extension, $allowed)) {
                $imgName = Auth::id() . '_' . uniqid() . '.' . $extension;

                // ✅ Đường dẫn thực tế để lưu file
                $savePath = storage_path('app/public/File/' . $imgName);

                // ✅ Resize và lưu ảnh
                $img = Image::make($image->getRealPath());
                $img->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($savePath);

                // ✅ Đường dẫn public để hiển thị
                $center->link_logo = '/storage/File/' . $imgName;
            }
        }              
        $center->center_name = strtolower($request->center_name);
        $center->center_address = $request->center_address;
        $center->center_status = 1;
        $center->save();

        return redirect()->route('center.show', ['id' => $center->center_id])->with('msg_success', 'Tạo mới thành công');
    }

    // HIỂN THỊ THÔNG TIN CENTER
    public function show($id)
    {
        $center = Center::find($id);

        return view('admin.center.show', ['center' => $center,]);
    }

    // SỬA THÔNG TIN CENTER
    public function edit($id)
    {
        $center = Center::find($id);

        return view('admin.center.edit', [
            'center' => $center,
        ]);
    }

    // CẬP NHẬT THÔNG TIN CENTER
    public function update(Request $request, $id)
    {
        // Kiểm tra thông tin đầu vào
        $validated = $request->validate([
            'center_name' => 'required',
        ]);

        // Tìm thông tin center
        $center = Center::find($id);


        // Cập nhật thông tin center
        //Xử lý file tải lên
        if ($request->hasFile('link_logo')) {
            if (!empty($center->link_logo) && Storage::disk('public')->exists(str_replace('/storage/', '', $center->link_logo))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $center->link_logo));
            }

            $image = $request->file('link_logo');
            $extension = strtolower($image->getClientOriginalExtension());
            $allowed = ['jpg', 'jpeg', 'png', 'bmp'];

            if (in_array($extension, $allowed)) {
                $imgName = Auth::id() . '_' . uniqid() . '.' . $extension;

                // ✅ Đường dẫn thực tế để lưu file
                $savePath = storage_path('app/public/File/' . $imgName);

                // ✅ Resize và lưu ảnh
                $img = Image::make($image->getRealPath());
                $img->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($savePath);

                // ✅ Đường dẫn public để hiển thị
                $center->link_logo = '/storage/File/' . $imgName;
            }
        }       
        $center->center_name = $request->center_name;
        $center->center_address = $request->center_address;   
        $center->save();

        return redirect()->route('center.show', ['id' => $center->center_id])->with('msg_success', 'Cập nhật thành công');
    }


    // KHÓA CENTER
    public function destroy($id)
    {
        $center = Center::find($id);
        $center->center_status = 0;
        $center->save();

        return back()->with('msg_success', 'Khóa tài khoản thành công');
    }


    // MỞ LẠI CENTER
    public function restore($id)
    {
        $center = Center::find($id);
        $center->center_status = 1;
        $center->save();

        return back()->with('msg_success', 'Mở lại tài khoản thành công');;
    }
}
