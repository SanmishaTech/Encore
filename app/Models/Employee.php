<?php

namespace App\Models;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;

class Employee extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'name',        
        'contact_no_1',
        'contact_no_2',
        'email',
        'address',
        'designation',
        'state_name',
        'city',
        'fieldforce_name',    
        'employee_code',  
        'dob',
        'reporting_office_1',
        'reporting_office_2',
        'reporting_office_3',
    ];

    //date of birth
    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function getDobAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function users() 
    {
        return $this->hasOne(User::class, 'id');
    }
}
