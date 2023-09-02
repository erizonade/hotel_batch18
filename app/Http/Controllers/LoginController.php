<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function prosesLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        //Login Proses
        $user = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if ($user) {
            switch (auth()->user()->role_name) {
                case 'Admin':
                      $request->session()->regenerate();
                      return redirect('dashboard');
                    break;
                case 'Member':
                      $request->session()->regenerate();
                      return redirect('member');
                    break;
            }

        }

        return back()->with('status', 'email atau password salah');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
