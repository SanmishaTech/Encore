<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\DoctorBusinessMonitoring;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DoctorBusinessMonitoringDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_business_monitoring_id',
        'status',
        'reason',
        'amount',
    ];

    public function DoctorBusinessMonitoring() 
    {
        return $this->belongsTo(DoctorBusinessMonitoring::class);
    } 

    public function Employee() 
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }
}
