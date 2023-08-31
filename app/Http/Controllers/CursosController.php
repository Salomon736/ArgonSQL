<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cursos;

class CursosController extends Controller
{
    public function create(Request $request)
    {
        $datos = $request -> all();

        $curso = new Cursos();
        $curso->descripcion = $datos['descripcion'];
        $curso->grado = $datos['grado'];
        $curso->save();

        return response()->json(['message' => 'El curso se ha creado']);
    }
}
