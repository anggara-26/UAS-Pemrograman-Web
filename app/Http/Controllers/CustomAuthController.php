<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;

class CustomAuthController extends Controller
{
    public function login()
    {
        return "Login";
    }
    public function registration() {
        return "Registration";
    }
    public function registerUser(Request $request) {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email_register;
        $user->password = Hash::make($request->password_register);
        $re = $user->save();
        if($re) {
            return back()->with("success", "User has been created successfully");
        } else {
            return back()->with("fail", "Something went wrong");
        }
    }
    public function loginUser(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            } else {
                return back()->with("fail", "Password is incorrect");
            }
        } else {
            return back()->with("fail", "No account found for this email");
        }
    }
    public function dashboard() {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('dashboard', compact('data'));
    }
    public function logout() {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('home');
        }
    }
}
