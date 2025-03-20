<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $pageSize = $request->query('pagesize', 10);
        $pageSize = is_numeric($pageSize) && $pageSize > 0 ? (int)$pageSize : 10;

        $currentPage = $request->query('page', 1);
        $currentPage = is_numeric($currentPage) && $currentPage > 0 ? (int)$currentPage : 1;

        $users = User::paginate($pageSize, ['*'], 'page', $currentPage);

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function edit(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['message' => 'Display form for editing user', 'user' => $user]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8',
        ]);

        $user->update(array_filter([
            'name' => $validatedData['name'] ?? null,
            'email' => $validatedData['email'] ?? null,
            'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : null,
        ]));

        return response()->json($user);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}