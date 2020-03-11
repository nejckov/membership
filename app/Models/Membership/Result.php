<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\ResultTransformer;

class Result extends Model
{

    use SoftDeletes;

    public $transformer = ResultTransformer::class;

    const TYPE_CATEGORY = 'category';

    protected $fillable = [
      'place',
      'fname',
      'lname',
      'member_id',
      'result',
      'type',
      'type_id',
    ];


    /**
    * RELATIONS
    **/

    public function category() {
      return $this->belongsTo('App\Models\Membership\Category');
    }
}
