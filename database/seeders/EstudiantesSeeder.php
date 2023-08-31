<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class EstudiantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i<20; $i++){
            DB::table('estudiantes')->insert([
                'nombre'=>Str::random(15),
                'ci'=>random_int(2000, 10000)
            ]);
        }
    }
}
