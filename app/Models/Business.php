<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Business extends Model
{
    protected $table = 'business';

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $guarded = [];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


   
}
