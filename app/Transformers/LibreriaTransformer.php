<?php

namespace App\Transformers;

use App\Libreria;
use League\Fractal\TransformerAbstract;

class LibreriaTransformer extends TransformerAbstract
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
     * @param Libreria $libreria
     * @return array
     */
    public function transform(Libreria $libreria)
    {
        return [
            'identificador' => (int) $libreria->id,
            'nombre' => (string) $libreria->name,
            'direccion' => (string) $libreria->direction,
            'telefono' => (int) $libreria->telephone,
            'fechaCreacion' => (string) $libreria->created_at,
            'fechaActualizacion' => (string) $libreria->updated_at,
            'fechaEliminacion' => isset($libreria->deleted_at) ? (string) $libreria->deleted_at : null,
        ];
    }

    public static function originalAttribute($index){
        $attributes = [
            'identificador' => 'id',
            'nombre' => 'name',
            'direccion' => 'direction',
            'telefono' => 'telephone',
            'fechaCreacion' => 'created_at',
            'fechaActualizacion' => 'updated_at',
            'fechaEliminacion' => 'deleted_ad',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index){
        $attributes = [
            'id' => 'identificador',
            'name' => 'nombre',
            'direction' => 'direccion',
            'telephone' => 'telefono',
            'created_at' => 'fechaCreacion',
            'updated_at' => 'fechaActualizacion',
            'deleted_ad' => 'fechaEliminacion',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
