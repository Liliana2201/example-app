<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition_rooms extends Model
{
    public function rooms() //возвращает комнаты имеющие выбранное состояние
    {
        return $this->hasMany(Rooms::class, 'id_cond');
    }
}
