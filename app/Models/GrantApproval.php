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
        'employee_id_1',
        'employee_id_2',
        'employee_id_3',
        'doctor_id',
        'mpl_no',
        'speciality',
        'location',
        'date',
        'proposal_date',
        'activity_id',
        'amount',
        'code',
        'contact_no',
        'email',
    ];
    
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function getDateAttribute($value)
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

    public function ZonalManager() 
    {
        return $this->belongsTo(Employee::class, 'employee_id_1');
    }

    public function AreaManager() 
    {
        return $this->belongsTo(Employee::class, 'employee_id_2');
    }

    public function Manager() 
    {
        return $this->belongsTo(Employee::class, 'employee_id_3');
    }

    public static function codeGenerate(): void
    {
        static::creating(function(GrantApproval $grant_approval){
            $grantApproval = GrantApproval::whereNotNull('code')->orderBy('created_at','DESC')->first();
            $max = $grantApproval ? Str::substr($grantApproval->code, -1) : 0;
            $grant_approval->code = 'G'.str_pad($max + 1, 5, "0", STR_PAD_LEFT);
        });
    }
}
