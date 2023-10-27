<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    public function post() //возвращает должность выбранного работника
    {
        return $this->belongsTo(Post::class, 'id_post');
    }
    public function dormitorie() //возвращает общежитие, в котором числится выбраный работник
    {
        return $this->belongsTo(Dormitories::class, 'id_dom');
    }
}
