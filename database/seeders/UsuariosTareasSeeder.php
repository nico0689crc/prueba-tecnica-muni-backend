<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tarea;
use Carbon\Carbon; 
use Faker\Factory as Faker;

class UsuariosTareasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $tareas = Tarea::all();

        $adminUser = User::where('role', 'admin')->first();
        foreach ($tareas as $tarea) {
            $adminUser->tareas()->attach($tarea->id, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'estado' => 'finalizado',
            ]);
        }
        
        $estandarsUsers = User::where('role', 'standard')->get();
        foreach ($estandarsUsers as $user) {
            $randomTareas = $tareas->random(rand(5, 10));

            foreach ($randomTareas as $tarea) {
                $user->tareas()->attach($tarea->id, [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'estado' => $faker->randomElement(['pendiente', 'en_progreso', 'finalizado']),
                ]);
            }
        }
    }
}
