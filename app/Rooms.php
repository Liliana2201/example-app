<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $fillable = ['id_dom', 'number', 'id_cond'];
    public function dormitory() //возвращает общежитие, в котором числится данная комната
    {
        return $this->belongsTo(Dormitories::class, 'id_dom');
    }
    public function condition_room() //возвращает состояние комнаты
    {
        return $this->belongsTo(Condition_rooms::class, 'id_cond');
    }
    public function properties() //возвращает имущество в этой комнате
    {
        return $this->belongsToMany(Properties::class)->withTimestamps();
    }
}
