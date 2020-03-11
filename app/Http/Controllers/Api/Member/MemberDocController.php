<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Member;

class MemberDocController extends ApiController
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
        $docs = $member->memberships()
                        ->with('doc')
                        ->get()
                        ->pluck('doc')
                        ->unique()
                        ->values();


        return $this->showCollection($docs);
    }

}
