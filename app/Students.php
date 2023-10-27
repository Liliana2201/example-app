<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
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
        return $this->hasMany(Property::class, 'id_prop');
    }
    public function laundry() //возвращает стирки этого студента
    {
        return $this->hasMany(Laundry::class, 'id_wash');
    }
    public function contract() //возвращает контракт этого студента
    {
        return $this->hasOne(Contracts::class, 'id_contract');
    }
}
