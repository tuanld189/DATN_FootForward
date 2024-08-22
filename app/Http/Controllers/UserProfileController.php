<?php

namespace App\Http\Controllers;

use App\Events\PasswordResetRequested;
use App\Models\District;
use App\Models\Province;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class UserProfileController extends Controller
{

    // public function edit($id)
    // {
    //     $user = User::with('orders')->findOrFail($id);
    //     $orders = Order::where('user_id', $id)->get();

    //     return view('client.profile.edit', [
    //         'user' => $user,
    //         'orders' => $orders
    //     ]);
    // }
    public function edit($id)
    {
        $user = User::with('orders')->findOrFail($id);

        // Lấy danh sách các tỉnh từ cơ sở dữ liệu
        $provinces = Province::all();

        // Nếu người dùng đã chọn tỉnh, tải các huyện tương ứng
        $districts = $user->province_code ? District::where('province_code', $user->province_code)->get() : [];

        // Nếu người dùng đã chọn huyện, tải các xã tương ứng
        $wards = $user->district_code ? Ward::where('district_code', $user->district_code)->get() : [];

        $orders = Order::where('user_id', $id)
            ->orderBy('created_at', 'desc') // Sắp xếp đơn hàng theo ngày tạo, mới nhất trước
            ->get();

        return view('client.profile.edit', [
            'user' => $user,
            'orders' => $orders,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards
        ]);
    }


    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        return view('client.profile.order', compact('order', 'orderItems'));
    }

    public function cancel($id)
    {
        $order = Order::find($id);

        // Kiểm tra nếu đơn hàng tồn tại
        if (!$order) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại.');
        }

        // Kiểm tra trạng thái đơn hàng và trạng thái thanh toán
        if ($order->status_order == 'pending' && $order->status_payment == 'unpaid') {
            $order->status_order = 'canceled';
            $order->canceled_at = Carbon::now('Asia/Ho_Chi_Minh');
            $order->save();
            return redirect()->back()->with('success', 'Đơn hàng đã được hủy.');
        }

        // Nếu đơn hàng đã thanh toán hoặc không ở trạng thái 'pending'
        return redirect()->back()->with('error', 'Không thể hủy đơn hàng này.');
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'province_code' => 'required|string|max:10', // Thêm quy tắc validate cho tỉnh
            'district_code' => 'required|string|max:10', // Thêm quy tắc validate cho huyện
            'ward_code' => 'required|string|max:10', // Thêm quy tắc validate cho xã
            'photo_thumbs' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('photo_thumbs');

        if ($request->hasFile('photo_thumbs')) {
            if ($user->photo_thumbs && Storage::exists($user->photo_thumbs)) {
                Storage::delete($user->photo_thumbs);
            }

            $path = Storage::put('public/users', $request->file('photo_thumbs'));
            $data['photo_thumbs'] = $path;
        }

        $user->update($data);

        return redirect()->route('client.profile.edit', $user->id)->with('status', 'Cập nhật hồ sơ thành công!');
    }
    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['success' => 'Password updated successfully']);
    }

    public function sendResetPassword(Request $request)
    {
        $request->validate([
            'forgot_email' => 'required|email',
        ]);

        $user = User::where('email', $request->forgot_email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Không có tài khoản nào được đăng kí bởi email đó');
        }

        $newPassword = Str::random(15);
        $user->password = Hash::make($newPassword);
        $user->save();

        event(new PasswordResetRequested($user, $newPassword));

        return redirect()->back()->with('success', 'Mật khẩu mới đã được gửi qua email.');
    }
    public function getDistricts($province_code)
    {
        $districts = District::where('province_code', $province_code)->get();
        return response()->json($districts);
    }

    public function getWards($district_code)
    {
        $wards = Ward::where('district_code', $district_code)->get();
        // dd($wards); // Kiểm tra dữ liệu trả về
        return response()->json($wards);
    }
}
