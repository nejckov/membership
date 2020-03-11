<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Member;

class MemberMembershipYearController extends ApiController
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
    public function index(Member $member)
    {
        $membership_years = $member->memberships()
                                    ->with('membershipYear')
                                    ->get()
                                    ->pluck('membershipYear')
                                    ->unique()
                                    ->values();

        return $this->showCollection($membership_years);
    }

}
