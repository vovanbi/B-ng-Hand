<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = [
      'name', 'email', 'password',
     'avatar', 'provider_id', 'provider',
     'access_token'
];

//You can also use below statement 

   protected $guarded = ['*'];

   protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function rating()
    {
        return $this->hasMany(Rating::class,'ra_user_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class,'o_user_id');
    }
}

