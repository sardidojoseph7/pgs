<?php

namespace App\Http\Controllers;

use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserStatusController extends Controller
{
    // GET /user-statuses
    public function index()
    {
        return response()->json(UserStatus::with('user')->get());
    }

    // POST /user-statuses
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'label' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $data['id'] = Str::uuid();
        $status = UserStatus::create($data);

        return response()->json($status, 201);
    }

    // GET /user-statuses/{userStatus}
    public function show(UserStatus $userStatus)
    {
        return response()->json($userStatus->load('user'));
    }

    // PUT /user-statuses/{userStatus}
    public function update(Request $request, UserStatus $userStatus)
    {
        $data = $request->validate([
            'label' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $userStatus->update($data);

        return response()->json($userStatus);
    }

    // DELETE /user-statuses/{userStatus}
    public function destroy(UserStatus $userStatus)
    {
        $userStatus->delete();

        return response()->json(['message' => 'User status deleted successfully.']);
    }
}
