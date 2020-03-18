<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libreria extends Model
{
    protected $fillable = [
        'name',
        'direction',
        'telephone',
    ];

    public function libros(){
        return $this->hasMany(Libro::class);
    }
}
