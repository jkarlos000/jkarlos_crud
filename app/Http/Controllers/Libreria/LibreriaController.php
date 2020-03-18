<?php

namespace App\Http\Controllers\Libreria;

use App\Http\Controllers\ApiController;
use App\Libreria;
use Illuminate\Http\Request;

class LibreriaController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->showAll(Libreria::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $reglas = [
            'name' => 'required|max:50',
            'direction' => 'required|max:100',
            'telephone' => 'max:10',
        ];

        $this->validate($request, $reglas);

        $campos = $request->all();
        $libreria = Libreria::create($campos);
        return $this->showOne($libreria, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Libreria $libreria)
    {
        return $this->showOne($libreria, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Libreria $libreria)
    {
        $reglas = [
            'name' => 'max:50',
            'direction' => 'max:100',
            'telephone' => 'max:10',
        ];

        $this->validate($request, $reglas);
        if ($request->has('name') && $request->name != $libreria->name){
            $libreria->name = $request->name;
        }

        if ($request->has('direction') && $request->direction != $libreria->direction){
            $libreria->direction = $request->direction;
        }
        if ($request->has('telephone') && $request->telephone != $libreria->telephone){
            $libreria->telephone = $request->telephone;
        }

        if (!$libreria->isDirty()){
            return $this->errorResponse('Necesita ingresar datos diferentes para actualizar', 422);
        }
        $libreria->save();

        return $this->showOne($libreria);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
