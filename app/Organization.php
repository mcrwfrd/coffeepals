<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Hash;

class Organization extends Model
{
    use Authenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * Get the users that belong to the organization
     *
     */
    protected $hidden = [
        'password',
    ];

    public function users() 
    {
        return $this->hasMany('App\User');
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password))
        {
            $this->attributes['password'] = Hash::make($password);
        }
    }
}