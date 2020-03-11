<?php

namespace App\Http\Controllers\Api\Result;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Result;

use App\Transformers\ResultTransformer;

class ResultController extends ApiController
{

    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . ResultTransformer::class)->only(['store', 'update']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = Result::firstOrCreate([
          'type_id' => $request['type_id'],
          'fname' => $request['fname'],
          'lname' => $request['lname']
        ],
        [
          'type' => Result::TYPE_CATEGORY,
          'member_id' => $request['member_id'],
          'place' => $request['place'],
          'result' => $request['result'],
        ]);

        if(!$result->wasRecentlyCreated)
        {
          return $this->errorResponse('Ta rezltat že obstaja', 453);
        }

        return $this->showItem($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
      return $this->showItem($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        $result = Result::whereId($result->id)->first();

        $result->place = $request['place'];
        $result->fname = $request['fname'];
        $result->lname = $request['lname'];
        $result->member_id = $request['member_id'];
        $result->result = $request['result'];

        $result->save();

        return $this->showItem($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        $result->delete();

        return $this->showItem($result);
    }
}
