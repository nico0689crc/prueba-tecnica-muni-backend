<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
      $users = [
        [
            'first_name' => 'Usuario',
            'last_name' => 'Administrador',
            'email' => 'administrador@tareas.com',
            'role' => 'admin',
            'password' => 'password',
        ],
        [
            'first_name' => 'Usuario',
            'last_name' => 'Estandard 1',
            'email' => 'estandard_1@tareas.com',
            'password' => 'password',
        ],
        [
            'first_name' => 'Usuario',
            'last_name' => 'Estandard 2',
            'email' => 'estandard_2@tareas.com',
            'password' => 'password',
        ],
        [
            'first_name' => 'Usuario',
            'last_name' => 'Estandard 3',
            'email' => 'estandard_3@tareas.com',
            'password' => 'password',
        ],
        [
            'first_name' => 'Usuario',
            'last_name' => 'Estandard 4',
            'email' => 'estandard_4@tareas.com',
            'password' => 'password',
        ],
      ];

      foreach ($users as $user) {
          $user['password'] = Hash::make($user['password']);
          User::create($user);
      }
    }
}