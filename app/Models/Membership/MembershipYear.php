<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\MembershipYearTransformer;

class MembershipYear extends Model
{
    use SoftDeletes;

    public $transformer = MembershipYearTransformer::class;

    protected $fillable = [
      'type',
      'year',
      'payment',
      'description',
      'active',
    ];


    /*
    ** RELATIONS
    */

    public function memberships()
    {
        return $this->hasMany('App\Models\Membership\Membership');
    }
}
