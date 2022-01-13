<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('email','!=','admin@gmail.com')->get();
        return response()->json($users);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message'=>'Xoa thanh cong']);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }
}
