<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

       
}

