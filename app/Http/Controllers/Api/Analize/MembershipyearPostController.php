<?php

namespace App\Http\Controllers\Api\Analize;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use DB;

class MembershipyearPostController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $members = DB::select('select count(b.id) as members, a.post_id, c.name as name
                            from memberships b
                            left join members a ON a.id=b.member_id
                            left join posts c ON a.post_id=c.id
                            where b.membership_year_id = '. $id .'
                            group by b.membership_year_id, a.post_id, c.name
                            order by members DESC');

        return response()->json([
          'data' => $members
        ]);
    }

}
