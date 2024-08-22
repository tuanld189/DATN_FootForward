<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view('client.login');
    }

    public function signup()
    {

        return view('client.signup');
    }
    public function postSignup(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ], [
            'name.required' => 'Vui lòng nhập tên của bạn.',
            'fullname.required' => 'Vui lòng nhập họ và tên đầy đủ của bạn.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        try {
            // Create user
            $user = User::create($validatedData);

            // Gán vai trò 'user' cho tài khoản mới
            $user->assignRole('user'); // Hoặc $user->roles()->attach($roleId);

        } catch (\Throwable $throwable) {
            dd($throwable);
        }

        return redirect()->route('login');
    }


    public function postLogin(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ]);

        // Attempt to log in
        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            return redirect()->route('index');
        } else {
            return redirect()->back()->with('error', 'Đăng nhập thất bại. Vui lòng kiểm tra lại thông tin.');
        }
    }

    public function logout()
    {
        // Cart::where('user_id', Auth::id())->delete();
        Auth::logout();
        return redirect()->route('login');

    }
}
