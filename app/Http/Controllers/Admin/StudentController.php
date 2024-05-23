<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Properties;
use App\Rooms;
use App\Students;
use App\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $students = Students::with('room', 'properties')->paginate(10);
        $properties = Properties::all();
        foreach ($students as $student) {
            $dif = Carbon::now('Asia/Krasnoyarsk')->floatDiffInYears($student->date_del);
            //dd($dif);
            if ($student->live == 1 and $dif >= 5) {
                Storage::delete($student->photo);
                Storage::delete($student->contract);
                $student->delete();
            }
        }

        return view('admin.students.index', compact('students', 'properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $rooms = Rooms::pluck('number', 'id')->all();
        $properties = Properties::all();
        return view('admin.students.create', compact('rooms', 'properties'));
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
            'room_id' => 'required|integer',
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'nullable|string',
            'group' => 'required',
            'status' => 'required',
            'form_edu' => 'required',
            'passport' => 'required',
            'issued_pas' => 'required',
            'date_pas' => 'required|date',
            'date_births' => 'required|date',
            'hometown' => 'required',
            'contract' => 'required|file',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'date_flg' => 'required|date',
            'photo' => 'required|image',
            'family' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        $data = $request->all();
        $data['photo'] = Students::uploadImage($request);
        $data['contract'] = Students::uploadContract($request);
        //dd($data);
        $student = Students::create($data);

        $users = Users::all();
        $is_valid = True;
        foreach ($users as $user) {
            if($student->email == $user->email)
            {
                $is_valid = False;
            }
        }
        if ($is_valid)
        {
            Users::create([
                'name' => $student->name,
                'email' => $student->email,
                'password' => bcrypt($student->passport),
            ]);
        }
        $student->properties()->sync($request->properties);
        return redirect()->route('students.index')->with('success', 'Студент добавлен!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $student = Students::with('properties')->find($id);
        $rooms = Rooms::pluck('number', 'id')->all();
        $properties = Properties::all();
        return view('admin.students.edit', compact('student', 'rooms', 'properties'));
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
            'room_id' => 'required|integer',
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'nullable|string',
            'group' => 'required',
            'passport' => 'required',
            'issued_pas' => 'required',
            'date_pas' => 'required',
            'date_births' => 'required',
            'hometown' => 'required',
            'contract' => 'file',
            'phone' => 'required',
            'email' => 'required',
            'date_flg' => 'required',
            'photo' => 'image',
        ]);
        $student = Students::find($id);
        $data = $request->all();
        //dd($data);
        if ($file = Students::uploadImage($request, $request->photo)){
            $data['photo'] = $file;
        }
        if ($file = Students::uploadContract($request, $request->contract)){
            $data['contract'] = $file;
        }
        //dd($data);
        $student->update($data);

        /*придумать как быть с изменением имени, почты и/или данных паспорта
         * if ($is_valid)
        {
            Users::create([
                'name' => $student->name,
                'email' => $student->email,
                'password' => bcrypt($student->passport),
            ]);
        }*/

        $student->properties()->sync($request->properties);
        return redirect()->route('students.index', ['student' => $student->id])->with('success', 'Изменения сохранены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $student = Students::find($id);
        $student->live = 1;
        $student->date_del = Carbon::now('Asia/Krasnoyarsk');
        $student->update();
        return redirect()->route('students.index')->with('success', 'Студент удалено!');
    }
}
