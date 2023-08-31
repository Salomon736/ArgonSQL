<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
class EstudianteController extends Controller
{
    public function create(Request $request)
    {
        $datos = $request -> all();

        $estudiante = new Estudiante();
        $estudiante->nombre = $datos['nombre'];
        $estudiante->ci = $datos['ci'];
        $estudiante->save();

        return response()->json(['message' => 'Estudiante creado con éxito']);
    }
    public function estudiantesEn3ro()
    {
        $estudiantes = Estudiante::select('estudiantes.nombre', 'cursos.grado')
            ->join('estudiante_curso', 'estudiantes.id', '=', 'estudiante_curso.estudiante_id')
            ->join('cursos', 'estudiante_curso.curso_id', '=', 'cursos.id')
            ->where('cursos.grado', 3)
            ->get();

        return ['estudiantes' => $estudiantes];
    }
    public function EstudiantesCursos()
    {
        $estudiantes = Estudiante::select('estudiantes.nombre', 'cursos.grado','cursos.descripcion')
            ->join('estudiante_curso', 'estudiantes.id', '=', 'estudiante_curso.estudiante_id')
            ->join('cursos', 'estudiante_curso.curso_id', '=', 'cursos.id')
            ->get();

        return ['estudiantes' => $estudiantes];
    }
}
