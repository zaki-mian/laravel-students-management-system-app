<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function view()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);
        $credentials = $request->except('_token', 'submit');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->user_type == 'Admin') {
                return redirect()->route('admin.dashbaord');
            } elseif ($user->user_type == 'Student') {
                return redirect()->route('student.dashbaord');
            } else {
                Auth::logout();
                return back()->with('failed', 'Invalid Login Credentials');
            }
        } else {
            return back()->with('failed', 'Invalid Login Credentials');
        }
    }
}
