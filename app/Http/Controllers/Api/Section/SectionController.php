<?php

namespace App\Http\Controllers\Api\Section;


use Illuminate\Http\Request;
use App\Http\Requests\SectionRequest;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Section;

use App\Transformers\SectionTransformer;

use App\Events\getActivationActionEvent;

class SectionController extends ApiController
{

    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . SectionTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();

        return $this->showCollection($sections);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        $section = Section::firstOrCreate([
          'name' => $request['name'],
        ],
        [
          'description' => $request['description'],
        ]);

        if(!$section->wasRecentlyCreated)
        {
          return $this->errorResponse('Ime sekcije že obstaja', 453);
        }

        return $this->showItem($section);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
      return $this->showItem($section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request, Section $section)
    {

        $section->fill($request->only([
          'name',
          'description'
        ]));

        $section->save();

        return $this->showItem($section);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
      if(!$section->memberships())
      {
        $section->delete();
      }

      return $this->showItem($section);
    }



    public function actions($id)
    {
      $section = Section::whereId($id)->first();

      $active = event(new getActivationActionEvent($section));

      $section->active = $active[0];

      $section->save();

      return $this->showItem($section);
    }
}
