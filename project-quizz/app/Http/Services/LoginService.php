<?php


namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginService
{



    function checkLogin($request)
    {
        $email = $request->email;
        $password = $request->password;

        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        return Auth::attempt($credentials);

    }
}
