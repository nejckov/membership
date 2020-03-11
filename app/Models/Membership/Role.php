<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\RoleTransformer;

class Role extends Model
{

    use SoftDeletes;

    public $transformer = RoleTransformer::class;

    protected $fillable = [
      'name',
      'description'
    ];


    /*
    **  RELATIONS
    */

    public function users()
    {
      return $this->hasMany('App\User');
    }
}
