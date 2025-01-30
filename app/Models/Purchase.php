<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    protected $table = 'purchases';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id');
    }


    public function Vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
       
}

