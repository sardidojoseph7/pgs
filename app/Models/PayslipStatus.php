<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayslipStatus extends Model
{
    use HasFactory;
    public $incrementing=false; protected $keyType='string';
    protected $fillable=['payslip_id',
                         'label',
                         'notes'];

    public function payslip(){ return $this->belongsTo(Payslip::class); }
}