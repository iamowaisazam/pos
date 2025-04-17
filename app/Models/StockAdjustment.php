<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class StockAdjustment extends Model
{

    protected $table = 'stockadjustments';
    
    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $guarded = [];

    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


   
}
