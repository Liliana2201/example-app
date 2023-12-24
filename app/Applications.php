<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    protected $fillable = ['id_category', 'id_stud', 'description'];
    public function category() //возвращаем категорию, к которой принадлежит заявка
    {
        return $this->belongsTo(Types_applications::class, 'id_category');
    }
    public function student() // возвращаем студента, которому принадлежит заявка
    {
        return $this->belongsTo(Students::class, 'id_stud');
    }
}
