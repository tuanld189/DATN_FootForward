<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(){
        return view('users.login');
    }




    public function signup(){
        return view('users.signup');
    }
    public function postSignup(Request $request){
        //validate

        $request->merge(['password' => Hash::make($request->password)]);
        try{
            User::create($request->all());
        }catch(\Throwable $throwable){
            dd($throwable);
        }
        return redirect()->route('login');
    }


    public function postLogin(Request $request){
        // dd($request->all());
        if(Auth::attempt(['email' =>$request-> email, 'password' => $request-> password])){
            return redirect()->route('index');
        }else{
            return redirect()->back()->with('error','Login failed');
        }

    }

    public function logout( ){
       Auth::logout();
            return redirect()->back();

    }
}
