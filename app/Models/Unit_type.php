<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit_type extends Model
{
    use HasFactory;

    protected $fillable=[
        'unit_type',
        
    ];

    
    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
