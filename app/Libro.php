<?php

namespace App;

use App\Transformers\LibroTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Libro extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'author',
        'pages',
        'libreria_id',
    ];

    public $transformer = LibroTransformer::class;

    public function libreria(){
        return $this->belongsTo(Libreria::class);
    }

    public function setNameAttribute($valor){
        $this->attributes['name'] = strtolower($valor);
    }

    public function getNameAttribute($valor){
        return ucwords($valor);
    }

    public function setAuthorAttribute($valor){
        $this->attributes['author'] = strtolower($valor);
    }

    public function getAuthorAttribute($valor){
        return ucwords($valor);
    }

}
