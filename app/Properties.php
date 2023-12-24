<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $fillable = ['id_dom', 'title', 'mark'];
    public function rooms() //возвращает комнату, в которой находится это имущество
    {
        return $this->belongsToMany(Rooms::class);
    }
    public function students() //возвращает студента, у которого находится это имущество
    {
        return $this->belongsToMany(Students::class);
    }
    public function dormitory() //возвращает общежитие, в котором находится это имущество
    {
        return $this->belongsTo(Dormitories::class, 'id_dom');
    }
}
