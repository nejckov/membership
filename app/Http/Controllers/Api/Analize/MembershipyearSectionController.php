<?php

namespace App\Http\Controllers\Api\Analize;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use DB;

class MembershipyearSectionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $members = DB::select('select count(b.id) as members, d.name as name
                                from memberships b
                                left join members a ON a.id=b.member_id
                                left join membership_section c ON c.membership_id=b.id
                                left join sections d ON c.section_id=d.id
                                left join membership_years e ON e.id=b.membership_year_id
                                where b.membership_year_id = ' . $id . '
                                group by b.membership_year_id, d.name
                                order by members DESC');

        return response()->json([
          'data' => $members
        ]);
    }

}
