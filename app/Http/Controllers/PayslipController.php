<?php

namespace App\Http\Controllers;

use App\Models\Payslip;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PayslipController extends Controller
{
    // GET /payslips
    public function index()
    {
        return response()->json(Payslip::with('employee', 'statuses')->get());
    }

    // POST /payslips
    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'period_start' => 'required|date',
            'period_end' => 'required|date|after_or_equal:period_start',
            'basic_pay' => 'required|numeric',
            'allowances' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'net_pay' => 'required|numeric',
        ]);

        $data['id'] = Str::uuid();
        $payslip = Payslip::create($data);

        return response()->json($payslip, 201);
    }

    // GET /payslips/{payslip}
    public function show(Payslip $payslip)
    {
        return response()->json($payslip->load('employee', 'statuses'));
    }

    // PUT /payslips/{payslip}
    public function update(Request $request, Payslip $payslip)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'period_start' => 'required|date',
            'period_end' => 'required|date|after_or_equal:period_start',
            'basic_pay' => 'required|numeric',
            'allowances' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'net_pay' => 'required|numeric',
        ]);

        $payslip->update($data);

        return response()->json($payslip);
    }

    // DELETE /payslips/{payslip}
    public function destroy(Payslip $payslip)
    {
        $payslip->delete();

        return response()->json(['message' => 'Payslip deleted successfully.']);
    }
}
