<?php

namespace App\Http\Controllers\Admin;

use App\Contracts;
use App\Http\Controllers\Controller;
use App\Properties;
use App\Rooms;
use App\Students;
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
        $students = Students::with('room', 'property')->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $rooms = Rooms::pluck('number', 'id')->all();
        $properties = Properties::pluck('title', 'id')->all();
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
            'id_room' => 'required|integer',
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'nullable|string',
            'group' => 'required',
            'passport' => 'required',
            'issued_pas' => 'required',
            'date_pas' => 'required|date',
            'date_births' => 'required|date',
            'hometown' => 'required',
            'contract' => 'required|file',
            'balance' => 'numeric',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'work_out' => 'required|integer',
            'date_flg' => 'required|date',
            'id_prop' => 'required|integer',
            'photo' => 'required|image',
        ]);
        $data = $request->all();
        $data['photo'] = Students::uploadImage($request);
        //dd($data);
        Students::create($data);
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
        $student = Students::find($id);
        $rooms = Rooms::pluck('title', 'id')->all();
        $properties = Properties::pluck('title', 'id')->all();
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
            'id_room' => 'required|integer',
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'nullable|string',
            'group' => 'required',
            'passport' => 'required',
            'issued_pas' => 'required',
            'date_pas' => 'required',
            'date_births' => 'required',
            'hometown' => 'required',
            'contract' => 'required|file',
            'balance' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'work_out' => 'required',
            'date_flg' => 'required',
            'id_prop' => 'required|integer',
            'photo' => 'required|image',
        ]);
        $student = Students::find($id);
        $data = $request->all();
        //dd($data);
        if ($file = Students::uploadImage($request, $request->photo)){
            $data['photo'] = $file;
        }
        //dd($data);
        $student->update($data);
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
        Storage::delete($student->photo);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Студент удален!');
    }
}
