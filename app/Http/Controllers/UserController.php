<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'sometimes|string|in:admin,standard',
        ], [
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.string' => 'El nombre debe ser una cadena de texto.',
            'first_name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'last_name.required' => 'El apellido es obligatorio.',
            'last_name.string' => 'El apellido debe ser una cadena de texto.',
            'last_name.max' => 'El apellido no puede tener más de 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'role.sometimes' => 'El rol es opcional.',
            'role.string' => 'El rol debe ser una cadena de texto.',
            'role.in' => 'El rol debe ser admin o standard.',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'standard',
        ]);

        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        if($user->email === 'administrador@tareas.com' && $request->role !== 'admin' ) {
            return response()->json(['message' => 'No puedes actualizar el rol del administrador principal'], 403);
        }

        if($user->email === 'administrador@tareas.com' && $request->email !== 'administrador@tareas.com') {
            return response()->json(['message' => 'No puedes actualizar el email del administrador principal'], 403);
        }

        $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:8',
            'role' => 'sometimes|string|in:admin,standard',
        ], [
            'first_name.sometimes' => 'El nombre es opcional.',
            'first_name.string' => 'El nombre debe ser una cadena de texto.',
            'first_name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'last_name.sometimes' => 'El apellido es opcional.',
            'last_name.string' => 'El apellido debe ser una cadena de texto.',
            'last_name.max' => 'El apellido no puede tener más de 255 caracteres.',
            'email.sometimes' => 'El correo electrónico es opcional.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.sometimes' => 'La contraseña es opcional.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'role.sometimes' => 'El rol es opcional.',
            'role.string' => 'El rol debe ser una cadena de texto.',
            'role.in' => 'El rol debe ser admin o standard.',
        ]);

        $user->update(array_filter([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role' => $request->role ?? $user->role,
        ]));

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        if($user->email === 'administrador@tareas.com') {
            return response()->json(['message' => 'No puedes eliminar al administrador principal'], 403);
        }

        if ($user->id === auth()->id()) {
            return response()->json(['message' => 'No puedes eliminar tu propia cuenta'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}