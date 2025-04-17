<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Vendor extends Model
{
    protected $table = 'vendors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


   
}
