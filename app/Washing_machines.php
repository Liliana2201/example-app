<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Washing_machines extends Model
{
    protected $fillable = ['id_dom', 'date_check'];
    public $timestamps = false;
    public function laundries() //возвращает стирки на этой машинке
    {
        return $this->hasMany(Laundries::class, 'id_mash');
    }
    public function dormitory() //возвращает общежитие, в котором находится эта машинка
    {
        return $this->belongsTo(Dormitories::class, 'id_dom');
    }
}
