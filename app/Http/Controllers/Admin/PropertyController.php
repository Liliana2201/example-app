<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Properties;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function search($value)
    {
        $properties = Properties::where('title', 'LIKE', '%' . $value . '%')->orWhere('mark', 'LIKE', '%' . $value . '%')->orWhere('year', 'LIKE', '%' . $value . '%')->get();
        return view('admin.properties.index', compact('properties'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $properties = Properties::all();
        foreach ($properties as $property) {
            $dif = Carbon::now('Asia/Krasnoyarsk')->floatDiffInYears($property->date_del);
            //dd($dif);
            if ($property->status == 2 and $dif >= 1) {
                $property->delete();
            }
        }
        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.properties.create');
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
            'category' => 'required',
            'title' => 'required',
            'mark' => 'required',
            'year' => 'required'
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
        return view('admin.properties.edit', compact('property'));
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
            'category' => 'required',
            'title' => 'required',
            'mark' => 'required',
            'year' => 'required'
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
        $property = Properties::find($id);
        if($property->status == 0){
            $property->status = 2;
            $property->date_del = Carbon::now('Asia/Krasnoyarsk');
            $property->update();
            return redirect()->route('properties.index')->with('success', 'Имущество удалено!');
        }
        else{
            return redirect()->route('properties.index')->withErrors(['error' => 'Это имущество уже используется!']);
        }
    }
}
