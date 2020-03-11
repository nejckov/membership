<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\AgeGroupTransformer;

class AgeGroup extends Model
{

    use SoftDeletes;
    public $transformer = AgeGroupTransformer::class;

    protected $fillable = [
      'from',
      'to',
      'name',
      'description',
      'active',
    ];


    /**
    * RELATIONS
    */

    public function memberships() {
      return $this->hasMany('App\Models\Membership\Membership');
    }


}
