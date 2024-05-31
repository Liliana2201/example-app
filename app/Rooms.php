<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $fillable = ['number', 'level', 'num_beds', 'square', 'id_cond'];

    public function condition_room() //возвращает состояние комнаты
    {
        return $this->belongsTo(Condition_rooms::class, 'id_cond');
    }
    public function properties() //возвращает имущество в этой комнате
    {
        return $this->belongsToMany(Properties::class)->withTimestamps();
    }
    public function students() // возвращает студентов из этой комнаты
    {
        return $this->hasMany(Students::class, 'room_id');
    }
}
