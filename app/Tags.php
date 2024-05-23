<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $fillable = ['name_tag'];
    public $timestamps = false;
    public function news() //возвращает новости, относяшиеся к этому тэгу
    {
        return $this->belongsToMany(News::class)->withTimestamps();
    }
}
