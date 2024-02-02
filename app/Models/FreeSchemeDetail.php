<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use App\Models\Product;
use App\Models\FreeScheme;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeSchemeDetail extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $fillable = [
        'free_scheme_id',
        'product_id',
        'nrv',
        'qty',
        'free',
        'val',
    ];

    public function FreeScheme() 
    {
        return $this->belongsTo(FreeScheme::class);
    }

    public function Product() 
    {
        return $this->belongsTo(Product::class);
    }
}
