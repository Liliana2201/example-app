<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dormitories extends Model
{
    protected $fillable = ['title_dom', 'address', 'phone', 'url_photo'];
    public function staff() //возвращает персонал, работающий в указанном общежитии
    {
        return $this->hasMany(Staff::class, 'id_dom');
    }
    public function rooms() //возвращает комнаты указанного общежития
    {
        return $this->hasMany(Rooms::class, 'id_dom');
    }
    public function property() //возвращает имущество, находящееся в этом общежитии
    {
        return $this->hasMany(Property::class, 'id_dom');
    }
    public function news() //возвращает новости, касающиеся этого общежития
    {
        return $this->hasMany(News::class, 'id_dom');
    }
    public function mashines() //возвращает машинки, находящиеся в этом общежитие
    {
        return $this->hasMany(Washing_machine::class, 'id_dom');
    }
}
