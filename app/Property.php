<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function room() //возвращает комнату, в которой находится это имущество
    {
        return $this->belongsTo(Rooms::class, 'id_prop');
    }
    public function student() //возвращает студента, у которого находится это имущество
    {
        return $this->belongsTo(Students::class, 'id_prop');
    }
}
