<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Purchase extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'product_id',
        'original_price',
        'sale_price',
        'stock_level' ,
        'quantity',
        'purchased_at',
        'expired_at',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }   
    

}
