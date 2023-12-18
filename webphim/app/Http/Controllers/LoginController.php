<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        $title = 'Đăng nhập hệ thông';
        return view('users.login',compact('title'));
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'email' =>'required|email',
            'password' => 'required'
        ],[
            'email.required'=>'Email bắt buộc phải nhập',
            'email.email'=>'Email không đúng định dạng',
            'password.required'=>'Mật khẩu bắt buộc phải nhập'
        ]);

        // if(Auth::attempt(['email' => $email, 'password' => $password])([
        //     'email'=> $request->input('email'),
        //     'password'=> $request->input('password'),
        // ], $request->input('remember')))
        // {
        //     return redirect()->route('admin.main');
        // }
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')],$request->input('remember')) && Auth::user()->User_Role->first()->id == 'admin')
        {
            return redirect()->route('admin.main');
        }
        elseif(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')],$request->input('remember')) && Auth::user()->User_Role->first()->id == 'ctvp')
        {
            return redirect()->route('collaborators.main');
        }

        //return dd($request->input('email'), $request->input('password'));

        Session::flash('error','Email hoặc mật khẩu không đúng');

        return redirect()->back();

    }

    public function postlogout(Request $request)
    {
        if(Auth::logout())
        {
            return redirect()->route('users.login');
        }
        return redirect()->route('admin.main');
    }
}
