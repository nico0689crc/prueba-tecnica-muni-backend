<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tarea;
use Carbon\Carbon; 
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UsuariosTareasSeeder extends Seeder
{
    public function run(): void
    {
        if(DB::table('usuarios_tareas')->count() > 0) {
            return;
        }

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
