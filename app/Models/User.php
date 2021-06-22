<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use App\Models\Permission;
use App\Models\Role;
use Cartalyst\Sentinel\Users\EloquentUser;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;

class User extends EloquentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'name',
        'newsletter_enable'
    ];
     
     use Authenticatable;

     public function withRoles() {
        return $this -> belongsToMany( static::$rolesModel , 'role_users' , 'user_id' , 'role_id' ) -> withTimestamps() ;
    }

    public function withActivation() {

        return $this->hasOne('App\Models\Activation');
    }
    
    public static function byEmail($email){
        return static::whereEmail($email)->first();

    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "social_media" => "array",
        "permissions" => "array"
    ];
}
