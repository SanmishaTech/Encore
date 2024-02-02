<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\RoiAccountabilityReportDetail;
use App\Models\GrantApproval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoiAccountabilityReport extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'grant_approval_id', 
        'roi',
        'rar_date',    
        'proposal_month',
        'amount',
        'total_actual_value',
    ];

    public function setRARDateAttribute($value)
    {
        $this->attributes['rar_date'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function getRARDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function Doctor() 
    {
        return $this->belongsTo(Doctor::class);
    }

    public function RoiAccountabilityReportDetails()
    {
        return $this->hasMany(RoiAccountabilityReportDetail::class);
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
