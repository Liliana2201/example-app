<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\News;
use App\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $news = News::with( 'tags')->paginate(10);
        $tags = Tags::all();
        return view('admin.news.index', compact('news', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $tags = Tags::pluck('name_tag', 'id')->all();
        return view('admin.news.create', compact('tags'));
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
            'title_news' => 'required',
            'content' => 'required',
            'description' => 'nullable|string',
            'url_photo' => 'nullable|image',
        ]);
        $data = $request->all();
        $data['url_photo'] = News::uploadImage($request);
        //dd($data);
        $news = News::create($data);
        $news->tags()->sync($request->tags);
        return redirect()->route('news.index')->with('success', 'Новость добавлена!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $new = News::with('tags')->find($id);
        $tags = Tags::pluck('name_tag', 'id')->all();
        return view('admin.news.edit', compact('new', 'tags'));
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
            'title_news' => 'required',
            'content' => 'required',
            'description' => 'nullable|string',
            'url_photo' => 'nullable|image',
        ]);
        $data = $request->all();
        $new = News::find($id);
        if ($file = News::uploadImage($request, $request->url_photo)){
            $data['url_photo'] = $file;
        }
        $new->update($data);
        $new->tags()->sync($request->tags);
        return redirect()->route('news.index', ['new' => $new->id])->with('success', 'Изменения сохранены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $new = News::find($id);
        Storage::delete($new->url_photo);
        $new->tags()->sync([]);
        $new->delete();
        return redirect()->route('news.index')->with('success', 'Новость удалена!');
    }
}
