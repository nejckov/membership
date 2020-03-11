<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Passport\HasApiTokens;

use App\Transformers\UserTransformer;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public $transformer = UserTransformer::class;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'role_id',
        'company_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
    * RELATIONS
    */

    public function role()
    {
        return $this->belongsTo('App\Models\Membership\Role', 'role_id', 'id');
    }

    public function company()
    {
      return $this->belongsTo('App\Models\Membership\Company');
    }

    public function memberships()
    {
      return $this->hasMany('App\Models\Membership\Membership', 'id', 'user_id');
    }
}
