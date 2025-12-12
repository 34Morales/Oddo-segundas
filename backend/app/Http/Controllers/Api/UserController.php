<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Solo admin puede ver todos los usuarios
        if (auth()->user()->role_id !== 1) {
            return response()->json(['error' => 'No autorizado'], 403);
        }
        
        return response()->json(User::with('role')->paginate(15));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role_id !== 1) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id',
            'control_number' => 'nullable|unique:users,control_number',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'control_number' => $request->control_number,
        ]);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::with('role')->findOrFail($id);
        
        // Solo admin o el propio usuario puede ver
        if (auth()->user()->role_id !== 1 && auth()->id() != $id) {
            return response()->json(['error' => 'No autorizado'], 403);
        }
        
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Solo admin puede editar otros usuarios
        if (auth()->user()->role_id !== 1 && auth()->id() != $id) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:100',
            'email' => "sometimes|email|unique:users,email,{$id}",
            'password' => 'sometimes|min:6',
            'role_id' => 'sometimes|exists:roles,id',
            'control_number' => "nullable|unique:users,control_number,{$id}",
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->only(['name', 'email', 'role_id', 'control_number']);
        
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return response()->json($user);
    }

    public function destroy($id)
    {
        if (auth()->user()->role_id !== 1) {
            return response()->json(['error' => 'No autorizado'], 403);
        }
        
        $user = User::findOrFail($id);
        
        // Evitar que el admin se elimine a sí mismo
        if ($user->id === auth()->id()) {
            return response()->json(['error' => 'No puedes eliminar tu propio usuario'], 422);
        }
        
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}