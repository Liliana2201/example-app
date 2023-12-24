<?php

namespace App\Http\Controllers\Admin;

use App\Dormitories;
use App\Http\Controllers\Controller;
use App\Washing_machines;
use Illuminate\Http\Request;

class WashingMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $washing_machines = Washing_machines::with('dormitory')->paginate(10);
        return view('admin.washing_machines.index', compact('washing_machines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $dormitories = Dormitories::pluck('title', 'id')->all();
        return view('admin.washing_machines.create', compact('dormitories'));
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
            'id_dom' => 'required|integer',
            'date_check' => 'required',
        ]);
        //dd($request->all());
        Washing_machines::create($request->all());
        return redirect()->route('washing_machines.index')->with('success', 'Машинка добавлена!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $washing_machine = Washing_machines::find($id);
        $dormitories = Dormitories::pluck('title', 'id')->all();
        return view('admin.washing_machines.edit', compact('washing_machine', 'dormitories'));
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
            'id_dom' => 'required|integer',
            'date_check' => 'required',
        ]);
        $washing_machine = Washing_machines::find($id);
        $washing_machine->update($request->all());
        return redirect()->route('washing_machines.index', ['washing_machine' => $washing_machine->id])->with('success', 'Изменения сохранены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $washing_machines = Washing_machines::find($id);
        $washing_machines->delete();
        return redirect()->route('washing_machines.index')->with('success', 'Машинка удалена!');
    }
}
