<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Washing_machine extends Model
{
    public function laundry() //возвращает стирки на этой машинке
    {
        return $this->hasMany(Laundry::class, 'id_mash');
    }
    public function dormitorie() //возвращает общежитие, в котором находится эта машинка
    {
        return $this->belongsTo(Dormitories::class, 'id_dom');
    }
}
