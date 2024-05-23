<?php

namespace App\Http\Controllers\Admin;

use App\Applications;
use App\Http\Controllers\Controller;
use App\Students;
use App\Types_applications;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $applications = Applications::with('category')->paginate(10);
        $students = Students::all();
        foreach ($applications as $application) {
            $dif = Carbon::now('Asia/Krasnoyarsk')->floatDiffInYears($application->created_at);
            //dd($dif);
            if ($application->is_check == 1 and $dif >= 1) {
                $application->delete();
            }
        }
        return view('admin.applications.index', compact('applications', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $types_applications = Types_applications::pluck('name_category', 'id')->all();
        $students = Students::all();
        return view('admin.applications.create', compact('types_applications', 'students'));
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
            'id_category' => 'required|integer',
            'id_stud' => 'required|integer',
            'description' => 'required',
        ]);
        $data = $request->all();
        //dd($data);
        $applications = Applications::create($data);
        return redirect()->route('applications.index')->with('success', 'Заявка добавлен!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $application = Applications::find($id);
        $types_applications = Types_applications::pluck('name_category', 'id')->all();
        $students = Students::all();
        return view('admin.applications.edit', compact('application','types_applications', 'students'));
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
            'id_category' => 'required|integer',
            'id_stud' => 'required|integer',
            'description' => 'required',
        ]);
        $application = Applications::find($id);
        $data = $request->all();
        $application->update($data);
        return redirect()->route('applications.index', ['application' => $application->id])->with('success', 'Изменения сохранены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $application = Applications::find($id);
        $application->delete();
        return redirect()->route('applications.index')->with('success', 'Заявка удалена!');
    }

    public function updateStatus($id)
    {
        $application = Applications::find($id);
        $application->is_check = 1;
        $application->save();
        return redirect()->route('applications.index')->with('success', 'Статус изменен!');
    }
}
