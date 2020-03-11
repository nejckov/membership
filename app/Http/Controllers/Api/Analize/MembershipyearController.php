<?php

namespace App\Http\Controllers\Api\Analize;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use DB;

class MembershipyearController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $analize = DB::select('select a.year as name, count(b.id) as members
                            from membership_years a
                            left join memberships b on b.membership_year_id = a.id
                            group by a.year');

        return response()->json([
          'data' => $analize
        ]);
    }

}
