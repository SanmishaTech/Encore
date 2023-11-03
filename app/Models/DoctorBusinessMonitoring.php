<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\GrantApproval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorBusinessMonitoring extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'grant_approval_id',
        'date',
        'roi',
        'product_id',
        'nrv',
        'doctor_id',     
        'month',
        'amount',
        'code',
        'total_expected_value',
        'total_business_value'
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

   

    public function ProductDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function GrantApproval() 
    {
        return $this->belongsTo(GrantApproval::class);
    }   
}
