<?php

namespace App\Http\Controllers\Api\Membership;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Membership;
use App\Models\Membership\Section;
use App\Models\Membership\MembershipSection;

class MembershipSectionController extends ApiController
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
    public function index(Membership $membership)
    {
        $section = $membership->sections;

        return $this->showCollection($section);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership, Section $section)
    {
      $membership->sections()->syncWithoutDetaching([$section->id]);

      return $this->showCollection($membership->sections);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Membership $membership, Section $section)
    {
        if(!$membership->sections()->find($section->id))
        {
          return $this->errorResponse("Ta članstvo nima te sekcije", 453);
        }

        $membership->sections()->detach($section->id);

        return $this->showCollection($membership->sections);
    }
}
