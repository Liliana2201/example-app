<?php

namespace App\Http\Controllers;

use App\Dormitories;
use App\Students;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        $dormitories = Dormitories::pluck('title', 'id')->all();
        $students = Students::all();
        return view('admin.user.create', compact('dormitories', 'students'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'id_dom' => 'required|integer',
            'user' => 'required|integer',
        ]);
        $data = $request->all();
        $student = Students::find($data['user']);
        //dd($student);
        Users::create([
            'name' => $student->name,
            'email' => $student->email,
            'password' => bcrypt($student->passport),
            'is_smm' => 1,
        ]);
        return redirect()->route('admin.index')->with('success', 'SMM добавлен!');
    }

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
            if (Auth::user()->is_admin)
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
