<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = ['title'];
    public function types_application() //возвращает категорию заявок, которая относится к этой должности
    {
        return $this->hasOne($this->types_applications(), 'id_post');
    }
    public function staff() //возвращает персонал, работающей на указанной должности
    {
        return $this->hasMany(Staff::class, 'id_post');
    }
}
