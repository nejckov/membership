<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\CommentTransformer;

class Comment extends Model
{

  use SoftDeletes;
  
  public $transformer = CommentTransformer::class;

  const TYPE_COMPETITION = 'competition';

    protected $fillable = [
      'comment',
      'user_id',
      'type',
      'type_id',
    ];



    /**
    * RELATIONS
    **/

    public function competition() {
      return $this->belongsTo('App\Models\Membership\Competition');
    }

    public function user() {
      return $this->belongsTo('App\User');
    }
}
