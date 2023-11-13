<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $fillable = ['id_dom', 'title', 'mark'];
    public function room() //возвращает комнату, в которой находится это имущество
    {
        return $this->belongsTo(Rooms::class, 'id_prop');
    }
    public function student() //возвращает студента, у которого находится это имущество
    {
        return $this->belongsTo(Students::class, 'id_prop');
    }
    public function dormitory() //возвращает общежитие, в котором находится это имущество
    {
        return $this->belongsTo(Dormitories::class, 'id_dom');
    }
}
