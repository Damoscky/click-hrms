<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeReferenceResponse extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employeeReference()
    {
        return $this->belongsTo(EmployeeReference::class, 'employee_references_id');
    }
}
