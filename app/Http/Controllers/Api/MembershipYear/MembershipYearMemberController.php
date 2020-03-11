<?php

namespace App\Http\Controllers\Api\MembershipYear;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Member;
use App\Models\Membership\Membership;
use App\Models\Membership\MembershipYear;

class MembershipYearMemberController extends ApiController
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
      $members = $membershipYear->memberships()
                                  ->with('member')
                                  ->get()
                                  ->pluck('member')
                                  ->unique()
                                  ->values();

      return $this->showCollection($members);
  }

}
