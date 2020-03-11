<?php

namespace App\Http\Controllers\Api\Competition;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Competition;

use App\Transformers\CompetitionTransformer;

class CompetitionController extends ApiController
{

    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . CompetitionTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitions = Competition::all();

        return $this->showCollection($competitions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $competition = Competition::firstOrCreate([
          'name' => $request['name'],
          'competition_date' => date('Y-m-d', strtotime($request['bompetition_date'])),
          'place' => $request['place']
        ],
        [
          'competition_time' => $request['competition_time'],
          'payment' => $request['payment'],
          'description' => $request['description'],
        ]);

        if(!$competition->wasRecentlyCreated)
        {
          return $this->errorResponse('Tekmovanje je že vnešeno', 453);
        }

        return $this->showItem($competition);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AppModelsMembershipCompetition  $appModelsMembershipCompetition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {
        return $this->showItem($competition);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppModelsMembershipCompetition  $appModelsMembershipCompetition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {
        $competition = Competition::whereId($competition->id)->first();

        $competition->name = $request['name'];
        $competition->competition_date = date('Y-m-d', strtotime($request['competition_date']));
        $competition->competition_time = $request['competition_time'];
        $competition->place = $request['place'];
        $competition->payment = $request['payment'];
        $competition->description = $request['description'];

        $competition->save();

        return $this->showItem($competition);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppModelsMembershipCompetition  $appModelsMembershipCompetition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        if($competition->categories() || $competition->images() || $competition->comments())
        {
          return $this->errorResponse('Tekmovanje že ima rezultat', 453);
        }

        $competition->delete();

        return $this->showItem($competition);
    }


    public function updateDetails(Request $request, $id) {

      $competition = Competition::whereId($id)->first();

      $competition->description = $request['details'];

      $competition->save();

      return $this->showItem($competition);
    }

    public function upcomingCompetition() {

      $competitions = Competition::where('competition_date', '>', Carbon::today() )->get();

      return $this->showCollection($competitions);
    }

    public function pastCompetition() {

      $competitions = Competition::where('competition_date', '<', Carbon::today())->get();

      return $this->showCollection($competitions);
    }
}
