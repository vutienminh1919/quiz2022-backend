<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|max:8',
        ]);
        $data = $request->only('name', 'email', 'password');
        $request['password'] = Hash::make($request->password);
        $user = User::query()->create($data);
        $user->save();
        return response()->json(['code' => 200, 'message' => 'Tạo tài khoản thành công ', 'data' => $data]);
    }
}
