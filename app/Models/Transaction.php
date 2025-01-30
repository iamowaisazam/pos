<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    
    protected $table = 'transactions';
    
    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function customer()
    {
        return $this->hasMany(Customer::class, 'customer_id');
    }

}

