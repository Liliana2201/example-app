<?php

namespace App\Http\Controllers\Admin;

use App\Condition_rooms;
use App\Http\Controllers\Controller;
use App\Properties;
use App\Rooms;
use App\Students;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $rooms = Rooms::with('condition_room', 'properties')->paginate(10);
        $properties = Properties::all();
        $condition_rooms = Condition_rooms::all();
        return view('admin.rooms.index', compact('rooms', 'properties', 'condition_rooms'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $condition_rooms = Condition_rooms::pluck('title', 'id')->all();
        $properties = Properties::where('category', 'Комнаты')->where('status', 0)->get();
        return view('admin.rooms.create', compact('condition_rooms', 'properties'));
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
            'level' => 'required',
            'number' => 'required',
            'num_beds' => 'required',
            'square'=> 'required',
            'id_cond' => 'required|integer',
        ]);
        $rooms = Rooms::create($request->all());
        $rooms->properties()->sync($request->properties);
        foreach ($rooms->properties as $property){
            //dd($property);
            $property->status = 1;
            $property->update();
        }
        return redirect()->route('rooms.index')->with('success', 'Комната добавлена!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $room = Rooms::with('properties')->find($id);
        $condition_rooms = Condition_rooms::pluck('title', 'id')->all();
        $properties = Properties::where('category', 'Комнаты')->where('status', 0)->get();
        return view('admin.rooms.edit', compact('room', 'condition_rooms', 'properties'));
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
            'level' => 'required',
            'number' => 'required',
            'num_beds' => 'required',
            'square'=> 'required',
            'id_cond' => 'required|integer',
        ]);
        $room = Rooms::find($id);
        $room -> update($request->all());
        $room->properties()->sync($request->properties);
        foreach ($room->properties as $property){
            $property->status = 1;
            $property->update();
        }
        return redirect()->route('rooms.index')->with('success', 'Изменения сохранены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $room = Rooms::find($id);
        if(count($room->students)){
            return redirect()->route('rooms.index')->withErrors(['error' => 'Это комната уже используется!']);
        }
        else{
            foreach ($room->properties as $property) {
                $property->status = 0;
                $property->update();
            }
            $room->properties()->sync([]);
            $room->delete();
            return redirect()->route('rooms.index')->with('success', 'Комната удалена!');
        }
    }
}
