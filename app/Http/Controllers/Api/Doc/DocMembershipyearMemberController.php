<?php

namespace App\Http\Controllers\Api\Doc;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Doc;
use App\Models\Membership\MembershipYear;
use App\Models\Membership\Member;
use App\Models\Membership\Membership;

class DocMembershipyearMemberController extends ApiController
{
    public function __construct()
    {
      parent::__construct();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doc $doc, MembershipYear $membershipyear, Member $member)
    {
      $membership = new Membership();

      $membership = $membership->where('member_id', $member->id)
                                ->where('membership_year_id', $membershipyear->id)
                                ->where('doc_id', $doc->id)
                                ->first();

      $membership->delete();

      return response()->json([
        'data' => $membership,
      ]);
    }
}
