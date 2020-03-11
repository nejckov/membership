<?php

namespace App\Http\Controllers\Api\Doc;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Doc;

class DocMembershipYearController extends ApiController
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
    public function index(DOc $doc)
    {
        $membership_years = $doc->memberships()
                                  ->with('membershipYear')
                                  ->get()
                                  ->pluck('membershipYear')
                                  ->unique()
                                  ->values();

        return $this->showCollection($membership_years);
    }
}
