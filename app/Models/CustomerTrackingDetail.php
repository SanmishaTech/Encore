<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use App\Models\Product;
use App\Models\Doctor;
use App\Models\CustomerTracking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTrackingDetail extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'customer_tracking_id',
        'doctor_id',
        'speciality',
        'location',
        'product_id',
        'nrv',
        'qty',
        'val',
        'm_1',
        'm_2',
        'm_3',
        'm_4',
    ];

    public function CustomerTracking() 
    {
        return $this->belongsTo(CustomerTracking::class);
    }

    public function Product() 
    {
        return $this->belongsTo(Product::class);
    }

    public function Doctor() 
    {
        return $this->belongsTo(Doctor::class);
    }
}

