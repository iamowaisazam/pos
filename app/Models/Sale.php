<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    protected $table = 'sales';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(SaleItem::class, 'sale_id');
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
       
}

