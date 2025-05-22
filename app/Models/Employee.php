<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    public $incrementing=false; protected $keyType='string';
    protected $fillable=[
        'first_name','middle_name','last_name','address',
        'department_name','subject_taught','salary',
        'bank_account_number','phone_number'
    ];

    
    public function statuses() { return $this->hasMany(EmployeeStatus::class); }
    public function payslips() { return $this->hasMany(Payslip::class); }
}
