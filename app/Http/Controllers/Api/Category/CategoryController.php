<?php

namespace App\Http\Controllers\Api\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

use App\Models\Membership\Category;

use App\Transformers\CategoryTransformer;

class CategoryController extends ApiController
{

    public function __construct()
    {
      parent::__construct();

      $this->middleware('transform.input:' . CategoryTransformer::class)->only(['store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::firstOrCreate([
          'name' => $request['name'],
          'type' => Category::TYPE_COMPETITION,
          'type_id' => $request['type_id'],
        ],
        [
          'from' => $request['from'],
          'to' => $request['to'],
          'participants' => $request['participants']
        ]);

        if(!$category->wasRecentlyCreated)
        {
            return $this->errrorResponse('Ta kategorija že obstaja', 453)
        }

        return $this->showItem($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $this->showItem($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category = Category::whereId($category->id)->first();

        $category->name = $request['name'];
        $category->from = $request['from'];
        $category->to = $request['to'];
        $category->participants = $request['participants'];

        $category->save();

        return $this->showItem($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->results)
        {
          return $this->errorResponse('V kategoriji so rezultati, zato se ne more brisati', 453);
        }

        $category->delete();

        return $this->showItem($category);
    }
}
