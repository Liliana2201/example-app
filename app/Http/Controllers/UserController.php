<?php

namespace App\Http\Controllers;

use App\Students;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            session()->flash('success', 'Вы авторизовались!');
            //return redirect()->route('admin.index');
            if (Auth::user()->is_admin || Auth::user()->is_smm || Auth::user()->is_head || Auth::user()->is_house || Auth::user()->is_mentor || Auth::user()->is_fitter)
            {
                return redirect()->route('admin.index');
            }
            else
            {
                return redirect()->home();
            }
        }

        return redirect()->back()->with('error', 'Неверный логин или пароль!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->home();
    }
}
