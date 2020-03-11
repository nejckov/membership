<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MembershipSection extends Model
{

    use SoftDeletes;

    protected $table = 'membership_section';

    protected $fillable = [
      'membership_id',
      'section_id',
    ];

}
