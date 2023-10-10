<?php

namespace App\Models;
use App\Traits\CreatedUpdatedBy;
use App\Models\Product;
use App\Models\DoctorBusinessMonitoring;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'doctor_business_monitoring_id',
        'product_id',
        'nrv',
        'avg_business_units',
        'avg_business_value',
        'exp_vol',
        'exp_vol_1',
        'exp_vol_2',
        'exp_vol_3',
        'exp_vol_4',
        'exp_vol_5',
        'exp_vol_6',
        'total_exp_vol',
        'total_exp_val',
        'scheme'
    ];

    public function DoctorBusinessMonitoring() 
    {
        return $this->belongsTo(DoctorBusinessMonitoring::class);
    }
}
