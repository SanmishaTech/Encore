<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Chemist;
use App\Models\Product;
use App\Models\Employee;
use App\Models\Stockist;
use App\Models\GrantApproval;
use App\Models\ProductDetail;
use App\Models\FreeSchemeDetail;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FreeScheme extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'employee_id',
        'location',
        'proposal_date',
        'proposal_month',
        'stockist_id',
        'chemist_id',
        'open_scheme',
        'scheme',
        'doctor_id',
        'crm_done',
        'dr_own_counter',
        'amount',
        'remark',
        'status',
        'approved_on',
        'proof_of_order',
        'proof_of_delivery',
        'free_scheme_type',
    ];

    public function setProposalDateAttribute($value)
    {       
        $this->attributes['proposal_date'] = $value != null  ? Carbon::createFromFormat('d/m/Y', $value) : null;
    }

    public function getProposalDateAttribute($value)
    {      
        return $value != null  ? Carbon::parse($value)->format('d/m/Y') : null;
    } 

    public function Stockist() 
    {
        return $this->belongsTo(Stockist::class);
    }

    public function Chemist() 
    {
        return $this->belongsTo(Chemist::class);
    }

    public function FreeSchemeDetail() 
    {
        return $this->hasMany(FreeSchemeDetail::class, 'free_scheme_id');
    }

    public function Doctor() 
    {
        return $this->belongsTo(Doctor::class);
    }

    public function Manager() 
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function ProductDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }
}
