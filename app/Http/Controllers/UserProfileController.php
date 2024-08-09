<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        $orders = Order::where('user_id', $id)
            ->orderBy('created_at', 'desc') // Sort orders by creation date, newest first
            ->get();

        return view('client.profile.edit', [
            'user' => $user,
            'orders' => $orders
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
}
