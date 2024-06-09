<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Students;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        $students = Students::all();
        return view('admin.user.create', compact('students'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'user' => 'required|integer',
        ]);
        $data = $request->all();
        $student = Students::find($data['user']);
        //dd($student);
        $users = Users::all();
        foreach ($users as $user) {
            if($student->email == $user->email)
            {
                $user->is_smm = 1;
                $user->update();
            }
        }
        return redirect()->route('admin.index')->with('success', 'SMM добавлен!');
    }

}
