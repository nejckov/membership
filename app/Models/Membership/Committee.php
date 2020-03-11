<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\CommitteeTransformer;

class Committee extends Model
{

    use SoftDeletes;

    public $transformer = CommitteeTransformer::class;

    protected $fillable = [
      'fns_id',
      'member_id',
      'year',
      'description'
    ];


    /**
    * RELATIONS
    */

    public function fns()
    {
        return $this->belongsTo('App\Models\Membership\Fns');
    }

    public function member()
    {
      return $this->belongsTo('App\Models\Membership\Member');
    }
}
