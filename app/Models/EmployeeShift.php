<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeShift extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function shift()
    {
       return $this->belongsTo(Shift::class);
    }

    public function employee()
    {
       return $this->belongsTo(User::class, 'employee_id');
    }
}
