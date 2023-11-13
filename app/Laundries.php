<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laundries extends Model
{
    public function machine() //возвращает машинку для этой стирки
    {
        return $this->belongsTo(Washing_machines::class, 'id_mach');
    }
    public function student() //возвращает студента, записанного на эту стирку
    {
        return $this->belongsTo(Students::class, 'id_stud');
    }
}
