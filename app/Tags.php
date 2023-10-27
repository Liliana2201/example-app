<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    public function news() //возвращает новости, относяшиеся к этому тэгу
    {
        return $this->hasMany(News::class, 'id_tag');
    }
}
