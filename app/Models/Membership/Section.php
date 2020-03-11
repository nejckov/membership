<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\SectionTransformer;

class Section extends Model
{

    use SoftDeletes;

    public $transformer = SectionTransformer::class;

    protected $fillable = [
      'name',
      'description',
      'active'
    ];

    protected $hidden = [
      'pivot'
    ];


    /**
    *  RELATIONS
    */

    public function memberships()
    {
      return $this->belongsToMany('App\Models\Membership\Membership');
    }
}
