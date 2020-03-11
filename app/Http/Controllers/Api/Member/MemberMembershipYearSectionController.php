<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Member;
use App\Models\Membership\MembershipYear;

class MemberMembershipYearSectionController extends ApiController
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
    public function index(Member $member, MembershipYear $membershipYear)
    {

      $sections = $member->memberships()
                          ->where('membership_year_id', $membershipYear->id)
                          ->with('sections')
                          ->get()
                          ->pluck('sections')
                          ->collapse()
                          ->unique()
                          ->values();

      return $this->showCollection($sections);
    }

}
