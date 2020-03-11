<?php

namespace App\Http\Controllers\Api\Doc;

use Illuminate\Http\Request;
use App\Http\Requests\DocRequest;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Doc;

use App\Transformers\DocTransformer;

class DocController extends ApiController
{

    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . DocTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docs = Doc::all();

        return $this->showCollection($docs);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocRequest $request)
    {

        $doc = Doc::firstOrCreate([
          'reference' => $request['reference'],
        ],
        [
          'type' => DOC::TYPE,
          'membership_year_id' => $request['membership_year_id'],
        ]);

        if(!$doc->wasRecentlyCreated)
        {
            return $this->errorResponse('Številka dokumenta že obstaja', 453);
        }

        return $this->showItem($doc);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doc  $doc
     * @return \Illuminate\Http\Response
     */
    public function show(Doc $doc)
    {
        return $this->showItem($doc);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doc  $doc
     * @return \Illuminate\Http\Response
     */
    public function update(DocRequest $request, Doc $doc)
    {
        $doc = Doc::whereId($doc->id)->first();

        $doc->reference = $request['reference'];
        $doc->membership_year_id = $request['membership_year_id'];

        $doc->save();

        return $this->showItem($doc);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doc  $doc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doc $doc)
    {
      if($doc->memberships())
      {
        return $this->errorResponse('Dokument že ima vnešeno članstvo', 453);
      }

      $doc->delete();

      return $this->showItem($doc);
    }
}
