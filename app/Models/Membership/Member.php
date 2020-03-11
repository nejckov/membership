<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\MemberTransformer;

class Member extends Model
{

    use SoftDeletes;

    public $transformer = MemberTransformer::class;

    protected $fillable = [
      'custom_number',
      'fname',
      'lname',
      'address',
      'birthdate',
      'email',
      'mobile',
      'active',
      'gender',
      'post_id',
      'description'
    ];

    protected $dates = [
      'deleted_at',
      'birthdate'
    ];

    protected $appends = [
      'birth'
    ];


    /*
    ** RELATIONS
    */

    public function memberships()
    {
      return $this->hasMany('App\Models\Membership\Membership');
    }

    public function post()
    {
      return $this->belongsTo('App\Models\Membership\Post', 'post_id');
    }


    /**
    * ATTRIBUTES
    */

    public function getBirthAttribute()
    {
      return $this->birthdate->format('d.m.Y');
    }

}
