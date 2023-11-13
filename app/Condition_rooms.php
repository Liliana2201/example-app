<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition_rooms extends Model
{
    protected $fillable = ['title'];
    public function rooms() //возвращает комнаты имеющие выбранное состояние
    {
        return $this->hasMany(Rooms::class, 'id_cond');
    }
}
