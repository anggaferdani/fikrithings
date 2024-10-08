<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login() {
        return view('backend.pages.authentication.login');
    }

    public function postLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        $credentials = array(
            'email' => $request['email'],
            'password' => $request['password'],
        );

        if (Auth::guard('web')->attempt($credentials)) {
            if (auth()->user()->status == 1) {
                if (auth()->user()->role == 1) {
                    return redirect()->route('admin.company-profile.index');
                } else {
                    return redirect()->route('admin.login')->with('error', 'The account level you entered does not match');
                }
            } else {
                Auth::guard('web')->logout();
                return redirect()->route('admin.login')->with('error', 'Your account has been disabled');
            }
        } else {
            return redirect()->route('admin.login')->with('error', 'The email or password you entered is incorrect. Please try again');
        }
    }

    public function logout() {
        Auth::guard('web')->logout();
        return redirect()->route('admin.login');
    }
}
