<?php

namespace App\Models;
use App\Models\Product;
use App\Models\FreeScheme;
use App\Traits\CreatedUpdatedBy;

use Illuminate\Database\Eloquent\Model;
use App\Models\DoctorBusinessMonitoring;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function Product() 
    {
        return $this->belongsTo(Product::class);
    }
}
