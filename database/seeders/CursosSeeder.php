<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i<20; $i++){
            DB::table('cursos')->insert([
                'descripcion'=>Str::random(15),
                'grado'=>random_int(1,15)
            ]);
        }
    }
}
