<?php

namespace App\Http\Controllers\Api\MembershipYear;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\MembershipYear;

class MembershipYearPostController extends ApiController
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
    public function index(MembershipYear $membershipYear)
    {
        $posts = $membershipYear->memberships()
                                  ->with('member.post')
                                  ->get()
                                  ->pluck('member')
                                  ->pluck('post')
                                  ->unique()
                                  ->values();


          return $this->showCollection($posts);
    }

}
