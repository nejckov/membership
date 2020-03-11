<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\competitionTransformer;

class Competition extends Model
{

  use SoftDeletes;

  public $transformer = CompetitionTransformer::class;

    protected $fillable = [
      'name',
      'competition_date',
      'competition_time',
      'place',
      'payment',
      'description',
    ];

    protected $dates = [
      'competition_date',
    ];

    protected $appends = [
      'competition_date_eu'
    ];


    /**
    * RELATIONS
    **/

    public function categories() {
      return $this->hasMany('App\Models\Membership\Category', 'type_id');
    }

    public function images() {
      return $this->hasMany('App\Models\Membership\Image', 'type_id');
    }

    public function comments() {
      return $this->hasMany('App\Models\Membership\Comment', 'type_id');
    }

    public function company() {
      return $this->belongsTo('App\Models\Membership\Company');
    }


    /**
    * ATTRIBUTES
    */

    public function getCompetitionDateEuAttribute() {
      return $this->competition_date->format('d.m.Y');
    }


}
