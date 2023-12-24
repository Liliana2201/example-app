<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Posts;
use App\Types_applications;
use Illuminate\Http\Request;

class TypeApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $types_applications = Types_applications::with('post')->paginate(10);
        return view('admin.types_applications.index', compact('types_applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $posts = Posts::pluck('title', 'id')->all();
        return view('admin.types_applications.create', compact('posts'));
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
            'name_category' => 'required',
            'id_post' => 'required|integer',
        ]);
        Types_applications::create($request->all());
        return redirect()->route('types_applications.index')->with('success', 'Категория добавлена!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $types_application = Types_applications::find($id);
        $posts = Posts::pluck('title', 'id')->all();
        return view('admin.types_applications.edit', compact('types_application', 'posts'));
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
            'name_category' => 'required',
            'id_post' => 'required|integer',
        ]);
        $types_application = Types_applications::find($id);
        $types_application -> update($request->all());
        return redirect()->route('types_applications.index', ['types_application' => $types_application->id])->with('success', 'Изменения сохранены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $types_application = Types_applications::find($id);
        $types_application->delete();
        return redirect()->route('types_applications.index')->with('success', 'Категория удалена!');
    }
}
