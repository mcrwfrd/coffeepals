<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
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
        return $this->belongsToMany('App\User');
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password))
        {
            $this->attributes['password'] = Hash::make($password);
        }
    }

    public function pairAllUsers() {
        $users = $this->users()->inRandomOrder()->get();

        // TODO: assumes even number of users for this organization

        while (!$users->isEmpty()) {
            $user = $users->pop();
            $partner = $users->pop();

            $user->partners()->save($partner);
            $partner->partners()->save($user);
        }
    }
}
