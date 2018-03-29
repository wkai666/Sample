<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function gravatar($size="100"){
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/userimage/137012254/686742161efca97a00dc208dced7dab4.jpeg";
    }
    public static function boot(){
        parent::boot();
        static::creating(function ($user) {
            $user->activation_token = str_random(30);
        });
    }

    public function sendPasswordResetNofication($token){
        $this->notify(new ResetPassword($token));
    }

}
