<?php

namespace App\Models;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'id',
        'name',        
        'contact_no_1',
        'contact_no_2',
        'email',
        'communication_email',
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
        // $this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $value);
        $this->attributes['dob'] = $value != null  ? Carbon::createFromFormat('d/m/Y', $value) : null;
    }

    public function getDobAttribute($value)
    {
        // return Carbon::parse($value)->format('d/m/Y');
        return $value != null  ? Carbon::parse($value)->format('d/m/Y') : null;
    }

    public function users() 
    {
        return $this->hasOne(User::class, 'id');
    }
    
    // public function EmployeeCode()
    // {
    //     $employees = Employee::orderBy('created_at','DESC')->first();
    //     $max = $employees ? Str::substr($employees->employee_code, -1) : 0;
    //     return 'I'.str_pad($max + 1, 5, "0", STR_PAD_LEFT);
    // }

    public function EmployeeCode()
    {
        $last_id = Employee::latest()->first();
        if (! $last_id) {
            $employee_code = 'I00001';
        }
        $code = preg_replace("/[^0-9\.]/", '', $last_id -> id);
        $employee_code = 'I'.sprintf('%00002d', $code + 1);
        return $employee_code;
    }

    public function ZonalManager() 
    {
        return $this->belongsTo(Employee::class, 'reporting_office_1');
    }

    public function AreaManager() 
    {
        return $this->belongsTo(Employee::class, 'reporting_office_2');
    }

    public function Manager() 
    {
        return $this->belongsTo(Employee::class, 'reporting_office_3');
    }

    // public static function booted()
    // {
    //     static::creating(function(Employee $employee){
    //         $employees = Employee::orderBy('created_at','DESC')->first();
    //         // dd($employees);
    //         $max = $employees ? Str::substr($employees->employee_code, -1) : 0;
    //         return 'I'.str_pad($max + 1, 5, "0", STR_PAD_LEFT);
    //     });
    // }

}
