<?php

namespace App;

use App\Transformers\LibreriaTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Libreria extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'direction',
        'telephone',
    ];

    public $transformer = LibreriaTransformer::class;

    public function libros(){
        return $this->hasMany(Libro::class);
    }
}
