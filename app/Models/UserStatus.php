<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;
    public $incrementing=false; protected $keyType='string';
    protected $fillable=['user_id',
                         'label',
                         'notes'];

    public function user(){ return $this->belongsTo(User::class); }
}
