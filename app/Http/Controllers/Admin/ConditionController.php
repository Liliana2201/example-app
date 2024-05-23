<?php

namespace App\Http\Controllers\Admin;

use App\Condition_rooms;
use App\Http\Controllers\Controller;
use App\Rooms;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $conditions = Condition_rooms::paginate(10);
        return view('admin.condition_rooms.index', compact('conditions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.condition_rooms.create');
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
        ]);
        Condition_rooms::create($request->all());
        return redirect()->route('condition_rooms.index')->with('success', 'Состояние добавлено!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $condition = Condition_rooms::find($id);
        return view('admin.condition_rooms.edit', compact('condition'));
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
        ]);
        $condition = Condition_rooms::find($id);
        $condition->update($request->all());
        return redirect()->route('condition_rooms.index', ['condition_room' => $condition->id])->with('success', 'Изменения сохранены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $condition_room = Condition_rooms::find($id);
        if(count($condition_room->rooms)){
            return redirect()->route('condition_rooms.index')->withErrors(['error' => 'Это состояние уже используется!']);
        }
        else{
            $condition_room->delete();
            return redirect()->route('condition_rooms.index')->with('success', 'Состояние удалено');
        }
    }
}
