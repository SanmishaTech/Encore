<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Employee;
use App\Models\FreeScheme;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FreeSchemeDetail extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'free_scheme_id',
        'product_id',
        'nrv',
        'qty',
        'free_qty',
        'free',
        'val',
        'status',
    ];

    public function FreeScheme() 
    {
        return $this->belongsTo(FreeScheme::class);
    }

    public function Product() 
    {
        return $this->belongsTo(Product::class);
    }

    public function Employee() 
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }
    
}
