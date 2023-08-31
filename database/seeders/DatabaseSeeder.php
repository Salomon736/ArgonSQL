<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Sedeers\CursosSeeder;
use Database\Sedeers\EstudiantesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
    //     DB::table('users')->insert([
    //         'username' => 'admin',
    //         'firstname' => 'Admin',
    //         'lastname' => 'Admin',
    //         'email' => 'admin@argon.com',
    //         'password' => bcrypt('secret')
    //     ]);
    // }
    public function run(): void
    {
        $this->call([
            EstudiantesSeeder::class
        ]);
        $this->call([
            CursosSeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
