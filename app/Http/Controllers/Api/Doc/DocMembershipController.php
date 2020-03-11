<?php

namespace App\Http\Controllers\Api\Doc;

use Illuminate\Http\Request;
use App\Http\Requests\MembershipRequest;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Member;
use App\Models\Membership\Doc;
use App\Models\Membership\Membership;

use App\Transformers\MembershipTransformer;

use App\Events\getAgeGroupEvent;

class DocMembershipController extends ApiController
{

    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . MembershipTransformer::class)->only(['store']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Doc $doc, Request $request)
    {

        $member = Member::whereId($request['member_id'])->first();
        $age_group_id = event(new getAgeGroupEvent($member));

        $membership = Membership::firstOrCreate([
          'member_id' => $request['member_id'],
          'membership_year_id' => $request['membership_year_id'],
        ],
        [
          'doc_id' => $doc->id,
          'age_group_id' => $age_group_id[0],
          'user_id' => 2,
        ]);

      if(!$membership->wasRecentlyCreated)
      {
        return $this->errorResponse("Članstvo že obstaja", 411);
      }

      return response()->json([
        'data' => $membership,
      ]);
    }


}
