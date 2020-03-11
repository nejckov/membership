<?php

namespace App\Http\Controllers\Api\MembershipYear;

use Illuminate\Http\Request;
use App\Http\Requests\MembershipYearRequest;
use App\Http\Controllers\ApiController;

use App\Models\Membership\MembershipYear;

use App\Transformers\MembershipYearTransformer;

use App\Events\getActivationActionEvent;

class MembershipYearController extends ApiController
{

    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . MembershipYearTransformer::class)->only(['store', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $membership_years = MembershipYear::all();

        return $this->showCollection($membership_years);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MembershipYearRequest $request)
    {
        $membership_year = MembershipYear::firstOrCreate([
          'type' => $request['type'],
          'year' => $request['year'],
        ],
        [
          'payment' => $request['payment'],
          'description' => $request['description'],
        ]);

        if(!$membership_year->wasRecentlyCreated)
        {
          return $this->errorResponse('Članstvo že obstaja', 453);
        }

        return $this->showItem($membership_year);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MembershipYear  $membershipYear
     * @return \Illuminate\Http\Response
     */
    public function show(MembershipYear $membershipYear)
    {
      return $this->showItem($membershipYear);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MembershipYear  $membershipYear
     * @return \Illuminate\Http\Response
     */
    public function update(MembershipYearRequest $request, MembershipYear $membershipyear)
    {
        $membership_year = MembershipYear::whereId($membershipyear->id)->first();

        $membership_year->type = $request['type'];
        $membership_year->year = $request['year'];
        $membership_year->payment = $request['payment'];
        $membership_year->description = $request['description'];

        $membership_year->save();

        return $this->showItem($membership_year);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MembershipYear  $membershipYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(MembershipYear $membershipYear)
    {
      if($membershipYear->memberships())
      {
        return $this->errorResponse('Tip Članstva že obstaja v članstvu', 453);
      }

      $membershipYear->delete();

      return $this->showItem($membershipYear);
    }

    public function actions($id)
    {

      $membership_year = MembershipYear::whereId($id)->first();

      $active = event(new getActivationActionEvent($membership_year));

      $membership_year->active = $active[0];

      $membership_year->save();

      return $this->showItem($membership_year);
    }
}
