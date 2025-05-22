<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;
    public $incrementing=false; protected $keyType='string';
    protected $fillable=[
        'employee_id','period_start','period_end',
        'basic_pay','allowances','deductions','net_pay'
    ];

    
    public function employee()    { return $this->belongsTo(Employee::class); }
    public function statuses()    { return $this->hasMany(PayslipStatus::class); }
}
