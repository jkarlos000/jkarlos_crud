<?php

namespace App\Transformers;

use App\Libro;
use League\Fractal\TransformerAbstract;

class LibroTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @param Libro $libro
     * @return array
     */
    public function transform(Libro $libro)
    {
        return [
            'identificador' => (int) $libro->id,
            'nombre' => (string) $libro->name,
            'autor' => (string) $libro->author,
            'paginas' => (int) $libro->pages,
            'libreria' => (int) $libro->libreria_id,
            'fechaCreacion' => (string) $libro->created_at,
            'fechaActualizacion' => (string) $libro->updated_at,
            'fechaEliminacion' => isset($libro->deleted_at) ? (string) $libro->deleted_at : null,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'identificador' => 'id',
            'nombre' => 'name',
            'autor' => 'author',
            'paginas' => 'pages',
            'libreria' => 'libreria_id',
            'fechaCreacion' => 'created_at',
            'fechaActualizacion' => 'updated_at',
            'fechaEliminacion' => 'deleted_ad',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
