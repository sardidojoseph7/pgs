<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    // GET /roles
    public function index()
    {
        return response()->json(Role::with('users')->get());
    }

    // POST /roles
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'description' => 'nullable|string',
        ]);

        $data['id'] = Str::uuid();
        $role = Role::create($data);

        return response()->json($role, 201);
    }

    // GET /roles/{role}
    public function show(Role $role)
    {
        return response()->json($role->load('users'));
    }

    // PUT /roles/{role}
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'description' => 'nullable|string',
        ]);

        $role->update($data);
        return response()->json($role);
    }

    // DELETE /roles/{role}
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully.']);
    }
}
