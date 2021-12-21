<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function loginAdmin()
    {
        if(auth()->check())
        {
            return redirect()->to('home');
        }
        return view('login');
    }

    public function postLoginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:32'

        ],[
            'email.required'=>'Bạn chưa nhập Email',
            'email.email'=> 'Email chưa đúng định dạng',
            'password.required'=>'Bạn chưa nhập Password',
            'password.min'=>'Password phải có ít nhất 6 ký tự',
            'password.max'=>'Password không quá 32 ký tự'
        ]);
        $remember = $request->has('remember_me') ? true : false;

        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember)){
            return redirect()->to('home');
        }else{
            return redirect()->back()->with('thongbao','Đăng nhập thất bại! Hãy kiểm tra lại thông tin đăng nhập');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

}
