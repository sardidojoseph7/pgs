<?php

namespace App\Http\Controllers;

use App\Models\EmployeeStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeStatusController extends Controller
{
    // GET /employee-statuses
    public function index()
    {
        return response()->json(EmployeeStatus::with('employee')->get());
    }

    // POST /employee-statuses
    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'label' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $data['id'] = Str::uuid();
        $status = EmployeeStatus::create($data);

        return response()->json($status, 201);
    }

    // GET /employee-statuses/{employeeStatus}
    public function show(EmployeeStatus $employeeStatus)
    {
        return response()->json($employeeStatus->load('employee'));
    }

    // PUT /employee-statuses/{employeeStatus}
    public function update(Request $request, EmployeeStatus $employeeStatus)
    {
        $data = $request->validate([
            'label' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $employeeStatus->update($data);

        return response()->json($employeeStatus);
    }

    // DELETE /employee-statuses/{employeeStatus}
    public function destroy(EmployeeStatus $employeeStatus)
    {
        $employeeStatus->delete();

        return response()->json(['message' => 'Employee status deleted.']);
    }
}
