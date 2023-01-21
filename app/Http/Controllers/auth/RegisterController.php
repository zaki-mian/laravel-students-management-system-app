<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function view() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:5'],
            'profile_picture' => ['required', 'mimes:png,jpeg,jpg']
        ]);
        $file = $request->file('profile_picture');
        $file_name = "p-" . microtime(true) . "." . $file->extension();
        $is_user_created = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_picture' => $file_name,
            'user_type' => 'Admin'

        ]);
        if($is_user_created) {
            $is_file_uploaded = $file->move(public_path('uploads'), $file_name);
            if($is_file_uploaded) {
                $is_admin_created = Admin::create([
                    'user_id' => $is_user_created->id
                ]);
                if($is_admin_created) {
                    return back()->with('success', 'Magic has been spelled');
                } else {
                    return back()->with('failed', 'Magic has failed to spell');
                }   
            } else {
                return back()->with('failed', 'File has failed to upload');
            }
        } else {
            return back()->with('failed', 'User has failed to add');
        }
    }
}
