<?php

namespace App\Http\Controllers\Libro;

use App\Http\Controllers\ApiController;
//use App\Http\Controllers\Controller;
use App\Libro;
use Illuminate\Http\Request;

class LibroLibreriaController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Libro $libro
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Libro $libro) //Totalmente redundante, remover
    {
        $libreria = $libro->libreria;
        return $this->showOne($libreria);
    }
}
