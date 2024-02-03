<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\CustomerTrackingDetail;
use App\Models\ProductDetail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTracking extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'employee_id',
        'proposal_date',
        'proposal_month',
        'primary',
        'secondary',
        'amount'
    ];

    public function setProposalDateAttribute($value)
    {       
        $this->attributes['proposal_date'] = $value != null  ? Carbon::createFromFormat('d/m/Y', $value) : null;
    }

    public function getProposalDateAttribute($value)
    {      
        return $value != null  ? Carbon::parse($value)->format('d/m/Y') : null;
    }    

    public function CustomerTrackingDetail() 
    {
        return $this->hasMany(CustomerTrackingDetail::class, 'customer_tracking_id');
    }    

    public function Manager() 
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function ProductDetail() 
    {
        return $this->hasMany(ProductDetail::class);
    } 
}
