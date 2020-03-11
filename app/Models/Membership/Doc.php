<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\DocTransformer;

class Doc extends Model
{
    use SoftDeletes;

    public $transformer = DocTransformer::class;

    const TYPE = 'membership';

    protected $fillable = [
      'type',
      'reference',
      'membership_year_id',
    ];


    /*
    ** RELATIONS
    */

    public function memberships() {
      return $this->hasMany('App\Models\Membership\Membership', 'doc_id');
    }

    public function membershipyear() {
      return $this->belongsTo('App\Models\Membership\Membershipyear', 'membership_year_id');
    }

    public function section() {
      return $this->belongsTo('App\Models\Membership\Section', 'section_id');
    }

}
