<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $fillable = ['title_news', 'content', 'description', 'url_photo'];

    public function tags() //возвращает теги, к которым относится эта новость
    {
        return $this->belongsToMany(Tags::class)->withTimestamps();
    }
    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile('url_photo')) {
            if ($image) {
                Storage::delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('url_photo')->store("images/news/{$folder}");
        }
        return null;
    }

    public function getImage()
    {
        if (!$this->url_photo) {
            return asset("no-image.png");
        }
        return asset("uploads/{$this->url_photo}");
    }
}
