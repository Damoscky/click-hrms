<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTimesheet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function employee()
    {
       return $this->belongsTo(User::class, 'employee_id');
    }

    public function client()
    {
       return $this->belongsTo(User::class, 'client_id');
    }

    public function shift()
    {
       return $this->belongsTo(Shift::class, 'shift_id');
    }

}
