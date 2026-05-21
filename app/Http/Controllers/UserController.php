<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        if (Gate::denies('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $users = User::all()->makeVisible('role');
        return response()->json($users);
    }

    public function store(Request $request): JsonResponse
    {
        if (Gate::denies('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'in:ADMIN,EDITOR',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return response()->json($user, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        if (Gate::denies('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role' => 'in:ADMIN,EDITOR',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return response()->json($user);
    }

    public function destroy(int $id): JsonResponse
    {
        if (Gate::denies('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        User::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
