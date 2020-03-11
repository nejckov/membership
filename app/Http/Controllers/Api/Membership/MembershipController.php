<?php

namespace App\Http\Controllers\Api\Membership;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

use App\Models\Membership\Member;
use App\Models\Membership\Membershipyear;
use App\Models\Membership\AgeGroup;
use App\Models\Membership\Membership;


class MembershipController extends ApiController
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
    public function index()
    {
        $memberships = Membership::all();

        return $this->showCollection($memberships);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Membership $membership)
    {
      return $this->showItem($membership);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $membership = Membership::where('member_id', $request['member'])
                                ->where('membership_year_id', $request['membershipyear'])
                                ->first();

      $membership->delete();

      return $this->showItem($membership);
    }

    public function calcAgeGroup() {

      $memberships = Membership::all();

      $group = [];

      foreach($memberships as $membership)
      {
        $member = Member::whereId($membership->member_id)->first();
        $membershipyear = Membershipyear::whereId($membership->membership_year_id)->first();
        $age_groups = AgeGroup::all();

        $age = $membershipyear->year - $member->birthdate->year;

        foreach($age_groups as $age_group)
        {
          if($age_group->from <= $age && $age_group->to >= $age)
          {
            $membership->age_group_id = $age_group->id;
            $membership->save();
          }
        }
      }

      return response()->json([
        'data' => 'DONE',
      ]);

    }

}
