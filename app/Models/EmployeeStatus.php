<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeStatus extends Model
{
    use HasFactory;
    public $incrementing=false; protected $keyType='string';
    protected $fillable=['employee_id','label','notes'];

    public function employee(){ return $this->belongsTo(Employee::class); }
}
