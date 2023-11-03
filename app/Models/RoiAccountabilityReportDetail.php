<?php

namespace App\Models;
use App\Traits\CreatedUpdatedBy;
use App\Models\Product;
use App\Models\RoiAccountabilityReport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoiAccountabilityReportDetail extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'roi_accountability_report_id',
        'product_id',
        'nrv',
        'month',
        'act_vol',
        'act_val',
        'scheme'
    ];

    public function RoiAccountabilityReport() 
    {
        return $this->belongsTo(RoiAccountabilityReport::class);
    }

    public function Product() 
    {
        return $this->belongsTo(Product::class);
    }
}
