<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $fillable = ['title', 'category', 'mark', 'year', 'status', 'date_del'];
    public function rooms() //возвращает комнату, в которой находится это имущество
    {
        return $this->belongsToMany(Rooms::class);
    }
    public function students() //возвращает студента, у которого находится это имущество
    {
        return $this->belongsToMany(Students::class);
    }

}
