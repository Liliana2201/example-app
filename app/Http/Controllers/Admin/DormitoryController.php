<?php

namespace App\Http\Controllers\Admin;

use App\Dormitories;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DormitoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $dormitories = Dormitories::paginate(10);
        return view('admin.dormitories.index', compact('dormitories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.dormitories.create');
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
            'title' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'photo' => 'image',
        ]);
        $data = $request->all();
        $data['photo'] = Dormitories::uploadImage($request);
        //dd($data);
        Dormitories::create($data);
        return redirect()->route('dormitories.index')->with('success', 'Общежитие добавлено!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $dormitory = Dormitories::find($id);
        return view('admin.dormitories.edit', compact('dormitory'));
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
            'title' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'photo' => 'image',
        ]);
        $dormitory = Dormitories::find($id);
        Storage::delete($dormitory->photo);
        $data = $request->all();
        if ($file = Dormitories::uploadImage($request)){
            $data['photo'] = $file;
        }
        $dormitory->update($data);
        return redirect()->route('dormitories.index', ['dormitory' => $dormitory->id])->with('success', 'Изменения сохранены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $dormitory = Dormitories::find($id);
        Storage::delete($dormitory->photo);
        $dormitory->delete();
        return redirect()->route('dormitories.index')->with('success', 'Общежитие удалено');
    }
}
