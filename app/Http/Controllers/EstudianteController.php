<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\EstudianteCurso;
use App\Models\Cursos;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    public function index(){
        $estudiante = new Estudiante();
        return response()->json(['estudiantes'=>$estudiante]);
    }
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
    public function estudiantesPorGrado()
    {
        $estudiantes = Estudiante::select('estudiantes.id', 'estudiantes.nombre', 'cursos.grado')
            ->join('estudiante_curso as ec', 'estudiantes.id', '=', 'ec.estudiante_id')
            ->join('cursos', 'ec.curso_id', '=', 'cursos.id')
            ->where('cursos.grado', 7)
            ->orderBy('estudiantes.id')
            ->limit(5)
            ->get();

        return ['estudiantes' => $estudiantes];
    }
    public function estudiantesOrdenados()
    {
        $estudiantes = Estudiante::select('id', 'nombre', 'ci')
            ->orderBy('ci', 'desc')
            ->get();

        return ['estudiantes' => $estudiantes];
    }
    public function asociarEstudianteCurso(Request $request)
    {
        // Validar los datos enviados desde Postman
        $request->validate([
            'nombre_estudiante' => 'required|string',
            'ci_estudiante' => 'required|numeric',
            'descripcion_curso' => 'required|string',
            'grado_curso' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            // Insertar un nuevo curso y obtener su ID
            $curso_id = DB::table('cursos')->insertGetId([
                'descripcion' => $request->descripcion_curso,
                'grado' => $request->grado_curso,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insertar un nuevo estudiante y obtener su ID
            $estudiante_id = DB::table('estudiantes')->insertGetId([
                'nombre' => $request->nombre_estudiante,
                'ci' => $request->ci_estudiante,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Asociar el estudiante al curso mediante la tabla intermedia
            DB::table('estudiante_curso')->insert([
                'estudiante_id' => $estudiante_id,
                'curso_id' => $curso_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return response()->json(['message' => 'Estudiante y curso asociados correctamente']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => 'Error en la transacción'], 500);
        }
    }
    public function estudiantesConCursos()
{
    $estudiantesConCursos = Estudiante::select('estudiantes.id', 'estudiantes.nombre', 'cursos.grado')
        ->join('estudiante_curso as ec', 'estudiantes.id', '=', 'ec.estudiante_id')
        ->join('cursos', 'ec.curso_id', '=', 'cursos.id')
        ->get();

    return ['estudiantes' => $estudiantesConCursos];
}
}
