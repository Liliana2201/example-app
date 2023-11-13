<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Students extends Model
{
    protected $fillable = ['id_room', 'surname', 'name', 'patronymic', 'group', 'passport', 'issued_pas', 'date_pas',
        'date_births', 'hometown', 'contract', 'balance', 'phone', 'email', 'work_out', 'date_flg', 'id_prop', 'photo'];
    public function applications() //возвращаем заявки этого студента
    {
        return $this->hasMany(Applications::class, 'id_stud');
    }
    public function room() //возвращает комнату, в которой проживает этот студент
    {
        return $this->hasOne(Rooms::class, 'id_room');
    }
    public function property() //возвращает имущество этого студента
    {
        return $this->hasMany(Properties::class, 'id_prop');
    }
    public function laundry() //возвращает стирки этого студента
    {
        return $this->hasMany(Laundries::class, 'id_stud');
    }
    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile('photo')) {
            if ($image) {
                Storage::delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('photo')->store("images/{$folder}");
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
