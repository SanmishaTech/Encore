<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Doctor;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Models\Qualification;
use App\Models\Category;
use App\Models\Territory;


class Doctor extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'doctor_name',        
        'doctor_address',
        'contact_no_1',
        'contact_no_2',
        'email',
        'hospital_name',
        'hospital_address',
        'employee_id',
        'qualification_id',
        'category_id',
        'speciality',
        'territory_id',
        'city',    
        'state',
        'type',  
        'dob',
        'dow',
        'designation',
        'hq',
        'class',
        'mpl_no',
        'reporting_office_1',
        'reporting_office_2',
        'reporting_office_3',
    ];

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function getDobAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setDowAttribute($value)
    {
        $this->attributes['dow'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function getDowAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function Employee() 
    {
        return $this->belongsTo(Employee::class);
    }

    public function Qualification() 
    {
        return $this->belongsTo(Qualification::class);
    }

    public function Category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function Territory() 
    {
        return $this->belongsTo(Territory::class);
    }
}
