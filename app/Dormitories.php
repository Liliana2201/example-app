<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Dormitories extends Model
{
    protected $fillable = ['title', 'address', 'phone', 'photo'];
    public function staff() //возвращает персонал, работающий в указанном общежитии
    {
        return $this->hasMany(Staff::class, 'id_dom');
    }
    public function rooms() //возвращает комнаты указанного общежития
    {
        return $this->hasMany(Rooms::class, 'id_dom');
    }
    public function properties() //возвращает имущество, находящееся в этом общежитии
    {
        return $this->hasMany(Properties::class, 'id_dom');
    }
    public function news() //возвращает новости, касающиеся этого общежития
    {
        return $this->hasMany(News::class, 'id_dom');
    }
    public function washing_machines() //возвращает машинки, находящиеся в этом общежитие
    {
        return $this->hasMany(Washing_machines::class, 'id_dom');
    }
    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile('photo')) {
            if ($request->del_photo){
                return null;
            }
            $folder = date('Y-m-d');
            return $request->file('photo')->store("images/dormitories/{$folder}");
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
