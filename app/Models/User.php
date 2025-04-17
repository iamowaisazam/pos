<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $cachedPermissions = null;

   


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id');
    }

   
    public function permission($permission)
    {

    

        if($this->role_id == 1){
            return true;
        }
         
        if ($this->cachedPermissions === null) {
            
            if($this->role->permissions){
                $this->cachedPermissions = $this->role->permissions;
            }
            
        }

        if(in_array($permission,explode(',',$this->cachedPermissions))){
            return true;
        }else{
            return false;
        
        }
    
    }
  




}
