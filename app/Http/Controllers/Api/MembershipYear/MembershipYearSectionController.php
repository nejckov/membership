<?php

namespace App\Http\Controllers\Api\MembershipYear;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\MembershipYear;

class MembershipYearSectionController extends ApiController
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
        $section = $membershipYear->memberships()
                                    ->with('sections')
                                    ->get()
                                    ->pluck('sections')
                                    ->collapse()
                                    ->unique()
                                    ->values();

        return $this->showCollection($section);
    }

}
