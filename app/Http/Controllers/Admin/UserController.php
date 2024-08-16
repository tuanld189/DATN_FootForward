<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Permission;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const PATH_UPLOAD = 'users';

    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('username', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $users = $query->latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        $roles = Role::all();
        $provinces = Province::all();

        return view('admin.users.create', compact('roles', 'provinces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:20',
            'phone' => 'required|string|max:10|regex:/^[0-9]{10}$/',
            'photo_thumbs' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'province_code' => 'required|string|max:20|exists:provinces,code',
            'district_code' => 'required|string|max:20|exists:districts,code',
            'ward_code' => 'required|string|max:20|exists:wards,code',
        ]);

        $data = $request->except('photo_thumbs', 'roles', 'permission_ids');

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('photo_thumbs')) {
            $data['photo_thumbs'] = Storage::put('uploads', $request->file('photo_thumbs'));
        }

        $data['password'] = Hash::make($request->password);

        $user = User::create($data);
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')->with('status', 'User Created Successfully');
    }

    public function edit($id)
    {
        $roles = Role::all();
        $provinces = Province::all();
        $user = User::findOrFail($id);
        $districts = District::where('province_code', $user->province_code)->get();
        $wards = Ward::where('district_code', $user->district_code)->get();

        return view('admin.users.edit', compact('user', 'roles', 'provinces', 'districts', 'wards'));
    }

    public function update(Request $request, $id)
    {
        // Tìm user theo id, nếu không tìm thấy thì trả về lỗi 404
        $user = User::findOrFail($id);

        // Xác thực dữ liệu đầu vào
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:10',
            'photo_thumbs' => 'nullable|image',
            'status' => 'required|string|max:255',
            'province_code' => 'required|string|max:20',
            'district_code' => 'required|string|max:20',
            'ward_code' => 'required|string|max:20',
            'roles' => 'required|array',  // Thêm điều kiện bắt buộc cho roles
        ]);

        // Lấy dữ liệu từ request ngoại trừ photo_thumbs
        $data = $request->except(['photo_thumbs', 'roles', 'permissions']);

        // Nếu có file ảnh được upload thì xử lý việc lưu ảnh
        if ($request->hasFile('photo_thumbs')) {
            $data['photo_thumbs'] = Storage::put(self::PATH_UPLOAD, $request->file('photo_thumbs'));

            // Xóa ảnh cũ nếu có
            if ($user->photo_thumbs && Storage::exists($user->photo_thumbs)) {
                Storage::delete($user->photo_thumbs);
            }
        }

        // Nếu có password được gửi trong request thì mã hóa và lưu lại
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Cập nhật dữ liệu người dùng
        $user->update($data);

        // Cập nhật vai trò (roles) cho người dùng
        $user->roles()->sync($request->roles);

        // Cập nhật quyền hạn (permissions) cho người dùng, nếu có
        if ($request->has('permissions')) {
            $user->permissions()->sync($request->permissions);
        }

        // Chuyển hướng về trang danh sách người dùng với thông báo thành công
        return redirect()->route('admin.users.index')->with('status', 'User Updated Successfully');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->photo_thumbs && Storage::exists($user->photo_thumbs)) {
            Storage::delete($user->photo_thumbs);
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('status', 'User Deleted Successfully');
    }
    // public function destroy($id)
    // {
    //     try {
    //         // Tìm người dùng, nếu không tìm thấy thì ném ngoại lệ
    //         $user = User::findOrFail($id);

    //         // Kiểm tra và xóa ảnh đại diện nếu tồn tại
    //         if ($user->photo_thumbs && Storage::exists($user->photo_thumbs)) {
    //             Storage::delete($user->photo_thumbs);
    //         }

    //         // Xóa người dùng
    //         $user->delete();

    //         // Trả về phản hồi thành công
    //         return redirect()->route('admin.users.index')->with('status', 'User Deleted Successfully');
    //     } catch (\Exception $e) {
    //         // Xử lý ngoại lệ nếu có vấn đề xảy ra
    //         return redirect()->route('admin.users.index')->with('error', 'There was a problem deleting the user: ' . $e->getMessage());
    //     }
    // }


    public function getDistricts($province_code)
    {
        $districts = District::where('province_code', $province_code)->get();
        return response()->json($districts);
    }

    public function getWards($district_code)
    {
        $wards = Ward::where('district_code', $district_code)->get();
        return response()->json($wards);
    }
}
