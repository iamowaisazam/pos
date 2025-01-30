<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Setting extends Model
{
    public $timestamps = false;

    protected $table = 'settings';
    protected $guarded = [];

  


    
}
