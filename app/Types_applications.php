<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Types_applications extends Model
{
    protected $fillable = ['name_category', 'id_post'];
    public $timestamps = false;
    public function applications() //возвращаем заявки, принадлежащие этой категории
    {
        return $this->hasMany(Applications::class, 'id_category');
    }
    public function post() //возвращаем должность, которой отправляется заявка этой категории
    {
        return $this->belongsTo(Posts::class, 'id_post');
    }
}
