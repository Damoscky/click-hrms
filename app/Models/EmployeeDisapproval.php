<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDisapproval extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function declinedBy()
    {
        return $this->belongsTo(User::class, 'declined_by');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}

