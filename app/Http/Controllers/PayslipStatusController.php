<?php

namespace App\Http\Controllers;

use App\Models\PayslipStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PayslipStatusController extends Controller
{
    // GET /payslip-statuses
    public function index()
    {
        return response()->json(PayslipStatus::with('payslip')->get());
    }

    // POST /payslip-statuses
    public function store(Request $request)
    {
        $data = $request->validate([
            'payslip_id' => 'required|exists:payslips,id',
            'label' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $data['id'] = Str::uuid();
        $status = PayslipStatus::create($data);

        return response()->json($status, 201);
    }

    // GET /payslip-statuses/{payslipStatus}
    public function show(PayslipStatus $payslipStatus)
    {
        return response()->json($payslipStatus->load('payslip'));
    }

    // PUT /payslip-statuses/{payslipStatus}
    public function update(Request $request, PayslipStatus $payslipStatus)
    {
        $data = $request->validate([
            'label' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $payslipStatus->update($data);

        return response()->json($payslipStatus);
    }

    // DELETE /payslip-statuses/{payslipStatus}
    public function destroy(PayslipStatus $payslipStatus)
    {
        $payslipStatus->delete();

        return response()->json(['message' => 'Payslip status deleted successfully.']);
    }
}
