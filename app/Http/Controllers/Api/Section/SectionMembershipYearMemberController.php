<?php

namespace App\Http\Controllers\Api\Section;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Section;
use App\Models\Membership\MembershipYear;

class SectionMembershipYearMemberController extends ApiController
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
    public function index(Section $section, MembershipYear $membershipYear)
    {
        $members = $section->memberships()
                          ->where('membership_year_id', $membershipYear->id)
                          ->with('member')
                          ->get()
                          ->pluck('member')
                          ->unique()
                          ->values();

        return $this->showCollection($members);
    }

}
