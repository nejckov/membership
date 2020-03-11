<?php

namespace App\Http\Controllers\Api\Fns;

use Illuminate\Http\Request;
use App\Http\Requests\FnsRequest;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Fns;

use App\Transformers\FnsTransformer;

use App\Events\getActivationActionEvent;

class FnsController extends ApiController
{

    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . FnsTransformer::class)->only(['store', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fns = Fns::all();

        return $this->showCollection($fns);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FnsRequest $request)
    {
        $fns = Fns::firstOrCreate([
          'name' => $request['name'],
        ],
        [
          'description' => $request['description'],
        ]);

        if(!$fns->wasRecentlyCreated)
        {
          return $this->errrorMessage('Funkcija že obstaja', 453);
        }

        return $this->showItem($fns);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fns $fn)
    {
        return $this->showItem($fn);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FnsRequest $request, Fns $fn)
    {
      $fn->fill($request->only([
        'name',
        'description',
      ]));

      $fn->save();

      return $this->showItem($fn);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fns $fns)
    {
        if($fns->committee)
        {
          return $this->errrorResponse('Funkcija že obstaja v upravnem odboru', 453);
        }

        $fns->delete();

        return $this->showItem($fns);
    }

    /**
    * Activate or deactivate Function
    *
    * @param int $id
    * @return \Illuminate\Htpp\Response
    */
    public function actions($id)
    {

      $fns = Fns::whereId($id)->first();

      $active = event(new getActivationActionEvent($fns));

      $fns->active = $active[0];

      $fns->save();

      return $this->showItem($fns);

    }
}
