<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\FnsTransformer;

class Fns extends Model
{

    use SoftDeletes;

    public $transformer = FnsTransformer::class;

    protected $fillable = [
      'name',
      'description',
      'active'
    ];


    /**
    * RELATIONS
    */

    public function committees()
    {
        return $this->hasMany('App\Models\Membership\Committee');
    }
}
