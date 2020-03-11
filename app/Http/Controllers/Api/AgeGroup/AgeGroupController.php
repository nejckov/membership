<?php

namespace App\Http\Controllers\Api\AgeGroup;

use Illuminate\Http\Request;
use App\Http\Requests\AgeGroupRequest;
use App\Http\Controllers\ApiController;

use App\Models\Membership\AgeGroup;

use App\Transformers\AgeGroupTransformer;

use App\Events\getActivationActionEvent;


class AgeGroupController extends ApiController
{

    public function __construct()
    {

      parent::__construct();
      $this->middleware('transform.input:' . AgeGroupTransformer::class)->only (['store', 'update']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $age_groups = AgeGroup::all();

      return $this->showCollection($age_groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgeGroupRequest $request)
    {
        $age_group = AgeGroup::create([
          'from' => $request['from'],
          'to' => $request['to'],
          'name' => $request['name'],
          'description' => $request['description'],
        ]);

        return $this->showItem($age_group);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AgeGroup $ageGroup)
    {
        return $this->showItem($ageGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgeGroupRequest $request, AgeGroup $age_group)
    {
        $age_group = new AgeGroup();

        $age_group->from = $request['from'];
        $age_group->to = $request['to'];
        $age_group->name = $request['name'];
        $age_group->description = $request['description'];

        $age_group->save();

        return $this->showItem($age_group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AgeGroup $age_group)
    {
      if($age_group->memberships())
      {
        return $this->errorResponse('Starostna skupina že obstaja v članstvu', 411);
      }

      $age_group->delete();

      return $this->showItem($age_group);
    }

    public function actions($id)
    {
      $age_group = AgeGroup::whereId($id)->first();

      $activate = event(new getActivationActionEvent($age_group));

      AgeGroup::whereId($id)->update([
        'active' => $activate[0],
      ]);

      return $this->showItem($age_group);

    }
}
