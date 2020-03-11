<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\CategoryTransformer;


class Category extends Model
{

    use SoftDeletes;
    public $transformer = CategoryTransformer::class;

    const TYPE_COMPETITION = 'competition';

    protected $fillable = [
      'name',
      'from',
      'to',
      'type',
      'type_id',
      'participants',
    ];



    /**
    * RELATIONS
    **/

    public function results() {
      return $this->hasMany('App\Models\Membership\Result', 'type_id');
    }

    public function competition() {
      return $this->belongsTo('App\Models\Membership\Competition');
    }
  }
