<?php

namespace App\Http\Controllers;

use App\Models\Payslip;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PayslipController extends Controller
{
    
    public function index()
    {
        try {
            $payslips = Payslip::with(['employee', 'statuses'])->get();
            return response()->json($payslips);
        } catch (\Exception $e) {
            Log::error('Failed to fetch payslips: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch payslips.'], 500);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id'   => 'required|exists:employees,id',
            'period_start'  => 'required|date',
            'period_end'    => 'required|date|after_or_equal:period_start',
            'basic_pay'     => 'required|numeric',
            'allowances'    => 'nullable|numeric',
            'deductions'    => 'nullable|numeric',
            'net_pay'       => 'required|numeric',
        ]);

        $validated['id'] = (string) Str::uuid();
        
        

        try {
            $payslip = Payslip::create($validated);
            return response()->json($payslip, 201);
        } catch (\Exception $e) {
            Log::error('Failed to create payslip: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create payslip.'], 500);
        }
    }

    public function show(Payslip $payslip)
    {
        try {
            $payslip->load(['employee', 'statuses']);
            return response()->json($payslip);
        } catch (\Exception $e) {
            Log::error('Failed to fetch payslip: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch payslip.'], 500);
        }
    }

    public function update(Request $request, Payslip $payslip)
    {
        $validated = $request->validate([
            'employee_id'   => 'required|exists:employees,id',
            'period_start'  => 'required|date',
            'period_end'    => 'required|date|after_or_equal:period_start',
            'basic_pay'     => 'required|numeric',
            'allowances'    => 'nullable|numeric',
            'deductions'    => 'nullable|numeric',
            'net_pay'       => 'required|numeric',
        ]);

        try {
            $payslip->update($validated);
            return response()->json($payslip);
        } catch (\Exception $e) {
            Log::error('Failed to update payslip: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update payslip.'], 500);
        }
    }

    public function destroy(Payslip $payslip)
    {
        try {
            $payslip->delete();
            return response()->json(['message' => 'Payslip deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Failed to delete payslip: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete payslip.'], 500);
        }
    }
}
