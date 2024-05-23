<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Washing_machines extends Model
{
    protected $fillable = ['date_check'];
    public $timestamps = false;
    public function laundries() //возвращает стирки на этой машинке
    {
        return $this->hasMany(Laundries::class, 'id_mash');
    }
}
