<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorBusinessMonitoring extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'employee_id_1',
        'employee_id_2',
        'employee_id_3',
        'date',
        'roi',
        'product_id',
        'nrv',
        'doctor_id',
        'mpl_no',
        'speciality',
        'location',
        'month',
        'amount',
        'code',
    ];
    
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function Doctor() 
    {
        return $this->belongsTo(Doctor::class);
    }

    public function ZonalManager() 
    {
        return $this->belongsTo(Employee::class, 'employee_id_1');
    }

    public function AreaManager() 
    {
        return $this->belongsTo(Employee::class, 'employee_id_2');
    }

    public function Manager() 
    {
        return $this->belongsTo(Employee::class, 'employee_id_3');
    }

    public function ProductDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }
}
