<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    protected $with = ['roles', 'employeeRecord'];

    public function employeeRecord()
    {
        return $this->hasOne(EmployeeRecord::class);
    }

    public function clientRecord()
    {
        return $this->hasOne(ClientRecord::class);
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class, 'client_id');
    }

    public function bankInformation()
    {
        return $this->hasOne(BankInformation::class);
    }

    public function employeeDisapproved()
    {
        return $this->hasMany(EmployeeDisapproval::class, 'employee_id');
    }

    public function disapprovedBy()
    {
        return $this->hasMany(EmployeeDisapproval::class, 'declined_by');
    }

    public function experience()
    {
        return $this->hasMany(Experience::class);
    }

    public function nextofkin()
    {
        return $this->hasOne(NextOfKin::class);
    }

    public function employeeReference()
    {
        return $this->hasMany(EmployeeReference::class);
    }

    public function document()
    {
        return $this->hasMany(Document::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
