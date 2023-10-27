<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function dormitorie() //возвращает общежитие, к которому относится новость
    {
        return $this->belongsTo(Dormitories::class, 'id_dom');
    }
    public function tags() //возвращает теги, к которым относится эта новость
    {
        return $this->hasMany(Tags::class, 'id_tag');
    }
}
