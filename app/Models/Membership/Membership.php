<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\MembershipTransformer;

class Membership extends Model
{

    use SoftDeletes;

    public $transformer = MembershipTransformer::class;

    protected $fillable = [
      'member_id',
      'membership_year_id',
      'doc_id',
      'age_group_id',
      'user_id',
    ];

    protected $dates = [
      'deleted_at'
    ];


    /*
    ** RELATIONS
    */

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function membershipYear()
    {
      return $this->belongsTo('App\Models\Membership\MembershipYear');
    }

    public function doc()
    {
      return $this->belongsTo('App\Models\Membership\Doc');
    }

    public function member()
    {
      return $this->belongsTo('App\Models\Membership\Member');
    }

    public function sections()
    {
      return $this->belongsToMany('App\Models\Membership\Section');
    }

}
