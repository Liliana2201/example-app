<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Laundries;
use App\Students;
use App\Washing_machines;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaundryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $laundries = Laundries::with('machine', 'student')->paginate(10);
        $washing_machines = Washing_machines::all();
        $students = Students::all();
        foreach ($laundries as $laundry) {
            $dif = Carbon::now('Asia/Krasnoyarsk')->floatDiffInMonths($laundry->created_at);
            if ($dif >= 3) {
                $laundry->delete();
            }
        }
        return view('admin.laundries.index', compact('laundries', 'washing_machines', 'students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $washing_machines = Washing_machines::all();
        $students = Students::all();
        return view('admin.laundries.create', compact('washing_machines', 'students'));
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
            'id_mash' => 'required|integer',
            'date_wash' => 'required',
            'time_wash' => 'required',
            'id_stud' => 'required|integer',
        ]);
        $data = $request->all();
        Laundries::create($data);
        return redirect()->route('laundries.index')->with('success', 'Стирка добавлена!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $laundry = Laundries::find($id);
        $washing_machines = Washing_machines::all();
        $students = Students::all();
        return view('admin.laundries.edit', compact('laundry','washing_machines', 'students'));
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
            'id_mash' => 'required|integer',
            'date_wash' => 'required',
            'time_wash' => 'required',
            'id_stud' => 'required|integer',
        ]);
        $data = $request->all();
        $laundry = Laundries::find($id);
        $laundry->update($data);
        return redirect()->route('laundries.index', ['laundry' => $laundry->id])->with('success', 'Изменения сохранены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $laundry = Laundries::find($id);
        $laundry->delete();
        return redirect()->route('laundries.index')->with('success', 'Стирка удалена!');
    }
}
