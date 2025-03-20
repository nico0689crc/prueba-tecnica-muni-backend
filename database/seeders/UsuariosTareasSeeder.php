<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tarea;
use Carbon\Carbon; 

class UsuariosTareasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tareas = Tarea::all();

        // Attach all tasks to the admin user
        $adminUser = User::where('role', 'admin')->first();
        foreach ($tareas as $tarea) {
            $adminUser->tareas()->attach($tarea->id, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        
        // Attach random tasks to standard users
        $estandarsUsers = User::where('role', 'standard')->get();
        foreach ($estandarsUsers as $user) {
            $randomTareas = $tareas->random(rand(1, 5));

            foreach ($randomTareas as $tarea) {
                $user->tareas()->attach($tarea->id, [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
