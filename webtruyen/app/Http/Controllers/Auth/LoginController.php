<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //Gọi view đăng nhập
    public function login()
    {
        return view('admin.users.login');
    }
    public function login_xuly(Request $request)
    {
        $request->validate([
            'email' =>'required|string',
            'password' =>'required|string|min:8',
        ]);

        $email=$request->email;
        $password=$request->password;

        //tài khoản đang hoạt động
        if(Auth::attempt(['email' => $email, 'password' => $password, 'status'=>'active'])){

            //đăng nhập với quyền admin
            if(Auth::user()->Check_Admin())
            {
                return redirect()->route('admin.home');
            }
            //đăng nhập với quyền cộng tác viên truyện
            else if(Auth::user()->Check_Congtacvientruyen())
            {
                return redirect()->route('ctvt.home');
            }
            //đăng nhập vớí quyền người dùng
            else if(Auth::user()->Check_Nguoidung()){
                return redirect()->route('nguoidung.home');
            }

        }
        //tài khoản không hoạt động
        else if(Auth::attempt(['email' => $email, 'password' => $password, 'status'=>'inactive'])){
            return redirect()->route('taikhoanbikhoa');
        }
        //đăng nhập không thành công - trở lại trang login
        else{
            return redirect('login');
        }
    }
    public function logout()
    {
        //Hủy bỏ Auth
        Auth::logout();
        return redirect('login');
    }
}
