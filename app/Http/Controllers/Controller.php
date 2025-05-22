<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Controller extends Controller
{
    // GET /users
    public function index()
    {
        return response()->json(User::with(['role', 'userStatus'])->get());
    }

    // POST /users
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'      => 'required|string|max:255',
            'middle_name'     => 'nullable|string|max:255',
            'last_name'       => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|string|min:6|confirmed',
            'role_id'         => 'required|exists:roles,id',
            'user_status_id'  => 'nullable|exists:user_statuses,id',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return response()->json($user->load(['role', 'userStatus']), 201);
    }

    // GET /users/{user}
    public function show(User $user)
    {
        return response()->json($user->load(['role', 'userStatus']));
    }

    // PUT /users/{user}
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'first_name'      => 'required|string|max:255',
            'middle_name'     => 'nullable|string|max:255',
            'last_name'       => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'password'        => 'nullable|string|min:6|confirmed',
            'role_id'         => 'required|exists:roles,id',
            'user_status_id'  => 'nullable|exists:user_statuses,id',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json($user->load(['role', 'userStatus']));
    }

    // DELETE /users/{user}
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }
}
