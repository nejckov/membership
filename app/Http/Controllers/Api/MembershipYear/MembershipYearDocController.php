<?php

namespace App\Http\Controllers\Api\MembershipYear;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\MembershipYear;

class MembershipYearDocController extends ApiController
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
        $docs = $membershipYear->memberships()
                              ->with('doc')
                              ->get()
                              ->pluck('doc')
                              ->unique()
                              ->values();

        return $this->showCollection($docs);
    }

}
