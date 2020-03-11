<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\ImageTransformer;

class Image extends Model
{

  use SoftDeletes;

  public $transformer = ImageTransformer::class;

  const TYPE_COMPETITION = 'competition';

    protected $fillable = [
      'name',
      'src',
      'description',
      'user_id',
      'type',
      'type_id'
    ];


    /**
    * RELATIONS
    **/

    public function competition() {
      return $this->belongsTo('App\Models\Membership\Competition');
    }
}
