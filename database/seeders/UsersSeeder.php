<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        if(User::count() > 0){
            return;
        }

        $users = [
        [
            'first_name' => 'Jose Admin',
            'last_name' => 'Gonzalez',
            'email' => 'administrador@tareas.com',
            'role' => 'admin',
            'password' => 'password',
        ],
        [
            'first_name' => 'Juan',
            'last_name' => 'Perez',
            'email' => 'estandard_1@tareas.com',
            'password' => 'password',
        ],
        [
            'first_name' => 'Esteban',
            'last_name' => 'Gonzalez',
            'email' => 'estandard_2@tareas.com',
            'password' => 'password',
        ],
        [
            'first_name' => 'Marcela',
            'last_name' => 'Gomez',
            'email' => 'estandard_3@tareas.com',
            'password' => 'password',
        ],
        [
            'first_name' => 'Laura',
            'last_name' => 'Garcia',
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