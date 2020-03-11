<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\PostTransformer;

class Post extends Model
{

    use SoftDeletes;

    public $transformer = PostTransformer::class;

    protected $fillable = [
      'name'
    ];


    /*
    **  RELATIONS
    */

    public function members()
    {
      return $this->hasMany('App\Models\Membership\Member');
    }
}
