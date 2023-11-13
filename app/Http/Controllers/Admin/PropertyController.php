<?php

namespace App\Http\Controllers\Admin;

use App\Dormitories;
use App\Http\Controllers\Controller;
use App\Properties;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $properties = Properties::with('dormitory')->paginate(10);
        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $dormitories = Dormitories::pluck('title', 'id')->all();
        return view('admin.properties.create', compact('dormitories'));
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
            'title' => 'required',
            'mark' => 'required',
        ]);
       Properties::create($request->all());
       return redirect()->route('properties.index')->with('success', 'Имущество добавлено!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $property = Properties::find($id);
        $dormitories = Dormitories::pluck('title', 'id')->all();
        return view('admin.properties.edit', compact('dormitories', 'property'));
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
            'title' => 'required',
            'mark' => 'required',
        ]);
        $property = Properties::find($id);
        $property -> update($request->all());
        return redirect()->route('properties.index')->with('success', 'Изменения сохранены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Properties::destroy($id);
        return redirect()->route('properties.index')->with('success', 'Имущество удалено!');
    }
}
