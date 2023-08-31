<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteCurso extends Model
{
    use HasFactory;
    protected $table = 'estudiante_curso';
    
    protected $fillable = ['estudiante_id', 'curso_id'];

    // Definir la relación muchos a muchos con la tabla de estudiantes
    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'estudiante_curso', 'curso_id', 'estudiante_id');
    }

    // Definir la relación muchos a muchos con la tabla de cursos
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'estudiante_curso', 'estudiante_id', 'curso_id');
    }
}
