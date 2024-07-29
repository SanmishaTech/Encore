<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\GrantApprovalDetail;
use App\Models\Doctor;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class GrantApproval extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'employee_id',
        'doctor_id',
        'date_of_issue',
        'proposal_month',
        'activity_id',
        'proposal_amount',
        'code',
        'contact_no',
        'email',
        'status',
        'approved_on',
        'remark',
    ];
    
    public function setDateOfIssueAttribute($value)
    {
        $this->attributes['date_of_issue'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function getDateOfIssueAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setProposalDateAttribute($value)
    {
        $this->attributes['proposal_date'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function getProposalDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function Activity() 
    {
        return $this->belongsTo(Activity::class);
    }

    public function GrantApprovalDetail() 
    {
        return $this->hasMany(GrantApprovalDetail::class, 'grant_approval_id');
    }

    public function Doctor() 
    {
        return $this->belongsTo(Doctor::class);
    }


    public function Manager() 
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public static function booted(): void
    {
        static::creating(function(GrantApproval $grant_approval){
            $grantApprovals = GrantApproval::whereNotNull('code')->orderBy('created_at','DESC')->first();
            $max = $grantApprovals ? Str::substr($grantApprovals->code, 1) : 0;
            $grant_approval->code = 'G'.str_pad($max + 1, 5, "0", STR_PAD_LEFT);
        });
    }

    public function zzonalManager() 
    {
        return $this->hasMany(Employee::class, 'reporting_office_1');
    }
}
