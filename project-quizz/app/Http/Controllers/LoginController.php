<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\LoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    function showFormLogin()
    {
        return view('auth.login');
    }

    function login(Request $request)
    {
        $validateData = $request->validate( [
            'email' => 'required|email:filter',
            'password' => 'required'

        ]);
        
        

        if ($this->loginService->checkLogin($request)) {
            return redirect()->route('home');
        }
        

        Session::flash('error', 'Tài khoản mật khẩu không chính xác!');
        

        return back();
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

}
