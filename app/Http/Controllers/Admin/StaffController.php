<?php

namespace App\Http\Controllers\Admin;

use App\Dormitories;
use App\Http\Controllers\Controller;
use App\Posts;
use App\Staff;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $staff = Staff::with('dormitory', 'post')->paginate(10);
        return view('admin.staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $posts = Posts::pluck('title', 'id')->all();
        $dormitories = Dormitories::pluck('title', 'id')->all();
        return view('admin.staff.create', compact('posts', 'dormitories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'nullable|string',
            'id_post' => 'required|integer',
            'id_dom' => 'required|integer',
            'office' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'photo' => 'required|image',
        ]);
        $data = $request->all();
        $data['photo'] = Staff::uploadImage($request);
        //dd($data);
        $staff = Staff::create($data);

        $users = Users::all();
        $is_valid = True;
        foreach ($users as $user) {
            if($staff->email == $user->email)
            {
                $is_valid = False;
            }
        }
        if ($is_valid)
        {
            $user = Users::create([
                'name' => $staff->name,
                'email' => $staff->email,
                'password' => bcrypt($staff->phone),
            ]);
            if (Posts::find($data['id_post'])->title == "Администратор")
            {
                $user->is_admin = 1;
                $user->update();
            }
        }

        return redirect()->route('staff.index')->with('success', 'Сотрудник добавлен!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $staff = Staff::find($id);
        $posts = Posts::pluck('title', 'id')->all();
        $dormitories = Dormitories::pluck('title', 'id')->all();
        return view('admin.staff.edit', compact('staff', 'posts', 'dormitories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'nullable|string',
            'id_post' => 'required|integer',
            'id_dom' => 'required|integer',
            'office' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'photo' => 'image',
        ]);
        $staff = Staff::find($id);
        $data = $request->all();
        //dd($data);
        if ($file = Staff::uploadImage($request, $request->photo)){
            $data['photo'] = $file;
        }
        //dd($data);
        $staff->update($data);
        return redirect()->route('staff.index', ['staff' => $staff->id])->with('success', 'Изменения сохранены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        Storage::delete($staff->photo);
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Сотрудник удален!');
    }
}
