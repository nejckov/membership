<?php

namespace App\Http\Controllers\Api\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Post;
use App\Models\Membership\MembershipYear;

class PostMembershipYearMemberController extends ApiController
{


    public function __construct()
    {
      parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, MembershipYear $membershipYear)
    {
      $membership_year_id = $membershipYear->id;

      $members = $post->members()
                        ->wherehas('memberships', function($query) use ($membership_year_id) {
                          $query->where('membership_year_id', $membership_year_id);
                        })
                        ->get();

      return $this->showCollection($members);
    }

}
