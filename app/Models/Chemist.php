<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;
use App\Models\Employee;
use App\Models\Territory;

class Chemist extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'chemist',
        'employee_id',
        'class',
        'address',
        'territory_id',
        'contact_person',
        'contact_no_1',
        'contact_no_2',
        'email',
    ];

    public function Employee() 
    {
        return $this->belongsTo(Employee::class);
    }

    public function Territory() 
    {
        return $this->belongsTo(Territory::class);
    }
}
