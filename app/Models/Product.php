<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Product extends Model
{
    use HasFactory,SoftDeletes;
    

    protected $fillable=[
        'product_name',
        'image',
        'stock_level' ,
        'unit',
        'unit_type_id',
        'category_id',
        
    ];

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }


    public function category()
{
    return $this->belongsTo(Category::class);
}


public function unit_type()
{
    return $this->belongsTo(UnitType::class);
}


}
