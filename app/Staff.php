<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Staff extends Model
{
    protected $fillable = ['surname', 'name', 'patronymic', 'id_post', 'id_dom', 'office', 'phone', 'email', 'photo'];
    public function post() //возвращает должность выбранного работника
    {
        return $this->belongsTo(Posts::class, 'id_post');
    }
    public function dormitory() //возвращает общежитие, в котором числится выбраный работник
    {
        return $this->belongsTo(Dormitories::class, 'id_dom');
    }
    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile('photo')) {
            if ($image) {
                Storage::delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('photo')->store("images/staff/{$folder}");
        }
        return null;
    }

    public function getImage()
    {
        if (!$this->photo) {
            return asset("no-image.png");
        }
        return asset("uploads/{$this->photo}");
    }
}
