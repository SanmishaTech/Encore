<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;
use App\Models\Employee;


class Stockist extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'stockist',
        'employee_id_1',
        'employee_id_2',
        'employee_id_3',
        'contact_no',
        'cfa_email',
    ];

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
}
