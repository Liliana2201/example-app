<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    public function student() //возвращает студента этого контракта
    {
        return $this->hasOne(Students::class, 'id_contract');
    }
}
