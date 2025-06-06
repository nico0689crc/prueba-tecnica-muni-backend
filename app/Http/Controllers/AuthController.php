<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El campo correo electrónico debe ser una dirección válida.',
            'password.required' => 'El campo contraseña es obligatorio.',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $token = $user->createToken('MunicipalidadAdminTareas')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
                'message' => 'Inicio de sesión exitoso. ¡Bienvenido de nuevo!'
            ], 200);
        }

        return response()->json(['message' => 'Credenciales incorrectas. Por favor, verifica tu correo electrónico y contraseña.'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Has cerrado sesión exitosamente. ¡Te esperamos pronto!'
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('MunicipalidadAdminTareas')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => 'Usuario creado correctamente'
        ], 201);
    }

    public function me(Request $request)
    {
        return $request->user();
    }
}
