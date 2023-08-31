<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
{
    $estudianteController = new EstudianteController();
    $estudiantesPorGrado = $estudianteController->estudiantesPorGrado();
    $estudiantesOrdenados = $estudianteController->estudiantesOrdenados();
    $estudiantesConCursos = $estudianteController->estudiantesConCursos();

    return view('pages.dashboard', compact('estudiantesOrdenados', 'estudiantesPorGrado','estudiantesConCursos'));
}

public function asociarEstudianteCurso(Request $request)
{
    $estudianteController = new EstudianteController();
    $response = $estudianteController->asociarEstudianteCurso($request);

    return redirect()->route('home')->with('message', $response->getData()->message);
}


}
