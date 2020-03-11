<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transformers\CompanyTransformer;

class Company extends Model
{

    use SoftDeletes;

    public $transformer = CompanyTransformer::class;

    protected $fillable = [
      'name',
      'description'
    ];


    /**
    * RELATIONS
    */

    public function users()
    {
      return $this->hasMany('App\User');
    }

    public function competitions()
    {
      return $this->hasMany('App\Models\Membership\Competition');
    }
}
