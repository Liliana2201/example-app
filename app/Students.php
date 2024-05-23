<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Students extends Model
{
    protected $fillable = ['room_id', 'surname', 'name', 'patronymic', 'status', 'form_edu', 'group', 'passport', 'issued_pas', 'date_pas',
        'date_births', 'hometown', 'contract', 'balance', 'phone', 'email', 'work_out', 'date_flg', 'photo', 'family', 'notes', 'live',
        'date_del'];
    public function applications() //возвращаем заявки этого студента
    {
        return $this->belongsToMany(Applications::class, 'id_stud');
    }
    public function room() //возвращает комнату, в которой проживает этот студент
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }
    public function properties() //возвращает имущество этого студента
    {
        return $this->belongsToMany(Properties::class)->withTimestamps();
    }
    public function laundry() //возвращает стирки этого студента
    {
        return $this->belongsToMany(Laundries::class, 'id_stud');
    }
    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile('photo')) {
            if ($image) {
                Storage::delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('photo')->store("images/students/{$folder}");
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
    public static function uploadContract(Request $request, $contract = null)
    {
        if ($request->hasFile('contract')) {
            if ($contract) {
                Storage::delete($contract);
            }
            $folder = date('Y-m-d');
            return $request->file('contract')->store("files/contract/{$folder}");
        }
        return null;
    }

    public function getContract()
    {
        if (!$this->contract) {
            return "no contract";
        }
        return asset("uploads/{$this->contract}");
    }
}
