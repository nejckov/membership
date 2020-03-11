<?php

namespace App\Http\Controllers\Api\Committee;

use Illuminate\Http\Request;
use App\Http\Requests\CommitteeRequest;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Committee;

use App\Transformers\CommitteeTransformer;

class CommitteeController extends ApiController
{


  public function __construct()
  {
    parent::__construct();

    $this->middleware('transform.input:' . CommitteeTransformer::class)->only(['store', 'update']);
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $committees = Committee::all();

        return $this->showCollection($committees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommitteeRequest $request)
    {
        $committee = Committee::firstOrCreate([
          'member_id' => $request['member_id'],
          'fns_id' => $request['fns_id'],
          'year' => $request['year'],
        ],
        [
          'description' => $request['description'],
        ]);

        if(!$committee->wasRecentlyCreated)
        {
          return $this->errorMessage('Upravni odbor za tega člana že obstaja', 455);
        }

        return $this->showItem($committee);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Committee $committee)
    {
        return $this->showItem($committee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommitteeRequest $request, Committee $committee)
    {
          $committee = Committee::whereId($committee->id)->first();

          $committee->member_id = $request['member_id'];
          $committee->fns_id = $request['fns_id'];
          $committee->year = $request['year'];
          $committee->description = $request['description'];

          $committee->save();

          return $this->showItem($committee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Committee $committee)
    {
        $committee->delete();

        return $this->showItem($committee);
    }

}
