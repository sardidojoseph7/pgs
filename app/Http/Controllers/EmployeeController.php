<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    // GET /employees
    public function index()
    {
        return response()->json(Employee::with('statuses', 'payslips')->get());
    }

    // POST /employees
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'department_name' => 'required|string',
            'subject_taught' => 'nullable|string',
            'salary' => 'required|numeric',
            'bank_account_number' => 'required|string',
            'phone_number' => 'required|digits:11',
        ]);

        $data['id'] = Str::uuid();
        $employee = Employee::create($data);

        return response()->json($employee, 201);
    }

    // GET /employees/{employee}
    public function show(Employee $employee)
    {
        return response()->json($employee->load('statuses', 'payslips'));
    }

    // PUT/PATCH /employees/{employee}
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'department_name' => 'required|string',
            'subject_taught' => 'nullable|string',
            'salary' => 'required|numeric',
            'bank_account_number' => 'required|string',
            'phone_number' => 'required|digits:11',
        ]);

        $employee->update($data);

        return response()->json($employee);
    }

    // DELETE /employees/{employee}
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully.']);
    }
}
