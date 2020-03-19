<?php

namespace App\Http\Controllers\Libreria;

use App\Http\Controllers\ApiController;
//use App\Http\Controllers\Controller;
use App\Libreria;
use App\Libro;
use App\Transformers\LibroTransformer;
use Illuminate\Http\Request;

class LibreriaLibroController extends ApiController
{

    /**
     * LibreriaLibroController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('transform.input:' . LibroTransformer::class)->only(['store', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @param Libreria $libreria
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Libreria $libreria)
    {
        $libros = $libreria->libros;
        return $this->showAll($libros);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Libreria $libreria
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Libreria $libreria)
    {
        $reglas = [
            'name' => 'required|string|max:50',
            'author' => 'required|string|max:100',
            'pages' => 'required|numeric'
        ];
        $this->validate($request, $reglas);

        $data = $request->all();
        $data['libreria_id'] = $libreria->id;

        $libro = Libro::create($data);

        return $this->showOne($libro, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Libreria $libreria
     * @param Libro $libro
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Libreria $libreria, Libro $libro)
    {
        $reglas = [
            'name' => 'required|string|max:50',
            'author' => 'required|string|max:100',
            'pages' => 'required|numeric'
        ];
        $this->validate($request, $reglas);
        if ($request->has('name') && $request->name != $libro->name){
            $libro->name = $request->name;
        }

        if ($request->has('author') && $request->author != $libro->author){
            $libro->author = $request->author;
        }
        if ($request->has('pages') && $request->pages != $libro->pages){
            $libro->pages = $request->pages;
        }

        if (!$libro->isDirty()){
            return $this->errorResponse('Necesita ingresar datos diferentes para actualizar', 422);
        }
        $libro->save();

        return $this->showOne($libro);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Libreria $libreria
     * @param Libro $libro
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Libreria $libreria, Libro $libro)
    {
        $libro->delete();
        return $this->showOne($libro);
    }
}
