<?php

namespace App\Http\Controllers\Api\Analize;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use DB;

class MembershipyearAgeGroupController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $members = DB::select('select a.name as name, count(b.id) as members
                              from age_groups a
                              left join memberships b on a.id = b.age_group_id
                              where b.membership_year_id = '. $id .'
                              group by a.name');

      return response()->json([
        'data' => $members
      ]);
    }

}
