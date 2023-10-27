<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    public function machine() //возвращает машинку для этой стирки
    {
        return $this->belongsTo(Washing_machine::class, 'id_mach');
    }
    public function student() //возвращает студента, записанного на эту стирку
    {
        return $this->belongsTo(Students::class, 'id_stud');
    }
}
