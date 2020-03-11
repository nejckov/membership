<?php

namespace App\Http\Controllers\Api\AgeGroup;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\AgeGroup;
use App\Models\Membership\MembershipYear;

class AgeGroupMembershipYearMemberController extends ApiController
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
    public function index(AgeGroup $ageGroup, MembershipYear $membershipYear)
    {

        $members = $ageGroup->memberships()
                              ->where('membership_year_id', $membershipYear->id)
                              ->with('member')
                              ->get()
                              ->pluck('member')
                              ->unique()
                              ->values();

        return $this->showCollection($members);

    }

}
