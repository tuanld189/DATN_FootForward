<?php




namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $request->merge(['password' => Hash::make($request->password)]);

        try {
            // Create the user
            $user = User::create($request->all());

            // Assign the 'user' role
            $user->assignRole('user');

            session()->flash('success', 'Đăng ký thành công. Vui lòng đăng nhập.');
        } catch (\Throwable $throwable) {
            session()->flash('error', 'Đăng ký không thành công. Vui lòng thử lại.');
            return redirect()->back();
        }

        return redirect()->route('login');
    }
    public function postLogin(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Thông báo đăng nhập thành công
            session()->flash('success', 'Đăng nhập thành công.');
            return redirect()->route('index');
        } else {
            // Thông báo đăng nhập thất bại
            return redirect()->back()->with('error', 'Đăng nhập không thành công');
        }
    }

    public function logout()
    {
        Auth::logout();
        // Thông báo đăng xuất thành công
        // session()->flash('success', 'Bạn đã đăng xuất thành công.');
        return redirect()->route('login');
    }
}
