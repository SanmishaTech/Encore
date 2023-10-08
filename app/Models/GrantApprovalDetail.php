<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Carbon\Carbon;
use App\Models\GrantApproval;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class GrantApprovalDetail extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'grant_approval_id',
        'status',
        'reason',
        'amount',
    ];

    public function GrantApproval() 
    {
        return $this->belongsTo(GrantApproval::class);
    }   

    public function Employee() 
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }

  
}
