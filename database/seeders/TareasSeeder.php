<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tarea;
use Faker\Factory as Faker;

class TareasSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$faker = Faker::create();

		foreach (range(1, 20) as $index) {
			Tarea::create([
					'titulo' => $faker->sentence(3),
					'detalles' => $faker->paragraph(3),
					'estado' => $faker->randomElement(['pendiente', 'en_progreso', 'completado']),
					'prioridad' => $faker->randomElement(['baja', 'media', 'alta']),
			]);
		}
	}
}
